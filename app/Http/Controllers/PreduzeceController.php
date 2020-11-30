<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePreduzece;
use App\Models\Preduzece;
use Illuminate\Http\Request;

class PreduzeceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Preduzece::paginate();
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     *
     * @param  \App\Models\Preduzece  $preduzece
     * @return \Illuminate\Http\Response
     */
    public function show(Preduzece $preduzece)
    {
        return response()->json($preduzece, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preduzece  $preduzece
     * @return \Illuminate\Http\Response
     */
    public function update(StorePreduzece $request, Preduzece $preduzece)
    {
        $preduzece->update($request->validated());
        return response()->json($preduzece, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Preduzece  $preduzece
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preduzece $preduzece)
    {
        $preduzece->delete();
        return response()->json($preduzece, 200);
    }
}
