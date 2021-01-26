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
        //  dump(222);
        // dd(333);
        //var_dump(333);
        Log::info('ssssss', array($request->all()));
        //  dd($request);
        //    error_log('Some message here.');
        if ($request->search) {
            $searchQuery = Racun::search($request->search . '*');

            $paginatedSearch = $searchQuery
                ->with(
                    'partner:id,preduzece_id,fizicko_lice_id',
                    'partner.preduzece_id:id,kratki_naziv',
                    'partner.fizicko_lice:id,ime,prezime'
                )->with('partner.preduzece:id,kratki_naziv')->with('partner.preuzece:id,ime,prezime')->paginate(10);

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
            $racun->vrsta_racuna = Racun::GOTOVINSKI;
            $racun->broj_racuna = Racun::izracunajBrojRacuna();
            $racun->datum_izdavanja = now();
            // <<<<<<< HEAD
            $racun->user_id = '60897ef2-14ed-415d-ba62-13e1955afbe3';
            // =======
            //             $racun->user_id = auth()->id();
            //             $user = User::find(auth()->id())->load('preduzeca');
            //             $racun->preduzece_id = $user['preduzeca'][0]->id;
            // >>>>>>> 12d9d1ab1979836c1f71029393716ed3125acc53
            $racun->save();

            $racun->kreirajStavke($request);
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



        //   $racun = DB::transaction(function () use ($request) {


        // dd($request);
        //     $racun = Racun::make($request->validated());
        //     Log::info('USER: ' . var_export($racun, true));
        //     $racun->tip_racuna = Racun::RACUN;
        //     $racun->vrsta_racuna = Racun::GOTOVINSKI;

        //     $racun->broj_racuna = Racun::izracunajBrojRacuna();
        //     $racun->datum_izdavanja = now();
        //     // <<<<<<< HEAD
        //     $racun->user_id = '6d30d8d9-01e8-4b41-ba98-4d06af2aed31';
        //     $user = User::find('6d30d8d9-01e8-4b41-ba98-4d06af2aed31')->load('preduzeca');
        //     $racun->preduzece_id = $user['preduzeca'][0]->id;
        //     Log::info('RACUN: ' . var_export($racun, true));
        //     // =======
        //     //             $racun->user_id = auth()->id();
        //     //             $user = User::find(auth()->id())->load('preduzeca');
        //     //             $racun->preduzece_id = $user['preduzeca'][0]->id;
        //     // >>>>>>> 12d9d1ab1979836c1f71029393716ed3125acc53
        //     $racun->save();
        //     Log::info('prije: ' . var_export($racun->save(), true));

        //     $racun->kreirajStavke($request);
        //     $racun->izracunajUkupneCijene();
        //     $racun->izracunajPoreze();
        //     Log::info('kraj: ' . var_export($racun, true));

        //     return $racun;
        // });
        // return response()->json($racun->load('porezi', 'stavke'), 201);

        $racun->update($request->validated());
        return response()->json($racun, 200);
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
