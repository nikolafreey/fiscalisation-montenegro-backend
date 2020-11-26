<?php

namespace App\Http\Controllers;

use App\Models\Kategorija;
use Illuminate\Http\Request;

class KategorijaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Kategorija::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kategorija = Kategorija::create($request->all());
        return response()->json($kategorija, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategorija  $kategorija
     * @return \Illuminate\Http\Response
     */
    public function show(Kategorija $kategorija)
    {
        return response()->json($kategorija, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategorija  $kategorija
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategorija $kategorija)
    {
        $kategorija->update($request->all());
        return response()->json($kategorija, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategorija  $kategorija
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategorija $kategorija)
    {
        $kategorija->delete();
        return response()->json($kategorija, 200);
    }
}
