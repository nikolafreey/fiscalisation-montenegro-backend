<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOvlascenoLice;
use App\Http\Requests\StorePaket;
use App\Models\OvlascenoLice;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Paket::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaket $request)
    {
        $paket = Paket::create($request->all());

        return response()->json($paket, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show(Paket $paket)
    {
        return response()->json($paket, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(StorePaket $request, Paket $paket)
    {
        $paket->update($request->all());

        return response()->json($paket, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paket $paket)
    {
        $paket->delete();

        return response()->json($paket, 200);
    }
}
