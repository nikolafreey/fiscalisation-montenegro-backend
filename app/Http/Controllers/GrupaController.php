<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupa;
use App\Models\Grupa;
use Illuminate\Http\Request;

class GrupaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Grupa::all();
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
     * @param  \App\Models\Grupa  $grupa
     * @return \Illuminate\Http\Response
     */
    public function show(Grupa $grupa)
    {
        return $grupa;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grupa  $grupa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupa $grupa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupa  $grupa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupa $grupa)
    {
        //
    }
}
