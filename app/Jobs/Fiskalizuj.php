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
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;

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
            ]
        ];

        $this->data['IICData'] = $this->generateIIC();
    }

    public function handle()
    {
        $xml = view('xml.fiskalizuj', $this->data)->render();

        $document = new DOMDocument();
        $document->loadXML($xml);

        // Create a new Security object
        $objDSig = new XMLSecurityDSig(false);
        // Use the c14n exclusive canonicalization
        $objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        // Sign using SHA-256
        $objDSig->addReference(
            $document,
            XMLSecurityDSig::SHA256,
            [
                'http://www.w3.org/2000/09/xmldsig#enveloped-signature',
                'http://www.w3.org/2001/10/xml-exc-c14n#',
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
        $objDSig->appendSignature($document->getElementsByTagName('Body')->item(0));


        // TODO: Save for testing purposes
        $document->save('signed.xml');

        $response = Http::withOptions([
                'verify' => false,
            ])
            ->withHeaders([
                'Content-Type' => 'text/xml; charset=utf-8',
            ])->send('POST', 'https://efitest.tax.gov.me:443/fs-v1', [
                'body' => $document->saveXML()
            ]);

        echo $response->body();

        // TODO: Parse response

        return [
            'ikof' => $this->data['IICData']['IIC'],
            'jikr' => '',
            'qr_url' => '',
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

    private function loadCertifacate()
    {
        $pfx = file_get_contents('CoreitPecatSoft.pfx');

        openssl_pkcs12_read($pfx, $key, "123456");

        return $key;
    }


}
