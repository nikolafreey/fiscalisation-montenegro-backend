<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoba;
use App\Models\Roba;
use App\Models\RobaAtributRobe;
use App\Models\RobaKategorijaPodKategorija;
use App\Models\User;
use Illuminate\Http\Request;

class RobaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Roba::with('atributi_roba:id,naziv', 'proizvodjac_robe:id,naziv')->paginate();
    }

    public function robaRacuni(Request $request)
    {
        $query = RobaAtributRobe::filter($request);
        return $query->with([
            'roba:id,naziv,opis,ean,status',
            'atribut_robe:id,naziv,tip_atributa_id,popust_procenti,popust_iznos',
            'roba.jedinica_mjere:id,naziv',
            'roba.cijene_roba:id,roba_id,cijena_bez_pdv,ukupna_cijena,porez_id',
            'roba.cijene_roba.porez:id,naziv,stopa'
        ])->paginate();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoba $request)
    {
        $roba = Roba::make($request->validated());
        $roba->user_id = '60897ef2-14ed-415d-ba62-13e1955afbe3';
        $roba->user_id = auth()->id();
        $user = User::find(auth()->id())->load('preduzeca');
        $roba->preduzece_id = $user['preduzeca'][0]->id;
        $roba->save();

        $roba->storeKategorije($request->kategorije);
        $roba->storeCijene($request->all());

        $roba->storeAtributi($request->atributi);

        return response()->json($roba, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roba  $roba
     * @return \Illuminate\Http\Response
     */
    public function show(Roba $roba)
    {
        return response()->json($roba, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Roba  $roba
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoba $request, Roba $roba)
    {
        $roba->update($request->validated());
        return response()->json($roba, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roba  $roba
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roba $roba)
    {
        $roba->delete();
        return response()->json($roba, 200);
    }
}
