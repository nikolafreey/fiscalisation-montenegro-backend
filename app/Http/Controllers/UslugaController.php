<?php

namespace App\Http\Controllers;

use App\Models\Usluga;
use Illuminate\Http\Request;

class UslugaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Usluga::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usluga = Usluga::make($request->all());
        $usluga->user_id = auth()->id();
        
        return response()->json($usluga->save(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usluga  $usluga
     * @return \Illuminate\Http\Response
     */
    public function show(Usluga $usluga)
    {
        return response()->json($usluga, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usluga  $usluga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usluga $usluga)
    {
        $usluga->update($request->all());
        return response()->json($usluga, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usluga  $usluga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usluga $usluga)
    {
        $usluga->delete();
        return response()->json($usluga, 200);
    }
}
