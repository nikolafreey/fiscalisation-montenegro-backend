<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRacun;
use App\Models\AtributRobe;
use App\Models\Grupa;
use App\Models\KategorijaRobe;
use App\Models\Racun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RacunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Racun::filter($request);

        $query = $query->where('tip_racuna', Racun::RACUN);

        $paginatedData = $query
            ->with(
                'partner:id,preduzece_id,fizicko_lice_id',
                'partner.preduzece:id,kratki_naziv',
                'partner.fizicko_lice:id,ime,prezime'
            )->paginate();
        $ukupnaCijena = collect(["ukupna_cijena" => Racun::izracunajUkupnuCijenu($query)]);
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
            $racun->user_id = auth()->id();
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
        return $racun->load(['stavke', 'porezi']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Racun  $racun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Racun $racun)
    {
        //
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

    public function getAtributiGrupe() {
        $tipovi_atributa = AtributRobe::get(['id AS tip_atributa_id', 'naziv'])->toArray();
        $grupe = Grupa::get(['id AS grupa_id', 'naziv'])->toArray();
        return array_merge($tipovi_atributa, $grupe);
    }
}
