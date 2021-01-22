<?php

namespace App\Http\Controllers;

use App\Models\UlazniRacun;
use App\Models\User;
use Illuminate\Http\Request;

class UlazniRacunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $searchQuery = UlazniRacun::search($request->search . '*');

            $paginatedSearch = $searchQuery
                ->with(
                    'partner:id,preduzece_id,fizicko_lice_id',
                    'partner.preduzece_id:id,kratki_naziv',
                    'partner.fizicko_lice:id,ime,prezime'
                )->with('partner.preduzece:id,kratki_naziv')->with('partner.preuzece:id,ime,prezime')->paginate();

            $ukupnaCijenaSearch =
                collect(["ukupna_cijena" => UlazniRacun::izracunajUkupnuCijenu($searchQuery)]);
            $searchData = $ukupnaCijenaSearch->merge($paginatedSearch);

            return $searchData;
        }

        if ($request->status || $request->startDate || $request->endDate) {
            $query = UlazniRacun::filter($request);

            $paginatedData = $query
                ->with(
                    'partner:id,preduzece_id,fizicko_lice_id',
                    'partner.preduzece_id:id,kratki_naziv',
                    'partner.fizicko_lice:id,ime,prezime'
                )->with('partner.preduzece:id,kratki_naziv')->with('partner.preuzece:id,ime,prezime')->paginate();
            $ukupnaCijena = collect(["ukupna_cijena" => UlazniRacun::izracunajUkupnuCijenu($query)]);
            $data = $ukupnaCijena->merge($paginatedData);

            return $data;
        }

        $queryAll = UlazniRacun::query();

        $paginatedData = $queryAll
            ->with(
                'partner:id,preduzece_id,fizicko_lice_id',
                'partner.preduzece:id,kratki_naziv',
                'partner.fizicko_lice:id,ime,prezime'
            )->paginate();
        $ukupnaCijena = collect(["ukupna_cijena" => UlazniRacun::izracunajUkupnuCijenu($queryAll)]);
        $data = $ukupnaCijena->merge($paginatedData);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ulazniracun = UlazniRacun::make($request->validated());
        $ulazniracun->user_id = auth()->id();
        $user = User::find(auth()->id())->load('preduzeca');
        $ulazniracun->preduzece_id = $user['preduzeca'][0]->id;
        $ulazniracun->save();

        $ulazniracun->kreirajStavke($request);

        return response()->json($ulazniracun, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UlazniRacun  $ulazniracun
     * @return \Illuminate\Http\Response
     */
    public function show(UlazniRacun $ulazniracun)
    {
        return $ulazniracun->load(['ulazne_stavke', 'porezi']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UlazniRacun  $ulazniracun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UlazniRacun $ulazniracun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UlazniRacun  $ulazniracun
     * @return \Illuminate\Http\Response
     */
    public function destroy(UlazniRacun $ulazniracun)
    {
        //
    }
}
