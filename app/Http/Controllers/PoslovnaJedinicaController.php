<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoslovnaJedinica;
use App\Http\Requests\Api\StorePoslovnaJedinica;

class PoslovnaJedinicaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(PoslovnaJedinica::class, 'poslovnaJedinica');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PoslovnaJedinica::filterByPermissions()->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePoslovnaJedinica $request)
    {
        $poslovnaJedinica = PoslovnaJedinica::make($request->validated());

        $poslovnaJedinica->user_id = auth()->id();
        $poslovnaJedinica->preduzece_id = getAuthPreduzeceId($request);

        $poslovnaJedinica->save();

        return response()->json($poslovnaJedinica, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PoslovnaJedinica  $poslovnaJedinica
     * @return \Illuminate\Http\Response
     */
    public function show(PoslovnaJedinica $poslovnaJedinica)
    {
        return response()->json($poslovnaJedinica, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PoslovnaJedinica  $poslovnaJedinica
     * @return \Illuminate\Http\Response
     */
    public function update(StorePoslovnaJedinica $request, PoslovnaJedinica $poslovnaJedinica)
    {
        $poslovnaJedinica->update($request->validated());

        return response()->json($poslovnaJedinica, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PoslovnaJedinica  $poslovnaJedinica
     * @return \Illuminate\Http\Response
     */
    public function destroy(PoslovnaJedinica $poslovnaJedinica)
    {
        $poslovnaJedinica->delete();

        return response()->json($poslovnaJedinica, 200);
    }
}
