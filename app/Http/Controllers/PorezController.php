<?php

namespace App\Http\Controllers;

use App\Models\Porez;
use Illuminate\Http\Request;

class PorezController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Porez::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Porez  $porez
     * @return \Illuminate\Http\Response
     */
    public function show(Porez $porez)
    {
        return $porez;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Porez  $porez
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Porez $porez)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Porez  $porez
     * @return \Illuminate\Http\Response
     */
    public function destroy(Porez $porez)
    {
        //
    }
}
