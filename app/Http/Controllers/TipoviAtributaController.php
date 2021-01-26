<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipAtributa;
use App\Models\Preduzece;
use App\Models\TipAtributa;
use App\Models\User;
use Illuminate\Http\Request;

class TipoviAtributaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipAtributa::with('atributi:id,naziv,tip_atributa_id')->get(['id', 'naziv']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipAtributa $request)
    {
        $tipAtributa = TipAtributa::make($request->validated());
// <<<<<<< HEAD
        $tipAtributa->user_id = '60897ef2-14ed-415d-ba62-13e1955afbe3';
        $tipAtributa->preduzece_id = Preduzece::all()->first()->id;
// =======
        // $tipAtributa->user_id = auth()->id();
        // $user = User::find(auth()->id())->load('preduzeca');
        // $tipAtributa->preduzece_id = $user['preduzeca'][0]->id;
        // $tipAtributa->preduzece_id = Preduzece::all()->first()->id;
// >>>>>>> 12d9d1ab1979836c1f71029393716ed3125acc53

        $tipAtributa->save();

        return response()->json($tipAtributa, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipAtributa  $TipAtributa
     * @return \Illuminate\Http\Response
     */
    public function show(TipAtributa $tipAtributa)
    {
        return response()->json($tipAtributa->atributi, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipAtributa  $TipAtributa
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTipAtributa $request, TipAtributa $tipAtributa)
    {
        $tipAtributa->update($request->validated());
        return response()->json($tipAtributa, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipAtributa  $TipAtributa
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipAtributa $tipAtributa)
    {
        $tipAtributa->delete();
        return response()->json($tipAtributa, 200);
    }
}
