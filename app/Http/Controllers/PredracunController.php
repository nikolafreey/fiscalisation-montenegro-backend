<?php

namespace App\Http\Controllers;

use App\Models\Racun;
use Illuminate\Http\Request;

class PredracunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Racun::filter($request);

        $query = $query->where('tip_racuna', Racun::PREDRACUN);

        $paginatedData = $query->paginate();
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
    public function store(Request $request)
    {
        $racun = Racun::make($request->validated());
        $racun->tip_racuna = Racun::PREDRACUN;
        $racun->user_id = auth()->id();
        $racun->save();

        $racun->kreirajStavke($request);

        return response()->json($racun, 201);
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
}
