<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreTipAtributa;
use App\Models\TipAtributa;
use Illuminate\Http\Request;

class TipoviAtributaController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(TipAtributa::class, 'tipAtributa');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipAtributa::filterByPermissions()->with('atributi:id,naziv,tip_atributa_id')->get(['id', 'naziv']);
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
        $tipAtributa->user_id = auth()->id();

        $tipAtributa->preduzece_id = getAuthPreduzeceId($request);
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
