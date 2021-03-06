<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreDjelatnost;
use App\Models\Djelatnost;
use Illuminate\Http\Request;

class DjelatnostController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Djelatnost::class, 'djelatnost');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Djelatnost::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDjelatnost $request)
    {
        $djelatnost = Djelatnost::create($request->all());

        return response()->json($djelatnost, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Djelatnost  $djelatnost
     * @return \Illuminate\Http\Response
     */
    public function show(Djelatnost $djelatnost)
    {
        return response()->json($djelatnost, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Djelatnost  $djelatnost
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDjelatnost $request, Djelatnost $djelatnost)
    {
        $djelatnost->update($request->all());

        return response()->json($djelatnost, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Djelatnost  $djelatnost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Djelatnost $djelatnost)
    {
        $djelatnost->delete();

        return response()->json($djelatnost, 200);
    }
}
