<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAtributRobe;
use App\Models\AtributRobe;
use App\Models\Preduzece;
use App\Models\User;
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
//<<<<<<< HEAD
        $atributRobe->user_id = '60897ef2-14ed-415d-ba62-13e1955afbe3';
        $atributRobe->preduzece_id = Preduzece::all()->first()->id;
//=======
//        $atributRobe->user_id = auth()->id();
//        $user = User::find(auth()->id())->load('preduzeca');
//        $atributRobe->preduzece_id = $user['preduzeca'][0]->id;
//        // $atributRobe->preduzece_id = Preduzece::all()->first()->id;
//>>>>>>> 12d9d1ab1979836c1f71029393716ed3125acc53


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
