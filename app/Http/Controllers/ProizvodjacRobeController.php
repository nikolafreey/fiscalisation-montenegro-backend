<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreProizvodjacRobe;
use App\Models\ProizvodjacRobe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProizvodjacRobeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ProizvodjacRobe::class, 'proizvodjacRobe');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProizvodjacRobe::get();
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

        $preduzece_id = DB::table('personal_access_tokens')
            ->where('token', getAccessToken($request))
            ->first()
            ->preduzece_id;

        $proizvodjacRobe->preduzece_id = $preduzece_id;
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
