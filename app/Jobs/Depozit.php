<?php

namespace App\Jobs;

use App\Models\FailedJobsCustom;
use Exception;
use Illuminate\Bus\Queueable;
use App\Services\SignXMLService;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class Depozit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public $certificate;

    public function __construct($depozitWithdraw)
    {
        $this->certificate = $this->loadCertifacate(storage_path('app/' . $depozitWithdraw->preduzece->pecat), decrypt($depozitWithdraw->preduzece->pecatSifra));

        $this->data = [
            'danasnji_datum' => now()->toIso8601String(),
            'depozitWithdraw' => $depozitWithdraw,
            'taxpayer' => [
                'CR' => $depozitWithdraw->preduzece->enu_kod,
                'TIN' => $depozitWithdraw->preduzece->pib,
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
            ])->send('POST', config('third_party_apis.poreska.registracija_depozita_url'), [
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

        $response = collect($vals)->keyBy('tag');

        try {
            return $response['FCDC']['value'];
        } catch (Exception $e) {
            $errorMessage = 'Depozit nije uspjesan: ' . $response['FAULTSTRING']['value'];

            Log::error($errorMessage);

            throw new \Exception($errorMessage);
        }
    }

    public function failed(Exception $e)
    {
        FailedJobsCustom::insert([
            'connection' => $this->connection,
            'payload' => $this->data['depozitWithdraw']->id,
            'exception' => $e->getMessage(),
            'job_name' => 'depozit',
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
}
