<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Services\SignXMLService;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class Depozit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public $certificate;

    public function __construct($depozit)
    {
        $this->certificate = $this->loadCertifacate('CoreitPecatSoft.pfx', '123456');

        $this->data = [
            'danasnji_datum' => now()->toIso8601String(),
            'depozit' => $depozit,
            // TODO: Check is this data dynamic?
            'taxpayer' => [
                'TIN' => '12345678', // Taxpayer Identification Number (PIB)
                'BU' => 'xx123xx123', // Business Unit Code (PJ)
                'CR' => 'si747we972', // Cash Register (ENU)
                'SW' => 'ss123ss123', // Software Code
                'OP' => 'oo123oo123', // Operator Code
            ],
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $xml = view('xml.depozit', $this->data)->render();

        $signXMLService = new SignXMLService(
            $xml,
            $this->certificate,
            'RegisterCashDepositRequest'
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

        return $this->parseResponse($response);
    }

    private function parseResponse($content)
    {
        $xml = simplexml_load_string($content->body());
        $json = json_encode($xml);

        $simple = $content->body();
        $p = xml_parser_create();
        xml_parse_into_struct($p, $simple, $vals, $index);

        foreach ($vals as $val) {
            if ($val['tag'] === 'FCDC') {
                return true;
            }
        }

        return abort(500, 'Neuspjesno registrovanje depozita');
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
}
