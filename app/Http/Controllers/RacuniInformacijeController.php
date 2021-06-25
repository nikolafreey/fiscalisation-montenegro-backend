<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UlazniRacun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RacuniInformacijeController extends Controller
{
    public function index(Request $request)
    {
        $preduzece = getAuthPreduzece($request);

        $blagajna = $preduzece->racuni()->where('vrsta_racuna', 'gotovinski')->whereDate('created_at', Carbon::today())->get();

        $depozit = 0;
        foreach ($preduzece->poslovne_jedinice as $poslovna_jedinica) {
            $vrijednostDepozita = $poslovna_jedinica->depozitWithdraw()->whereNull('iznos_withdraw')->whereDate('created_at', Carbon::today())->first();

            if ($vrijednostDepozita != null) {
                $depozit += $vrijednostDepozita;
            }
        }

        $naplaceno = $preduzece
                        ->racuni()
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->where('status', 'placen')
                        ->sum('ukupna_cijena_sa_pdv_popust');

        $cekaSeUplata = $preduzece
                        ->racuni()
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->where('status', 'nijeplacen')
                        ->sum('ukupna_cijena_sa_pdv_popust');

        $nijeMogucePlatiti = $preduzece
                        ->racuni()
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->where('status', 'nenaplativ')
                        ->sum('ukupna_cijena_sa_pdv_popust');

        $najveciKupci = DB::select("SELECT SUM(racuni.ukupan_iznos_pdv) as ukupan_promet, preduzeca.* FROM racuni, partneri, preduzeca WHERE tip_racuna='racun' AND racuni.status = 'placen' AND racuni.preduzece_id = ? AND racuni.partner_id = partneri.id AND partneri.preduzece_tabela_id = preduzeca.id GROUP BY partner_id", [getAuthPreduzeceId($request)]);

        $najveciDuznici = DB::select("SELECT SUM(racuni.ukupan_iznos_pdv) as ukupan_promet, preduzeca.* FROM racuni, partneri, preduzeca WHERE tip_racuna='racun' AND racuni.status = 'placen' AND racuni.preduzece_id = ? AND racuni.partner_id = partneri.id AND partneri.preduzece_tabela_id = preduzeca.id GROUP BY partner_id", [getAuthPreduzeceId($request)]);

        $informacije = [
            'blagajna' => $blagajna,
            'depozit' => $depozit,
            'naplaceno' => $naplaceno,
            'ceka_se_uplata' => $cekaSeUplata,
            'nije_moguce_naplatiti' => $nijeMogucePlatiti,
            'izdati_racuni' => '',
            'primljeni_racuni' => '',
            'PDV_za_trenutni_mjesec' => '',
            'PDV_na_izlaznim_racunima' => '',
            'PDV_na_ulaznim_racunima' => '',
            'najveci_kupci' => $najveciKupci,
            'najveci_duznici' => $najveciDuznici,
        ];

        return response()->json($informacije);
    }
}
