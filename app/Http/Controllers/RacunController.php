<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRacun;
use App\Models\AtributRobe;
use App\Models\Grupa;
use App\Models\KategorijaRobe;
use App\Models\Racun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use ScoutElastic\Searchable;
use Carbon\Carbon;

class RacunController extends Controller
{
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
                    'partner.preduzece_id:id,kratki_naziv',
                    'partner.fizicko_lice:id,ime,prezime'
                )->with('partner.preduzece:id,kratki_naziv')->with('partner.preduzece:id,ime,prezime')->paginate(10);

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

    public function racuniPdv(Request $request)
    {
        $query = Racun::query();

        $queryPdv = $query->where('datum_izdavanja', '>=', Carbon::now()->subMonth())->where('tip_racuna', Racun::RACUN)->get();

        $ukupnaSuma = 0;

        foreach ($queryPdv as $racun) {
            $ukupnaSuma += $racun->ukupan_iznos_pdv;
        }

        $ukupniPdv = collect(["ukupan_iznos_pdv" => $ukupnaSuma]);

        return $ukupniPdv;
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

            $racun->user_id = auth()->id();
            $user = User::find(auth()->id())->load('preduzeca');
            $racun->preduzece_id = $user['preduzeca'][0]->id;
            $racun->save();

            $racun->kreirajStavke($request);
            Log::info('suma: ' . var_export($racun->izracunajUkupneCijene(), true));

            $racun->izracunajUkupneCijene();
            $racun->izracunajPoreze();

            return $racun;
        });
        return response()->json($racun->load('porezi', 'stavke'), 201);
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
