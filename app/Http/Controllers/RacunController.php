<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreRacun;
use App\Jobs\Fiskalizuj;
use App\Models\AtributRobe;
use App\Models\Grupa;
use App\Models\Racun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use ScoutElastic\Searchable;
use Carbon\Carbon;

class RacunController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Racun::class, 'racun');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use Searchable;

    public function index(Request $request)
    {
        Log::info('ssssss', array($request->all()));
        if ($request->search) {
            $searchQuery = Racun::search($request->search . '*');

            $paginatedSearch = $searchQuery
                ->with(
                    'partner:id,preduzece_id,fizicko_lice_id',
                    'partner.preduzece:id,kratki_naziv',
                    'partner.fizicko_lice:id,ime,prezime'
                )->with('partner.preduzece:id,kratki_naziv')->with('partner.fizicko_lice:id,ime,prezime')->paginate(10);

            $ukupnaCijenaSearch =
                collect(["ukupna_cijena" => Racun::izracunajUkupnuCijenu($searchQuery)]);
            $searchData = $ukupnaCijenaSearch->merge($paginatedSearch);

            return $searchData;
        }

        if ($request->status || $request->startDate || $request->endDate) {
            $query = Racun::filter($request);

            $query = $query->where('tip_racuna', Racun::RACUN);

            $paginatedData = $query
                ->with(
                    'partner:id,preduzece_id,fizicko_lice_id',
                    'partner.preduzece:id,kratki_naziv',
                    'partner.fizicko_lice:id,ime,prezime'
                )->with('partner.preduzece:id,kratki_naziv')->with('partner.fizicko_lice:id,ime,prezime')->paginate(10);
            $ukupnaCijena = collect(["ukupna_cijena" => Racun::izracunajUkupnuCijenu($query)]);
            $data = $ukupnaCijena->merge($paginatedData);

            return $data;
        }

        $queryAll = Racun::query();
        $queryAll = $queryAll->where('tip_racuna', Racun::RACUN);

        $paginatedData = $queryAll
            ->with(
                'partner:id,preduzece_id,fizicko_lice_id',
                'partner.preduzece:id,kratki_naziv',
                'partner.fizicko_lice:id,ime,prezime'
            )->paginate(10);
        $ukupnaCijena = collect(["ukupna_cijena" => Racun::izracunajUkupnuCijenu($queryAll)]);
        $data = $ukupnaCijena->merge($paginatedData);

        return $data;
    }

    public function najveciKupci(Request $request)
    {
        $data = DB::select(DB::raw("SELECT SUM(racuni.ukupan_iznos_pdv) AS ukupan_promet, preduzeca.*, racuni.* FROM racuni, preduzeca WHERE tip_racuna='racun' AND racuni.status = 'Plaćen' AND racuni.preduzece_id = preduzeca.id GROUP BY preduzeca.id ORDER BY ukupan_promet DESC LIMIT 3"));

        return $data;
    }

    public function najveciDuznici(Request $request)
    {
        $data = DB::select(DB::raw("SELECT SUM(racuni.ukupan_iznos_pdv) AS ukupan_promet, preduzeca.*, racuni.* FROM racuni, preduzeca WHERE tip_racuna='racun' AND racuni.status = 'Čeka se' AND racuni.preduzece_id = preduzeca.id GROUP BY preduzeca.id ORDER BY ukupan_promet DESC LIMIT 3"));

        return $data;
    }

    public function izlazniRacuniDanas(Request $request)
    {
        $dan = Carbon::now()->day;
        $mjesec = Carbon::now()->month;
        $godina = Carbon::now()->year;

        $pocetakDana = "{$godina}-{$mjesec}-{$dan} 00:00:00";
        $krajDana = "{$godina}-{$mjesec}-{$dan} 23:59:59";

        $queryRacuniDanas = Racun::query();

        $queryRacuniDanas = DB::select(DB::raw('SELECT * FROM racuni WHERE vrsta_racuna = "' . Racun::GOTOVINSKI . '" AND tip_racuna = "' . Racun::RACUN . '" AND datum_izdavanja BETWEEN "' . $pocetakDana . '" AND "' . $krajDana . '"'));

        $ukupnoRacuniDanas = 0;

        foreach ($queryRacuniDanas as $racunDanas) {
            $ukupnoRacuniDanas += $racunDanas->ukupna_cijena_sa_pdv;
        }

        return collect(['ukupno_izlazni_racuni_danas' => $ukupnoRacuniDanas]);
    }

    public function racuniPdv(Request $request)
    {
        $query = Racun::query();
        $queryAll = Racun::query();
        $queryPoredjenje = Racun::query();

        $dan = Carbon::now()->day;
        $mjesec = Carbon::now()->month;
        $godina = Carbon::now()->year;

        $prviUMjesecu = "{$godina}-{$mjesec}-1 00:00:00";
        $prviUMjesecu = Carbon::parse($prviUMjesecu);
        $prethodniMjesec = Carbon::parse($prviUMjesecu)->subMonthNoOverflow();

        $queryAllPdv = $queryAll->where('tip_racuna', Racun::RACUN)->get();
        $queryPdv = $query->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")->where('tip_racuna', Racun::RACUN)->get();
        $queryPoredjenje = DB::select(DB::raw('SELECT * FROM `racuni` WHERE datum_izdavanja BETWEEN "' . $prethodniMjesec . '" AND "' . $prviUMjesecu . '"'));

        $ukupnaSuma = 0;
        $poslednjiMjesecSuma = 0;
        $poredjenjeSuma = 0;

        foreach ($queryAllPdv as $racunPdv) {
            $ukupnaSuma += $racunPdv->ukupan_iznos_pdv;
        }

        foreach ($queryPdv as $racun) {
            $poslednjiMjesecSuma += $racun->ukupan_iznos_pdv;
        }

        foreach ($queryPoredjenje as $racun) {
            $poredjenjeSuma += $racun->ukupna_cijena_sa_pdv;
        }

        $data = collect(["ukupan_iznos_pdv" => $ukupnaSuma, "ukupan_iznos_poslednji_mjesec" => $poslednjiMjesecSuma, "poredjenje_pdv" => $poredjenjeSuma]);

        return $data;
    }

    public function racuniStatus(Request $request)
    {
        $queryP = Racun::query();
        $queryN = Racun::query();
        $queryC = Racun::query();

        $queryPlacen = $queryP->where('status', 'Plaćen')->where('tip_racuna', Racun::RACUN)->get();
        $queryNenaplativ = $queryN->where('status', 'Nenaplativ')->where('tip_racuna', Racun::RACUN)->get();
        $queryCekaSe = $queryC->where('status', 'Čeka se')->where('tip_racuna', Racun::RACUN)->get();

        $ukupnaCijenaPlacenSuma = 0;
        $ukupnaCijenaNenaplativSuma = 0;
        $ukupnaCijenaCekaSeSuma = 0;


        foreach ($queryPlacen as $racun) {
            $ukupnaCijenaPlacenSuma += $racun->ukupna_cijena_sa_pdv;
        }

        foreach ($queryNenaplativ as $racun) {
            $ukupnaCijenaNenaplativSuma += $racun->ukupna_cijena_sa_pdv;
        }

        foreach ($queryCekaSe as $racun) {
            $ukupnaCijenaCekaSeSuma += $racun->ukupna_cijena_sa_pdv;
        }

        $ukupnaCijenaPlacen = collect(["ukupna_cijena_placeni" => $ukupnaCijenaPlacenSuma]);
        $ukupnaCijenaNenaplativ = collect(["ukupna_cijena_nenaplativ" => $ukupnaCijenaNenaplativSuma]);
        $ukupnaCijenaCekaSe = collect(["ukupna_cijena_ceka_se" => $ukupnaCijenaCekaSeSuma]);

        $data = $ukupnaCijenaPlacen;
        $data = $data->merge($ukupnaCijenaCekaSe);
        $data = $data->merge($ukupnaCijenaNenaplativ);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRacun $request)
    {
        $racun = DB::transaction(function () use ($request) {
            $racun = Racun::make($request->validated());
            $racun->tip_racuna = Racun::RACUN;
            $racun->broj_racuna = Racun::izracunajBrojRacuna();
            $racun->datum_izdavanja = now();

            $user = auth()->user();
            $racun->user_id = $user->id;

            $preduzece = $user
                ->preduzeca()
                ->where('preduzeca.id', $request->preduzece_id)
                ->firstOrFail();

            $racun->preduzece_id = $preduzece->id;

            $poslovnaJedinica = $preduzece
                ->poslovne_jedinice()
                ->where('poslovne_jedinice.id', $request->poslovna_jedinica_id)
                ->firstOrFail();

            $racun->poslovna_jedinica_id = $poslovnaJedinica->id;

            $racun->save();

            $racun->kreirajStavke($request);
            Log::info('suma: ' . var_export($racun->izracunajUkupneCijene(), true));

            $racun->izracunajUkupneCijene();
            $racun->izracunajPoreze();

            return $racun;
        });

        Fiskalizuj::dispatch($racun);

        return response()->json($racun->fresh()->load('porezi', 'stavke'), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Racun  $racun
     * @return \Illuminate\Http\Response
     */
    public function show(Racun $racun)
    {
        return $racun->load(['stavke', 'porezi', 'partner', 'preduzece']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Racun  $racun
     * @return \Illuminate\Http\Response
     */

    public function update(StoreRacun $request, Racun $racun)
    {
        $ikof = $request->input('ikof');
        $jikr = $request->input('jikr');

        Log::info('update1: ' . var_export($request->input('jikr'), true));

        if (($ikof == null || $ikof == '') && ($jikr == null || $jikr == '')) {

            $racun->update($request->validated());
            return response()->json($racun, 200);
        } else {
            return response()->json($racun, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Racun  $racun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Racun $racun)
    {
        //
    }

    public function getAtributiGrupe()
    {
        $tipovi_atributa = AtributRobe::get(['id AS tip_atributa_id', 'naziv'])->toArray();
        $grupe = Grupa::get(['id AS grupa_id', 'naziv'])->toArray();
        return array_merge($tipovi_atributa, $grupe);
    }
}
