<?php

namespace App\Http\Controllers;

use App\Models\FizickoLice;
use Illuminate\Http\Request;

class FizickoLiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FizickoLice::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fizickoLice = FizickoLice::create($request->all());

        return response()->json($fizickoLice, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FizickoLice  $fizickoLice
     * @return \Illuminate\Http\Response
     */
    public function show(FizickoLice $fizickoLice)
    {
        return $fizickoLice;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FizickoLice  $fizickoLice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FizickoLice $fizickoLice)
    {
        $fizickoLice->update($request->all());

        return response()->json($fizickoLice, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FizickoLice  $fizickoLice
     * @return \Illuminate\Http\Response
     */
    public function destroy(FizickoLice $fizickoLice)
    {
        $fizickoLice->delete();

        return response()->json($fizickoLice, 200);
    }
}
