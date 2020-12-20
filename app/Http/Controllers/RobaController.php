<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoba;
use App\Models\Roba;
use App\Models\RobaKategorijaPodKategorija;
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

    public function robaRacuni()
    {
        return RobaKategorijaPodKategorija::with('robe:id,naziv,opis,ean,status', 'kategorije_roba:id,naziv,popust_procenti,popust_iznos', 'podkategorije_roba:id,naziv,popust_procenti,popust_iznos', 'robe.jedinica_mjere:id,naziv', 'robe.cijene_roba:id,roba_id,cijena_bez_pdv,ukupna_cijena,porez_id', 'robe.cijene_roba.porez:id,naziv,stopa')->paginate();
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
        $roba->user_id = auth()->id();
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
