<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreProizvodjacRobe;
use App\Models\ProizvodjacRobe;
use Illuminate\Http\Request;

class ProizvodjacRobeController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(ProizvodjacRobe::class, 'proizvodjacRobe');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProizvodjacRobe::filterByPermissions()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProizvodjacRobe $request)
    {
        $proizvodjacRobe = ProizvodjacRobe::make($request->validated());
        $proizvodjacRobe->user_id = auth()->id();
        $proizvodjacRobe->preduzece_id = getAuthPreduzeceId($request);
        $proizvodjacRobe->save();

        return response()->json($proizvodjacRobe, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProizvodjacRobe  $proizvodjacRobe
     * @return \Illuminate\Http\Response
     */
    public function show(ProizvodjacRobe $proizvodjacRobe)
    {
        return response()->json($proizvodjacRobe, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProizvodjacRobe  $proizvodjacRobe
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProizvodjacRobe $request, ProizvodjacRobe $proizvodjacRobe)
    {
        $proizvodjacRobe->update($request->validated());

        return response()->json($proizvodjacRobe, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProizvodjacRobe  $proizvodjacRobe
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProizvodjacRobe $proizvodjacRobe)
    {
        $proizvodjacRobe->delete();

        return response()->json($proizvodjacRobe, 200);
    }
}
