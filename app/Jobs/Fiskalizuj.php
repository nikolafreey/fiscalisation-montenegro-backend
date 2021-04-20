<?php

namespace App\Jobs;

use DOMDocument;
use App\Services\SignXMLService;
use App\Models\Racun;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use VertexIT\XMLSecLibs\XMLSecurityKey;
use Illuminate\Queue\InteractsWithQueue;
use VertexIT\XMLSecLibs\XMLSecurityDSig;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class Fiskalizuj implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public $certificate;

    public function __construct($racun)
    {
        if ($racun->vrsta_racuna === 'GOTOVINSKI') {
            $potpis = $racun->preduzece->pecat;

            $decryptedPassword = decrypt($racun->preduzece->pecatSifra);
        }

        if ($racun->vrsta_racuna === 'BEZGOTOVINSKI') {
            $potpis = $racun->preduzece->sertifikat;

            $decryptedPassword = decrypt($racun->preduzece->sertifikatSifra);
        }

        $this->certificate = $this->loadCertifacate(storage_path('app/' . $potpis), $decryptedPassword);

        $this->data = [
            'danasnji_datum' => now()->toIso8601String(),
            'racun' => $racun->load('stavke'),
            'taxpayer' => [
                'CR' => $racun->preduzece->enu_kod,
                'SW' => $racun->preduzece->software_kod,
                'TIN' => $racun->preduzece->pib,
                'BU' => 'xx123xx123' ?? $racun->poslovnaJedinica->kratki_naziv,
                'OP' => $racun->kod_operatera,
            ],
            'seller' => [
                'IDType' => 'TIN',
                'Name' => $racun->preduzece->kratki_naziv,
            ],
            'buyer' => [
                'IDType' => 'TIN',
                'IDNum' => '12345678',
                'Name' => $racun->partner->kontakt_ime,
            ],
        ];

        $this->data['IICData'] = $this->generateIIC();
        $this->data['sameTaxes'] = $this->calculateSameTaxes();
    }

    public function handle()
    {
        $xml = view('xml.fiskalizuj', $this->data)->render();

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

        $this->data['racun']->update([
            'ikof' => $this->data['IICData']['IIC'],
            'jikr' => $this->parseJikrFromXmlResponse($response),
            'qr_url' => $this->generateQRCode(),
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
            $errorMessage = 'Fiskalizacija nije uspjesna: ' . $response['FAULTSTRING']['value'];

            Log::error($errorMessage);

            abort(520, $errorMessage);
        }
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
            $this->data['racun']->broj_racuna,
            $this->data['taxpayer']['BU'],
            $this->data['taxpayer']['CR'],
            $this->data['taxpayer']['SW'],
            sprintf("%.2f", $this->data['racun']->cijena_sa_pdv),
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
            '0.00' => [
                'ukupna_kolicina' => 0.0,
                'ukupna_cijena_bez_pdv' => 0.0,
                'ukupan_iznos_pdv' => 0.0,
            ],
            '0.07' => [
                'ukupna_kolicina' => 0.0,
                'ukupna_cijena_bez_pdv' => 0.0,
                'ukupan_iznos_pdv' => 0.0,
            ],
            '0.21' => [
                'ukupna_kolicina' => 0.0,
                'ukupna_cijena_bez_pdv' => 0.0,
                'ukupan_iznos_pdv' => 0.0,
            ],
        ];

        foreach ($this->data['racun']->stavke as $stavka) {
            $porez_stopa = $stavka->porez->stopa;

            $sameTaxes[$porez_stopa]['ukupna_kolicina'] += $stavka->kolicina;
            $sameTaxes[$porez_stopa]['ukupna_cijena_bez_pdv'] += $stavka->ukupna_bez_pdv;
            $sameTaxes[$porez_stopa]['ukupan_iznos_pdv'] += $stavka->pdv_iznos;

        }

        return $sameTaxes;
    }

    private function generateQRCode()
    {
        return config('third_party_apis.poreska.qr_code_url') . implode('&', [
                $this->data['IICData']['IIC'],
                'tin=' . $this->data['taxpayer']['TIN'],
                'crtd=' . $this->data['danasnji_datum'],
                'ord=' . $this->data['racun']->broj_racuna,
                'bu=' . $this->data['taxpayer']['BU'],
                'cr=' . $this->data['taxpayer']['CR'],
                'sw=' . $this->data['taxpayer']['SW'],
                'prc=' . $this->data['racun']->ukupna_cijena_sa_pdv,
            ]);
    }

}
