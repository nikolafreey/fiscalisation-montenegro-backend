<?php

namespace App\Services;

use DOMDocument;
use Illuminate\Support\Facades\App;
use VertexIT\XMLSecLibs\XMLSecurityKey;
use VertexIT\XMLSecLibs\XMLSecurityDSig;

class SignXMLService
{
    private $certificate;

    /**
     * Class constructor.
     */
    public function __construct($xml, $certificate, $nodeName)
    {
        $this->xml = $xml;
        $this->certificate = $certificate;
        $this->nodeName = $nodeName;
    }

    public function getSignedXML()
    {
        $document = new DOMDocument();
        $document->loadXML($this->xml);

        // Create a new Security object
        $objDSig = new XMLSecurityDSig('');

        // Use the c14n exclusive canonicalization
        $objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);

        // Sign using SHA-256
        $objDSig->addReference(
            $document->getElementsByTagName($this->nodeName)->item(0),
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
        $objDSig->appendSignature($document->getElementsByTagName($this->nodeName)->item(0));

        $signedXML = $this->envelope($document->saveXML());

        if (App::environment('local')) {
            file_put_contents('signed.xml', $signedXML);
        }

        return $signedXML;
    }

    private function envelope($xml)
    {
        $xml = str_replace("<?xml version=\"1.0\"?>\n",'', $xml);

        return '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
            <soapenv:Header/>
            <soapenv:Body>' . $xml . '</soapenv:Body>
            </soapenv:Envelope>';
    }


}
