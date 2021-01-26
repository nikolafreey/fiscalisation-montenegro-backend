<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProizvodjacRobe;
use App\Models\ProizvodjacRobe;
use App\Models\User;
use Illuminate\Http\Request;

class ProizvodjacRobeController extends Controller
{
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
// <<<<<<< HEAD
        $proizvodjacRobe->user_id = '60897ef2-14ed-415d-ba62-13e1955afbe3';
// =======
//         $proizvodjacRobe->user_id = auth()->id();
//         $user = User::find(auth()->id())->load('preduzeca');
//         $proizvodjacRobe->preduzece_id = $user['preduzeca'][0]->id;
// >>>>>>> 12d9d1ab1979836c1f71029393716ed3125acc53
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
