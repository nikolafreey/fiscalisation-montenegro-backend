<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFizickoLice;
use App\Models\FizickoLice;
use App\Models\ZiroRacun;
use Illuminate\Http\Request;

class FizickoLiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search){
            return FizickoLice::search($request->search . '*')->paginate();
        }
        return FizickoLice::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFizickoLice $request)
    {
        $fizickoLice = FizickoLice::create($request->validated());

        $ziro_racuni = $request->ziro_racuni;
        foreach($ziro_racuni as $ziro_racun) {
            $ziro_racuni_objects[] = new ZiroRacun($ziro_racun);
        }
        $fizickoLice->ziro_racuni()->saveMany($ziro_racuni_objects);

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
        return $fizickoLice->load('ziro_racuni');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FizickoLice  $fizickoLice
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFizickoLice $request, FizickoLice $fizickoLice)
    {
        $fizickoLice->update($request->validated());

        $fizickoLice->ziro_racuni()->delete();
        $ziro_racuni = $request->ziro_racuni;
        foreach($ziro_racuni as $ziro_racun) {
            $ziro_racuni_objects[] = ZiroRacun::make($ziro_racun);
        }
        $fizickoLice->ziro_racuni()->saveMany($ziro_racuni_objects);

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
