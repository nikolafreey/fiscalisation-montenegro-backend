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
            return Preduzece::search($request->search . '*')->query(function ($query) {
                return $query->filterByPermissions();
            })->paginate();
        }

        return Preduzece::with('partneri', 'ziro_racuni:id,preduzece_id,broj_racuna')->paginate();
    }

    /**
     * Čuvanje resursa
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
    public function update(StorePreduzece $request, Preduzece $preduzece)
    {
        if (
            !auth()->user()->hasRole('Vlasnik')
            &&
            !auth()->user()->preduzeca()->where('preduzeca.id', $preduzece->id)->exists()
        ) {
            return response()->json('Nemate pristup ovom preduzecu', 401);
        }

        $preduzece->update($request->validated());

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
            !auth()->user() - hasRole('Vlasnik')
            &&
            !auth()->user()->preduzeca()->where('preduzeca.id', $preduzece->id)->exists()
        ) {
            abort(403);
        }

        $preduzece->delete();

        return response()->json($preduzece, 200);
    }
}
