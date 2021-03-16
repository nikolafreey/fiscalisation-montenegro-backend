<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOvlascenoLice;
use App\Models\Modul;
use App\Models\OvlascenoLice;
use Illuminate\Http\Request;

class OvlascenoLiceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(OvlascenoLice::class, 'ovlascenoLice');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OvlascenoLice::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOvlascenoLice $request)
    {
        $ovlascenoLice = OvlascenoLice::create($request->all());

        return response()->json($ovlascenoLice, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OvlascenoLice  $ovlascenoLice
     * @return \Illuminate\Http\Response
     */
    public function show(OvlascenoLice $ovlascenoLice)
    {
        return response()->json($ovlascenoLice, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OvlascenoLice  $ovlascenoLice
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOvlascenoLice $request, OvlascenoLice $ovlascenoLice)
    {
        $ovlascenoLice->update($request->all());

        return response()->json($ovlascenoLice, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OvlascenoLice  $ovlascenoLice
     * @return \Illuminate\Http\Response
     */
    public function destroy(OvlascenoLice $ovlascenoLice)
    {
        $ovlascenoLice->delete();

        return response()->json($ovlascenoLice, 200);
    }
}
