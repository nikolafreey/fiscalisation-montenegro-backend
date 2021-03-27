<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StorePreduzece;
use App\Models\Preduzece;
use Illuminate\Http\Request;

class PreduzeceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Preduzece::class, 'preduzece');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            return Preduzece::search($request->search . '*')->paginate();
        }

        return Preduzece::with('partneri:id,preduzece_id,user_id', 'ziro_racuni:id,preduzece_id,broj_racuna')->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreduzece $request)
    {
        $preduzece = Preduzece::create($request->validated());

        return response()->json($preduzece, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Preduzece  $preduzece
     * @return \Illuminate\Http\Response
     */
    public function show(Preduzece $preduzece)
    {
        return response()->json($preduzece->load('ovlascena_lica'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preduzece  $preduzece
     * @return \Illuminate\Http\Response
     */
    public function update(StorePreduzece $request, Preduzece $preduzece)
    {
        if (
            ! auth()->user()-hasRole('vlasnik')
            &&
            ! auth()->user()->preduzeca()->where('preduzeca.id', $preduzece->id)->exists()
        )
        {
            abort(403);
        }

        $preduzece->update($request->validated());

        return response()->json($preduzece, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Preduzece  $preduzece
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preduzece $preduzece)
    {
        if (
            ! auth()->user()-hasRole('vlasnik')
            &&
            ! auth()->user()->preduzeca()->where('preduzeca.id', $preduzece->id)->exists()
        )
        {
            abort(403);
        }

        $preduzece->delete();

        return response()->json($preduzece, 200);
    }
}
