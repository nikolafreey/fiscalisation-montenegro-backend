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

        $izlazniUkupnaSuma = $izlazniQueryAll
                                ->filterByPermissions()
                                ->where('tip_racuna', Racun::RACUN)->whereNotNull('jikr')
                                ->sum('ukupan_iznos_pdv') ?? 0;

        $izdatiTrenutniMjesecSuma = $izlazniQuery
                                ->filterByPermissions()
                                ->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")
                                ->where('tip_racuna', Racun::RACUN)
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

        $ulazniUkupnaSuma = $ulazniQueryAll
                                ->where('tip_racuna', UlazniRacun::RACUN)
                                ->sum('ukupan_iznos_pdv') ?? 0;

        $primljeniTrenutniMjesecSuma = $ulazniQuery
                            ->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")
                            ->where('tip_racuna', UlazniRacun::RACUN)
                            ->sum('ukupan_iznos_pdv') ?? 0;

        $ulazniQueryPoredjenje = DB::select(DB::raw('SELECT * FROM `ulazni_racuni` WHERE datum_izdavanja BETWEEN "' . $prethodniMjesec . '" AND "' . $prviUMjesecu . '"'));

        $ulazniPoredjenjeSuma = 0;
        foreach ($ulazniQueryPoredjenje as $racun) {
            $ulazniPoredjenjeSuma += $racun->ukupna_cijena_sa_pdv_popust;
        }

        // Najveci kupci
        $liceKupac1 = null;
        $liceKupac2 = null;
        $liceKupac3 = null;
        $kupac1 = null;
        $kupac2 = null;
        $kupac3 = null;

        $cijena1 = 0;
        foreach ($preduzece->fizicka_lica_partneri as $partner) {
            $sum1 = $partner->racuni()->where('status', 'placen')->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")->sum('ukupna_cijena_sa_pdv_popust');

            if ($cijena1 <= $sum1) {
                $cijena1 = (int) $sum1;
                $kupac1 = $partner->fizicko_lice;
            }
        }

        $liceKupac1 = [
            'lice' => $kupac1,
            'cijena' => $cijena1
        ];

        if ($preduzece->fizicka_lica_partneri()->where('fizicko_lice_id', '!=', $kupac1->id)->exists()) {

            $cijena2 = 0;
            foreach ($preduzece->fizicka_lica_partneri->where('fizicko_lice_id', '!=', $kupac1->id) as $partner) {
                $sum2 = $partner->racuni()->where('status', 'placen')->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")->sum('ukupna_cijena_sa_pdv_popust');

                if ($cijena2 <= $sum2) {
                    $cijena2 = (int) $sum2;
                    $kupac2 = $partner->fizicko_lice;
                }
            }

            $liceKupac2 = [
                'lice' => $kupac2,
                'cijena' => $cijena2
            ];

            if ($preduzece->fizicka_lica_partneri()->where('fizicko_lice_id', '!=', $kupac1->id)->where('fizicko_lice_id', '!=', $kupac2->id)->exists()) {

                $cijena3 = 0;
                foreach ($preduzece->fizicka_lica_partneri->where('fizicko_lice_id', '!=', $kupac1->id)->where('fizicko_lice_id', '!=', $kupac2->id) as $partner) {
                    $sum3 = $partner->racuni()->where('status', 'placen')->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")->sum('ukupna_cijena_sa_pdv_popust');

                    if ($cijena3 <= $sum3) {
                        $cijena3 = (int) $sum3;
                        $kupac3 = $partner->fizicko_lice;
                    }
                }

                $liceKupac3 = [
                    'lice' => $kupac3,
                    'cijena' => $cijena3
                ];
            }
        }

        // Najveci duznici
        $liceDuznik1 = null;
        $liceDuznik2 = null;
        $liceDuznik3 = null;
        $duznik1 = null;
        $duznik2 = null;
        $duznik3 = null;

        $dug1 = 0;
        foreach ($preduzece->fizicka_lica_partneri as $partner) {
            $sum1 = $partner->racuni()->where('status', 'nijeplacen')->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")->sum('ukupna_cijena_sa_pdv_popust');

            if ($dug1 <= $sum1) {
                $dug1 = (int) $sum1;
                $duznik1 = $partner->fizicko_lice;
            }
        }

        $liceDuznik1 = [
            'lice' => $duznik1,
            'dug' => $dug1
        ];

        if ($preduzece->fizicka_lica_partneri()->where('fizicko_lice_id', '!=', $duznik1->id)->exists()) {

            $dug2 = 0;
            foreach ($preduzece->fizicka_lica_partneri->where('fizicko_lice_id', '!=', $duznik1->id) as $partner) {
                $sum2 = $partner->racuni()->where('status', 'nijeplacen')->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")->sum('ukupna_cijena_sa_pdv_popust');

                if ($dug2 <= $sum2) {
                    $dug2 = (int) $sum2;
                    $duznik2 = $partner->fizicko_lice;
                }
            }

            $liceDuznik2 = [
                'lice' => $duznik2,
                'dug' => $dug2
            ];

            if ($preduzece->fizicka_lica_partneri()->where('fizicko_lice_id', '!=', $duznik1->id)->where('fizicko_lice_id', '!=', $duznik2->id)->exists()) {

                $dug3 = 0;
                foreach ($preduzece->fizicka_lica_partneri->where('fizicko_lice_id', '!=', $duznik1->id)->where('fizicko_lice_id', '!=', $duznik2->id) as $partner) {
                    $sum3 = $partner->racuni()->where('status', 'nijeplacen')->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")->sum('ukupna_cijena_sa_pdv_popust');

                    if ($dug3 <= $sum3) {
                        $dug3 = (int) $sum3;
                        $duznik3 = $partner->fizicko_lice;
                    }
                }

                $liceDuznik3 = [
                    'lice' => $duznik3,
                    'dug' => $dug3
                ];
            }
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
            'najveci_kupci' => [$liceKupac1, $liceKupac2, $liceKupac3],
            'najveci_duznici' => [$liceDuznik1, $liceDuznik2, $liceDuznik3]
        ];

        return response()->json($informacije);
    }
}
