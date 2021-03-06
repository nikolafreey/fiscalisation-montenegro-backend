<?php

namespace App\Jobs;

use App\Models\FailedJobsCustom;
use App\Services\SignXMLService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Fiskalizuj implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public $certificate;

    public $ikof;

    public function __construct($racun, $ikof = null, $originalIkof = null, $datum = null)
    {
        if ($racun->vrsta_racuna === 'gotovinski') {
            $potpis = $racun->preduzece->pecat;

            $decryptedPassword = decrypt($racun->preduzece->pecatSifra);

            $tip_placanja = 'CASH';
            $nacin_placanja = $racun->nacin_placanja ?? 'CASH';
            // $datum_za_placanje = now()->toIso8601String();
        }

        if ($racun->vrsta_racuna === 'bezgotovinski') {
            $potpis = $racun->preduzece->sertifikat;

            $decryptedPassword = decrypt($racun->preduzece->sertifikatSifra);

            $tip_placanja = 'NONCASH';
            $nacin_placanja = $racun->nacin_placanja ?? 'BANKNOTE';
            // $datum_za_placanje = $racun->$datum_za_placanje->toIso8601String();
        }

        if ($racun->partner->preduzece_tabela_id != null) {
            $kupacPib = $racun->partner->preduzece_partner->pib;
            $kupacNaziv = $racun->partner->preduzece_partner->kratki_naziv;
            $kupacAdresa = $racun->partner->preduzece_partner->adresa;
            $kupacGrad = $racun->partner->preduzece_partner->grad;
            $kupacDrzava = $racun->partner->preduzece_partner->country_code;
        } else {
            $kupacPib = '12345678';
            $kupacNaziv = $racun->partner->fizicko_lice->ime . " " . $racun->partner->fizicko_lice->prezime;
            $kupacAdresa = $racun->partner->fizicko_lice->adresa;
            $kupacGrad = $racun->partner->fizicko_lice->grad;
            $kupacDrzava = $racun->partner->fizicko_lice->country_code;
        }

        $this->certificate = $this->loadCertifacate(storage_path('app/' . $potpis), $decryptedPassword);

        $this->data = [
            'danasnji_datum' => now()->toIso8601String(),
            'datum_za_placanje' => date("Y-m-d", strtotime($racun->datum_za_placanje)),
            'racun' => $racun->load('stavke'),
            'taxpayer' => [
                'CR' => $racun->preduzece->enu_kod,
                'SW' => config('third_party_apis.poreska.sw_kod'),
                'TIN' => $racun->preduzece->pib,
                //TODO: Ispraviti poslovnu jedinicu i upisati iz niza, a ne prvi koji smo pokupili iz racuna
                // Racun ima samo jednu poslovnu jedinicu
                'BU' => $racun->poslovnaJedinica->kod_poslovnog_prostora,
                'OP' => $racun->user->kod_operatera ?? $racun->preduzece->kod_operatera,
            ],
            'seller' => [
                'IDType' => 'TIN',
                'Name' => $racun->preduzece->kratki_naziv ?? 'Anonimno Preduzece',
                'Address' => $racun->preduzece->adresa ?? 'Anonimna adresa',
                'Town' => $racun->preduzece->grad ?? 'Anoniman grad',
                'Country' => $racun->preduzece->country_code ?? 'MNE',
            ],
            'buyer' => [
                'IDType' => 'TIN',
                'IDNum' => $kupacPib,
                'Name' => $kupacNaziv,
                'Address' => $kupacAdresa,
                'Town' => $kupacGrad,
                'Country' => $kupacDrzava ?? 'MNE',
            ],
            'tip_placanja' => $tip_placanja,
            'nacin_placanja' => $nacin_placanja,
            'ukupan_pdv' => null,
            'pdv_obveznik' => $racun->preduzece->pdv_obveznik ? "true" : "false",
            'ikof' => $ikof,
            'datum' => $datum ? $datum->toIso8601String() : '',
        ];

        $this->data['IICData'] = $this->generateIIC();
        $this->data['sameTaxes'] = $this->calculateSameTaxes();
        $this->ikof = $ikof;

        foreach ($this->data['sameTaxes'] as $totVat) {
            $this->data['ukupan_pdv'] += round($totVat['ukupan_iznos_pdv'], 2);
        }

        if (
            !
            round($racun->ukupna_cijena_bez_pdv_popust, 2)
            +
            $this->data['ukupan_pdv']
            ===
            round($racun->ukupna_cijena_sa_pdv_popust, 2)
        ) {
            Log::error('Obracun nije ispravan!');
        }
    }

    public function handle()
    {
        $this->data['racun']->update([
            'ikof' => $this->ikof ?? $this->data['IICData']['IIC'],
        ]);

        $xml = view(
            'xml.fiskalizuj',
            $this->data
        )->render();

        $signXMLService = new SignXMLService(
            $xml,
            $this->certificate,
            'RegisterInvoiceRequest'
        );

        $signedXML = $signXMLService->getSignedXML();

        $response = Http::withOptions([
            'verify' => false,
        ])
            ->withHeaders([
                'Content-Type' => 'text/xml; charset=utf-8',
            ])->send('POST', config('third_party_apis.poreska.fiskalizacija_url'), [
                'body' => $signedXML,
            ]);

        $qr = $this->generateQRCode();

        $this->data['racun']->update([
            'jikr' => $this->parseJikrFromXmlResponse($response),
            'qr_url' => $qr,
            'qr_code' => $qr
        ]);

        return true;
    }

    private function parseJikrFromXmlResponse($content)
    {
        $xml = simplexml_load_string($content->body());
        $json = json_encode($xml);

        $simple = $content->body();
        $p = xml_parser_create();
        xml_parse_into_struct($p, $simple, $vals, $index);

        $response = collect($vals)->keyBy('tag');

        try {
            return $response['FIC']['value'];
        } catch (Exception $e) {
            $errorMessage =  'Racun id:' . $this->data['racun']->id . ' Fiskalizacija nije uspjesna: ' . $response['FAULTSTRING']['value'];

            Log::error($errorMessage);

            throw new \Exception($errorMessage);
        }
    }

    public function failed(Exception $e)
    {
        FailedJobsCustom::insert([
            'connection' => $this->connection,
            'payload' => $this->data['racun']->id,
            'exception' => $e->getMessage(),
            'job_name' => 'racun',
        ]);
    }

    private function loadCertifacate($location, $password)
    {
        $pfx = file_get_contents($location);

        openssl_pkcs12_read($pfx, $key, $password);

        return [
            'pkey' => $key['pkey'],
            'cert' => str_replace(["-----BEGIN CERTIFICATE-----\n", "-----END CERTIFICATE-----\n"], '', $key['cert']),
        ];
    }

    private function generateIIC()
    {
        $dataString = implode('|', [
            $this->data['taxpayer']['TIN'],
            $this->data['danasnji_datum'],
            $this->data['racun']->redni_broj,
            $this->data['taxpayer']['BU'],
            $this->data['taxpayer']['CR'],
            $this->data['taxpayer']['SW'],
            sprintf("%.2f", $this->data['racun']->ukupna_cijena_sa_pdv_popust),
        ]);

        $dataString = utf8_encode($dataString);

        $pkeyid = openssl_pkey_get_private($this->certificate['pkey']);
        openssl_sign($dataString, $signature, $pkeyid, 'RSA-SHA256');
        openssl_free_key($pkeyid);

        return [
            'IIC' => hash('md5', $dataString),
            'signature' => bin2hex($signature),
        ];
    }

    public function calculateSameTaxes()
    {
        $sameTaxes = [
            'oslobodjen_pdv' => [
                'ukupan_broj_stavki' => 0,
                'ukupna_cijena_bez_pdv' => 0.0,
                'ukupan_iznos_pdv' => 'oslobodjen',
            ],
            '0.00' => [
                'ukupan_broj_stavki' => 0,
                'ukupna_cijena_bez_pdv' => 0.0,
                'ukupan_iznos_pdv' => 0.0,
            ],
            '0.07' => [
                'ukupan_broj_stavki' => 0,
                'ukupna_cijena_bez_pdv' => 0.0,
                'ukupan_iznos_pdv' => 0.0,
            ],
            '0.21' => [
                'ukupan_broj_stavki' => 0,
                'ukupna_cijena_bez_pdv' => 0.0,
                'ukupan_iznos_pdv' => 0.0,
            ],
        ];

        foreach ($this->data['racun']->stavke as $stavka) {
            $porez_stopa = $stavka->porez->stopa;
            $porez_id = $stavka->porez->id;

            if ($porez_id === 1) {
                $sameTaxes['oslobodjen_pdv']['ukupan_broj_stavki']++;
                $sameTaxes['oslobodjen_pdv']['ukupna_cijena_bez_pdv'] += $stavka->cijena_bez_pdv_popust * $stavka->kolicina;
            } else {
                $sameTaxes[$porez_stopa]['ukupan_broj_stavki']++;
                $sameTaxes[$porez_stopa]['ukupna_cijena_bez_pdv'] += $stavka->cijena_bez_pdv_popust * $stavka->kolicina;
                $sameTaxes[$porez_stopa]['ukupan_iznos_pdv'] += round($stavka->pdv_iznos_ukupno, 2);
            }
        }

        return $sameTaxes;
    }

    private function generateQRCode()
    {
        return config('third_party_apis.poreska.qr_code_url') . implode('&', [
             $this->data['IICData']['IIC'],
            'tin=' . $this->data['taxpayer']['TIN'],
            'crtd=' . $this->data['danasnji_datum'],
            'ord=' . $this->data['racun']->redni_broj,
            'bu=' . $this->data['taxpayer']['BU'],
            'cr=' . $this->data['taxpayer']['CR'],
            'sw=' . $this->data['taxpayer']['SW'],
            'prc=' . $this->data['racun']['ukupna_cijena_sa_pdv_popust'],
        ]);
    }
}
