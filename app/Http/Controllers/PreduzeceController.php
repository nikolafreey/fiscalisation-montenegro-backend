<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StorePreduzece;
use App\Models\Preduzece;
use Illuminate\Http\Request;

/**
 * @group Preduzece
 *
 * Class PreduzeceController
 * @package App\Http\Controllers
 */

class PreduzeceController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Preduzece::class, 'preduzece');
    // }

    /**
     * Izlistavanje resursa
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            return Preduzece::search($request->search . '*')->with('partneri', 'ziro_racuni:id,preduzece_id,broj_racuna')->paginate(50);
        }

        return Preduzece::with('partneri', 'ziro_racuni:id,preduzece_id,broj_racuna')->paginate(15);
    }

    /**
     * Čuvanje resursa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreduzece $request)
    {
        // \Log::info($request);
        // return;

        $preduzece = Preduzece::make($request->validated());
        $preduzece->save();

        return response()->json($preduzece, 201);
    }

    /**
     * Prikaz resursa
     *
     * @param  \App\Models\Preduzece  $preduzece
     * @return \Illuminate\Http\Response
     */
    public function show(Preduzece $preduzece)
    {
        return response()->json($preduzece->load('ovlascena_lica', 'djelatnosti', 'kategorija'), 200);
    }

    /**
     * Izmjena resursa
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preduzece  $preduzece
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preduzece $preduzece)
    {
        if (
            !auth()->user()->hasRole('Vlasnik')
            &&
            !auth()->user()->preduzeca()->where('preduzeca.id', $preduzece->id)->exists()
        ) {
            return response()->json('Nemate pristup ovom preduzecu', 401);
        }

        if ($preduzece->verifikovan === 1) {
            return response()->json('Ne mozete mijenjati verifikovano preduzece!', 403);
        }

        $preduzece->update($request->all());

        return response()->json($preduzece, 200);
    }

    /**
     * Brisanje resursa
     *
     * @param  \App\Models\Preduzece  $preduzece
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preduzece $preduzece)
    {
        if (
            !auth()->user()->hasRole('Vlasnik')
            &&
            !auth()->user()->preduzeca()->where('preduzeca.id', $preduzece->id)->exists()
        ) {
            abort(403);
        }

        $preduzece->delete();

        return response()->json($preduzece, 200);
    }
}
