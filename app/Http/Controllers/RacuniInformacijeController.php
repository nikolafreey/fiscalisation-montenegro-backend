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

        $blagajna = $preduzece->racuni()->where('vrsta_racuna', 'gotovinski')->whereDate('created_at', Carbon::today())->sum('ukupna_cijena_sa_pdv_popust');

        $depozit = 0;
        foreach ($preduzece->poslovne_jedinice as $poslovna_jedinica) {
            $vrijednostDepozita = $poslovna_jedinica->depozitWithdraw()->whereNull('iznos_withdraw')->whereDate('created_at', Carbon::today())->first()->iznos_depozit;

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

        $dan = Carbon::now()->day;
        $mjesec = Carbon::now()->month;
        $godina = Carbon::now()->year;

        $prviUMjesecu = "{$godina}-{$mjesec}-1 00:00:00";
        $prviUMjesecu = Carbon::parse($prviUMjesecu);
        $prethodniMjesec = Carbon::parse($prviUMjesecu)->subMonthNoOverflow();

        // Izlazni obracun
        $izlazniQuery = Racun::query();
        $izlazniQueryAll = Racun::query();
        $izlazniQueryPoredjenje = Racun::query();

        $izlazniUkupnaSuma = $izlazniQueryAll->filterByPermissions()->where('tip_racuna', Racun::RACUN)->whereNotNull('jikr')->sum('ukupan_iznos_pdv');
        $izdatiTrenutniMjesecSuma = $izlazniQuery->filterByPermissions()->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")->where('tip_racuna', Racun::RACUN)->sum('ukupna_cijena_sa_pdv_popust');

        $izlazniQueryPoredjenje = DB::select(DB::raw('SELECT * FROM `racuni` WHERE deleted_at IS NULL AND datum_izdavanja BETWEEN "' . $prethodniMjesec . '" AND "' . $prviUMjesecu . '"'));

        $izlazniPoredjenjeSuma = 0;
        foreach ($izlazniQueryPoredjenje as $racun) {
            $izlazniPoredjenjeSuma += $racun->ukupna_cijena_sa_pdv_popust;
        }

        // Ulazni obracun
        $ulazniQuery = UlazniRacun::query();
        $ulazniQueryAll = UlazniRacun::query();
        $ulazniQueryPoredjenje = UlazniRacun::query();

        $ulazniUkupnaSuma = $ulazniQueryAll->where('tip_racuna', UlazniRacun::RACUN)->sum('ukupan_iznos_pdv');

        $ulazniQueryPdv = $ulazniQuery->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")->where('tip_racuna', UlazniRacun::RACUN)->get();
        $ulazniQueryPoredjenje = DB::select(DB::raw('SELECT * FROM `ulazni_racuni` WHERE datum_izdavanja BETWEEN "' . $prethodniMjesec . '" AND "' . $prviUMjesecu . '"'));

        $primljeniTrenutniMjesecSuma = 0;
        $ulazniPoredjenjeSuma = 0;
        foreach ($ulazniQueryPdv as $racun) {
            $primljeniTrenutniMjesecSuma += $racun->ukupna_cijena_sa_pdv_popust;
        }

        foreach ($ulazniQueryPoredjenje as $racun) {
            $ulazniPoredjenjeSuma += $racun->ukupna_cijena_sa_pdv_popust;
        }

        $informacije = [
            'blagajna' => (int) $blagajna,
            'depozit' => $depozit,
            'naplaceno' => (int) $naplaceno,
            'ceka_se_uplata' => (int) $cekaSeUplata,
            'nije_moguce_naplatiti' => (int) $nijeMogucePlatiti,
            'izdati_racuni' => (int) $izdatiTrenutniMjesecSuma,
            'izlazni_poredjenje_pdv' => $izlazniPoredjenjeSuma,
            'primljeni_racuni' => $primljeniTrenutniMjesecSuma,
            'ulazni_poredjenje_pdv' => $ulazniPoredjenjeSuma,
            'PDV_na_izlaznim_racunima' => (int) $izlazniUkupnaSuma,
            'PDV_na_ulaznim_racunima' => (int) $ulazniUkupnaSuma,
            'najveci_kupci' => '',
            'najveci_duznici' => '',
        ];

        return response()->json($informacije);
    }
}
