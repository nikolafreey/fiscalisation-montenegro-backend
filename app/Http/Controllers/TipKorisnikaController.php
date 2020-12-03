<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipKorisnika;
use App\Models\TipKorisnika;
use Illuminate\Http\Request;

class TipKorisnikaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipKorisnika::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipKorisnika $request)
    {
        $tipKorisnika = TipKorisnika::create($request->all());
        return response()->json($tipKorisnika, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipKorisnika  $tipKorisnika
     * @return \Illuminate\Http\Response
     */
    public function show(TipKorisnika $tipKorisnika)
    {
        return response()->json($tipKorisnika, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipKorisnika  $tipKorisnika
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTipKorisnika $request, TipKorisnika $tipKorisnika)
    {
        $tipKorisnika->update($request->all());
        return response()->json($tipKorisnika, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipKorisnika  $tipKorisnika
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipKorisnika $tipKorisnika)
    {
        $tipKorisnika->delete();
        return response()->json($tipKorisnika, 200);
    }
}
