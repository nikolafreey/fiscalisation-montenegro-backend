<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAtributRobe;
use App\Models\AtributRobe;
use App\Models\Preduzece;
use Illuminate\Http\Request;

class AtributRobeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AtributRobe::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAtributRobe $request)
    {
        $atributRobe = AtributRobe::make($request->validated());
        $atributRobe->user_id = auth()->id();
        $atributRobe->preduzece_id = Preduzece::all()->first()->id;


        $atributRobe->save();

        return response()->json($atributRobe, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AtributRobe  $atributRobe
     * @return \Illuminate\Http\Response
     */
    public function show(AtributRobe $atributRobe)
    {
        return response()->json($atributRobe, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AtributRobe  $atributRobe
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAtributRobe $request, AtributRobe $atributRobe)
    {
        $atributRobe->update($request->validated());
        return response()->json($atributRobe, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AtributRobe  $atributRobe
     * @return \Illuminate\Http\Response
     */
    public function destroy(AtributRobe $atributRobe)
    {
        $atributRobe->delete();
        return response()->json($atributRobe, 200);
    }
}
