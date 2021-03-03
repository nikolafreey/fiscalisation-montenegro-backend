<?php

namespace App\Jobs;

use DOMDocument;
use App\Services\SignXMLService;
use App\Models\Racun;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
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
        $decryptedPassword = decrypt($racun->preduzece->sifra);

        $this->certificate = $this->loadCertifacate(storage_path('app/' . $racun->preduzece->pecat), $decryptedPassword);

        $this->data = [
            'danasnji_datum' => now()->toIso8601String(),
            'racun' => $racun->load('stavke'),
            // TODO: Check is this data dynamic?
            'taxpayer' => [
                'TIN' => '12345678', // Taxpayer Identification Number (PIB)
                'BU' => 'xx123xx123', // Business Unit Code (PJ)
                'CR' => 'si747we972', // Cash Register (ENU)
                'SW' => 'ss123ss123', // Software Code
                'OP' => 'oo123oo123', // Operator Code
            ],
            'seller' => [
                'IDType' => 'TIN',
                'Name' => 'Test d.o.o.',
            ],
            'buyer' => [
                'IDType' => 'TIN',
                'IDNum' => '12345678',
                'Name' => 'Partner',
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
            ])->send('POST', 'https://efitest.tax.gov.me:443/fs-v1', [
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

        foreach ($vals as $val) {
            if ($val['tag'] === 'FIC') {
                return $val['value'];
            }
        }

        abort(500, 'JIKR nije generisan');
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
            $sameTaxes[$porez_stopa]['ukupna_cijena_bez_pdv'] += $stavka->cijena_bez_pdv;
            $sameTaxes[$porez_stopa]['ukupan_iznos_pdv'] += $stavka->pdv_iznos;

        }

        return $sameTaxes;
    }

    private function generateQRCode()
    {
        return 'https://efitest.tax.gov.me/ic/#/verify?iic=' . implode('&', [
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
