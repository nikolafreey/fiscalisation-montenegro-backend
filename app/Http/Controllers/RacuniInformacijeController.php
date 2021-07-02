<?php

namespace App\Http\Controllers;

use App\Models\Racun;
use Carbon\Carbon;
use App\Models\UlazniRacun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RacuniInformacijeController extends Controller
{
    public function index(Request $request)
    {
        $preduzece = getAuthPreduzece($request);

        // Blagajna
        $blagajna = $preduzece->racuni()->where('vrsta_racuna', 'gotovinski')->whereDate('created_at', Carbon::today())->sum('ukupna_cijena_sa_pdv_popust');

        // Depozit
        $depozit = 0;
        foreach ($preduzece->poslovne_jedinice as $poslovna_jedinica) {
            $vrijednostDepozita = $poslovna_jedinica->depozitWithdraw()->whereNull('iznos_withdraw')->whereDate('created_at', Carbon::today())->first()->iznos_depozit ?? 0;

            $depozit += $vrijednostDepozita;
        }

        // Naplaceno
        $naplaceno = $preduzece
                        ->racuni()
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->where('status', 'placen')
                        ->sum('ukupna_cijena_sa_pdv_popust');

        // Ceka se uplata
        $cekaSeUplata = $preduzece
                        ->racuni()
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->where('status', 'nijeplacen')
                        ->sum('ukupna_cijena_sa_pdv_popust');

        // Nije moguce platiti
        $nijeMogucePlatiti = $preduzece
                        ->racuni()
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->where('status', 'nenaplativ')
                        ->sum('ukupna_cijena_sa_pdv_popust');

        $mjesec = Carbon::now()->month;
        $godina = Carbon::now()->year;

        $prviUMjesecu = "{$godina}-{$mjesec}-1 00:00:00";
        $prviUMjesecu = Carbon::parse($prviUMjesecu);
        $prethodniMjesec = Carbon::parse($prviUMjesecu)->subMonthNoOverflow();

        // Izlazni obracun
        $izlazniQuery = Racun::query();
        $izlazniQueryAll = Racun::query();
        $izlazniQueryPoredjenje = Racun::query();

        $izlazniUkupnaSuma = $izlazniQueryAll->filterByPermissions()
                                ->where('tip_racuna', Racun::RACUN)->whereNotNull('jikr')
                                ->sum('ukupan_iznos_pdv') ?? 0;

        $izdatiTrenutniMjesecSuma = $izlazniQuery->filterByPermissions()
                                ->whereMonth('created_at', Carbon::now()->month)                                ->where('tip_racuna', Racun::RACUN)
                                ->sum('ukupna_cijena_sa_pdv_popust') ?? 0;

        $izlazniQueryPoredjenje = DB::select(DB::raw('SELECT * FROM `racuni` WHERE deleted_at IS NULL AND datum_izdavanja BETWEEN "' . $prethodniMjesec . '" AND "' . $prviUMjesecu . '"'));

        $izlazniPoredjenjeSuma = 0;
        foreach ($izlazniQueryPoredjenje as $racun) {
            $izlazniPoredjenjeSuma += $racun->ukupna_cijena_sa_pdv_popust;
        }

        // Ulazni obracun
        $ulazniQuery = UlazniRacun::query();
        $ulazniQueryAll = UlazniRacun::query();
        $ulazniQueryPoredjenje = UlazniRacun::query();

        $ulazniUkupnaSuma = $ulazniQueryAll->where('tip_racuna', UlazniRacun::RACUN)
                                ->sum('ukupan_iznos_pdv') ?? 0;

        $primljeniTrenutniMjesecSuma = $ulazniQuery->whereMonth('created_at', Carbon::now()->month)
                            ->where('tip_racuna', UlazniRacun::RACUN)
                            ->sum('ukupan_iznos_pdv') ?? 0;

        $ulazniQueryPoredjenje = DB::select(DB::raw('SELECT * FROM `ulazni_racuni` WHERE datum_izdavanja BETWEEN "' . $prethodniMjesec . '" AND "' . $prviUMjesecu . '"'));

        $ulazniPoredjenjeSuma = 0;
        foreach ($ulazniQueryPoredjenje as $racun) {
            $ulazniPoredjenjeSuma += $racun->ukupna_cijena_sa_pdv_popust;
        }

        // Najveci kupci
        $kupci = $preduzece->partneri()
                    ->withCount(['racuni as suma_ukupna_cijena_sa_pdv_popust' => function ($query) {
                        $query->where('status', 'placen')
                            ->where('jikr', '!=', null)
                            ->whereMonth('created_at', Carbon::now()->month)
                            ->select(DB::raw('SUM(ukupna_cijena_sa_pdv_popust) as suma_ukupna_cijena_sa_pdv_popust'));
                    }])
                    ->orderByDesc('suma_ukupna_cijena_sa_pdv_popust')
                    ->take(3)
                    ->get();

        $duznici = $preduzece->partneri()
            ->withCount(['racuni as suma_ukupna_cijena_sa_pdv_popust' => function ($query) {
                $query->where('status', 'nijeplacen')
                    ->where('jikr', '!=', null)
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
            if ($preduzece->pecat !== null && $preduzece->vazenje_pecata_do > now()) {
                $sertifikatValidan = true;
            }
        }

        $informacije = [
            'preduzece_naziv' => $preduzece->kratki_naziv,
            'blagajna' => (int) $blagajna,
            'depozit' => $depozit,
            'naplaceno' => (int) $naplaceno,
            'ceka_se_uplata' => (int) $cekaSeUplata,
            'nije_moguce_naplatiti' => (int) $nijeMogucePlatiti,
            'izdati_racuni' => (int) $izdatiTrenutniMjesecSuma,
            'izlazni_poredjenje_pdv' => $izlazniPoredjenjeSuma,
            'primljeni_racuni' => (int) $primljeniTrenutniMjesecSuma,
            'ulazni_poredjenje_pdv' => $ulazniPoredjenjeSuma,
            'PDV_na_izlaznim_racunima' => (int) $izlazniUkupnaSuma,
            'PDV_na_ulaznim_racunima' => (int) $ulazniUkupnaSuma,
            'sertifikat_validan' => $sertifikatValidan,
            'najveci_kupci' => $kupciArray,
            'najveci_duznici' => $duzniciArray,
        ];

        return response()->json($informacije);
    }
}
