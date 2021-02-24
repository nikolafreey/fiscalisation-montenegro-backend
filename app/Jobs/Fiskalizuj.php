<?php

namespace App\Jobs;

use App\Models\Racun;
use DOMDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use VertexIT\XMLSecLibs\XMLSecurityDSig;
use VertexIT\XMLSecLibs\XMLSecurityKey;

class Fiskalizuj implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public $certificate;

    public function __construct()
    {
        $this->certificate = $this->loadCertifacate();

        $this->data = [
            'danasnji_datum' => now()->toIso8601String(),
            'racun' => Racun::inRandomOrder()
                ->with([
                    'stavke'
                ])
                ->first(),
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

        $document = new DOMDocument();
        $document->loadXML($xml);

        // Create a new Security object
        $objDSig = new XMLSecurityDSig('');
        // Use the c14n exclusive canonicalization
        $objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        // Sign using SHA-256
        $objDSig->addReference(
            $document->getElementsByTagName('RegisterInvoiceRequest')->item(0),
            XMLSecurityDSig::SHA256,
            [
                'http://www.w3.org/2000/09/xmldsig#enveloped-signature',
                'http://www.w3.org/2001/10/xml-exc-c14n#',
            ],
            [
                'force_uri' => true,
                'reference_uri' => '#Request',
            ]
        );

        // Create a new (private) Security key
        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array('type'=>'private'));

        // Load the private key
        $objKey->loadKey($this->certificate['pkey']);

        // Sign the XML file
        $objDSig->sign($objKey);

        // Add the associated public key to the signature
        $objDSig->add509Cert($this->certificate['cert'], false);

        // Append the signature to the XML
        $objDSig->appendSignature($document->getElementsByTagName('RegisterInvoiceRequest')->item(0));

        $xml = $this->envelope($document->saveXML());

        file_put_contents('signed.xml', $xml);

        $response = Http::withOptions([
                'verify' => false,
            ])
            ->withHeaders([
                'Content-Type' => 'text/xml; charset=utf-8',
            ])->send('POST', 'https://efitest.tax.gov.me:443/fs-v1', [
                'body' => $xml,
            ]);

        $response = $this->parseXml($response);

        return [
            'ikof' => $this->data['IICData']['IIC'],
            'jikr' => '',
            'qr_url' => '',
        ];
    }

    private function envelope($xml)
    {
        $xml = str_replace("<?xml version=\"1.0\"?>\n",'', $xml);

        return '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
    <soapenv:Header/>
    <soapenv:Body>' . $xml . '</soapenv:Body>
            </soapenv:Envelope>';
    }

    private function parseXml($content)
    {
        dd($content->body());
        // $xml = simplexml_load_string($content);

        // return json_decode(json_encode((array) $xml), true);
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

    private function loadCertifacate()
    {
        $pfx = file_get_contents('CoreitPecatSoft.pfx');

        openssl_pkcs12_read($pfx, $key, "123456");

        return [
            'pkey' => $key['pkey'],
            'cert' => str_replace(["-----BEGIN CERTIFICATE-----\n", "-----END CERTIFICATE-----\n"], '', $key['cert']),
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

}
