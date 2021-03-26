<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreModul;
use App\Models\Kategorija;
use App\Models\Modul;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Modul::class, 'modul');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Modul::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModul $request)
    {
        $modul = Modul::create($request->all());

        return response()->json($modul, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modul  $modul
     * @return \Illuminate\Http\Response
     */
    public function show(Modul $modul)
    {
        return response()->json($modul, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modul  $modul
     * @return \Illuminate\Http\Response
     */
    public function update(StoreModul $request, Modul $modul)
    {
        $modul->update($request->all());

        return response()->json($modul, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modul  $modul
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modul $modul)
    {
        $modul->delete();

        return response()->json($modul, 200);
    }
}
