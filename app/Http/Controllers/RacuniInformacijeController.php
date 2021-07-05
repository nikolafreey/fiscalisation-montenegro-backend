<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Racun;
use App\Models\UlazniRacun;
use Illuminate\Http\Request;
use App\Models\DepozitWithdraw;
use Illuminate\Support\Facades\DB;

class RacuniInformacijeController extends Controller
{
    public function index(Request $request)
    {
        $preduzece = getAuthPreduzece($request);

        // Depozit i withdraw
        $depozit = DepozitWithdraw::filterByPermissions()
                    ->whereDate('created_at', Carbon::today())
                    ->whereNull('iznos_withdraw')
                    ->where('fiskalizovan', true)
                    ->first()
                    ->iznos_depozit ?? 0;

        $withdraw = DepozitWithdraw::filterByPermissions()
                    ->whereDate('created_at', Carbon::today())
                    ->whereNull('iznos_depozit')
                    ->where('fiskalizovan', true)
                    ->sum('iznos_withdraw');

        // Blagajna
        $blagajna = $preduzece->racuni()
                        ->where('vrsta_racuna', 'gotovinski')
                        ->where('status', '!=', 'storniran')
                        ->where('status', '!=', 'korektivni')
                        ->whereNotNull('jikr')
                        ->whereDate('created_at', Carbon::today())
                        ->sum('ukupna_cijena_sa_pdv_popust') + $depozit - $withdraw;

        // Naplaceno
        $naplaceno = $preduzece
                        ->racuni()
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->where('status', 'placen')
                        ->whereNotNull('jikr')
                        ->sum('ukupna_cijena_sa_pdv_popust');

        // Ceka se uplata
        $cekaSeUplata = $preduzece
                        ->racuni()
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->where('status', 'nijeplacen')
                        ->whereNotNull('jikr')
                        ->sum('ukupna_cijena_sa_pdv_popust');

        // Nije moguce platiti
        $nijeMogucePlatiti = $preduzece
                        ->racuni()
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->where('status', 'nenaplativ')
                        ->whereNotNull('jikr')
                        ->sum('ukupna_cijena_sa_pdv_popust');

        // Izlazni obracun
        $izlazniQuery = Racun::query();
        $izlazniQueryAll = Racun::query();

        $izlazniUkupnaSuma = $izlazniQueryAll->filterByPermissions()
                                ->whereMonth('created_at', now()->month)
                                ->where('tip_racuna', Racun::RACUN)
                                ->whereNotNull('jikr')
                                ->sum('ukupan_iznos_pdv') ?? 0;

        $izdatiTrenutniMjesecSuma = $izlazniQuery->filterByPermissions()
                                ->whereMonth('created_at', now()->month)
                                ->where('tip_racuna', Racun::RACUN)
                                ->whereNotNull('jikr')
                                ->sum('ukupna_cijena_sa_pdv_popust') ?? 0;

        $izdatiProsliMjesecSuma = $izlazniQuery->filterByPermissions()
                                ->whereMonth('created_at', now()->subMonth()->month)
                                ->where('tip_racuna', Racun::RACUN)
                                ->whereNotNull('jikr')
                                ->sum('ukupna_cijena_sa_pdv_popust') ?? 0;

        // Ulazni obracun
        $ulazniQuery = UlazniRacun::query();
        $ulazniQueryAll = UlazniRacun::query();

        $ulazniUkupnaSuma = $ulazniQueryAll->filterByPermissions()
                                ->whereMonth('created_at', now()->month)
                                ->where('tip_racuna', UlazniRacun::RACUN)
                                ->whereNotNull('jikr')
                                ->sum('ukupan_iznos_pdv') ?? 0;

        $primljeniTrenutniMjesecSuma = $ulazniQuery->filterByPermissions()
                            ->whereMonth('created_at', now()->month)
                            ->where('tip_racuna', UlazniRacun::RACUN)
                            ->whereNotNull('jikr')
                            ->sum('ukupan_iznos_pdv') ?? 0;

        $primljeniProsliMjesecSuma = $izlazniQuery->filterByPermissions()
                            ->whereMonth('created_at', now()->subMonth()->month)
                            ->where('tip_racuna', UlazniRacun::RACUN)
                            ->whereNotNull('jikr')
                            ->sum('ukupna_cijena_sa_pdv_popust') ?? 0;

        // Najveci kupci
        $kupci = $preduzece->partneri()
                    ->withCount(['racuni as suma_ukupna_cijena_sa_pdv_popust' => function ($query) {
                        $query->where('status', 'placen')
                            ->whereNotNull('jikr')
                            ->whereMonth('created_at', Carbon::now()->month)
                            ->select(DB::raw('SUM(ukupna_cijena_sa_pdv_popust) as suma_ukupna_cijena_sa_pdv_popust'));
                    }])
                    ->orderByDesc('suma_ukupna_cijena_sa_pdv_popust')
                    ->take(3)
                    ->get();

        $duznici = $preduzece->partneri()
            ->withCount(['racuni as suma_ukupna_cijena_sa_pdv_popust' => function ($query) {
                $query->where('status', 'nijeplacen')
                    ->whereNotNull('jikr')
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->select(DB::raw('SUM(ukupna_cijena_sa_pdv_popust) as suma_ukupna_cijena_sa_pdv_popust'));
            }])
            ->orderByDesc('suma_ukupna_cijena_sa_pdv_popust')
            ->take(3)
            ->get();

        $kupciArray = [];
        foreach ($kupci as $kupac) {
            $kupciArray[] = [
                'kupac' => ! $kupac->preduzece_tabela_id ? $kupac->fizicko_lice : $kupac->preduzece,
                'cijena' => (int) $kupac->suma_ukupna_cijena_sa_pdv_popust
            ];
        }

        $duzniciArray = [];
        foreach ($duznici as $duznik) {
            $duzniciArray[] = [
                'duznik' => ! $duznik->preduzece_tabela_id ? $duznik->fizicko_lice : $duznik->preduzece,
                'cijena' => (int) $duznik->suma_ukupna_cijena_sa_pdv_popust
            ];
        }

        $sertifikatValidan = false;
        if ($preduzece->sertifikat !== null && $preduzece->vazenje_sertifikata_do > now()) {
            $sertifikatValidan = true;
        } else if ($preduzece->pecat !== null && $preduzece->vazenje_pecata_do > now()) {
            $sertifikatValidan = true;
        }

        $informacije = [
            'preduzece_naziv' => $preduzece->kratki_naziv,
            'blagajna' => (int) $blagajna,
            'depozit' => (int) $depozit,
            'naplaceno' => (int) $naplaceno,
            'ceka_se_uplata' => (int) $cekaSeUplata,
            'nije_moguce_naplatiti' => (int) $nijeMogucePlatiti,
            'izdati_racuni' => (int) $izdatiTrenutniMjesecSuma,
            'izdati_racuni_prosli_mjesec' => $izdatiProsliMjesecSuma,
            'PDV_na_izlaznim_racunima' => (int) $izlazniUkupnaSuma,
            'primljeni_racuni' => (int) $primljeniTrenutniMjesecSuma,
            'primljeni_racuni_prosli_mjesec' => $primljeniProsliMjesecSuma,
            'PDV_na_ulaznim_racunima' => (int) $ulazniUkupnaSuma,
            'sertifikat_validan' => $sertifikatValidan,
            'najveci_kupci' => $kupciArray,
            'najveci_duznici' => $duzniciArray,
        ];

        return response()->json($informacije);
    }
}
