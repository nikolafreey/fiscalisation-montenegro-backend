<?php

namespace App\Http\Controllers;

use App\Models\UlazniRacun;
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
        $query = UlazniRacun::filter($request);

        $paginatedData = $query->paginate();

        $paginatedData['ukupna_cijena'] = UlazniRacun::izracunajUkupnuCijenu($query);

        return $paginatedData;
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
