<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreGrupa;
use App\Models\Grupa;
use Illuminate\Http\Request;

class GrupaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Grupa::class, 'grupa');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Grupa::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grupa = Grupa::make($request->all());

        $grupa->user_id = auth()->id();

        $grupa->preduzece_id = getAuthPreduzeceId($request);
        $grupa->save();

        return response()->json($grupa, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grupa  $grupa
     * @return \Illuminate\Http\Response
     */
    public function show(Grupa $grupa)
    {
        return $grupa;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grupa  $grupa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupa $grupa)
    {
        $grupa->update($request->validated());
        $grupa->user_id = auth()->id();

        return response()->json($grupa, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupa  $grupa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupa $grupa)
    {
    }
}
