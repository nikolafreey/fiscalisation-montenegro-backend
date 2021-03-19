<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAtributRobe;
use App\Models\AtributRobe;
use App\Models\Preduzece;
use App\Models\User;
use Illuminate\Http\Request;

class AtributRobeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(AtributRobe::class, 'atributRobe');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        auth()->user()->can('view AtributRobe');

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
        auth()->user()->can('store AtributRobe');

        $atributRobe = AtributRobe::make($request->validated());
        $atributRobe->preduzece_id = Preduzece::all()->first()->id;
        $atributRobe->user_id = auth()->id();
        $user = User::find(auth()->id())->load('preduzeca');
        $atributRobe->preduzece_id = $user['preduzeca'][0]->id;
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
        auth()->user()->can('show AtributRobe');

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
        auth()->user()->can('update AtributRobe');

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
        auth()->user()->can('destroy AtributRobe');

        $atributRobe->delete();
        return response()->json($atributRobe, 200);
    }
}
