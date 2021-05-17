<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreCijenaRobe;
use App\Models\CijenaRobe;

class CijenaRobeController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(CijenaRobe::class, 'cijenaRobe');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CijenaRobe::filterByPermissions()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCijenaRobe $request)
    {
        $cijenaRobe = CijenaRobe::make($request->validated());
        $cijenaRobe->user_id = auth()->id();
        $cijenaRobe->preduzece_id = getAuthPreduzeceId($request);
        $cijenaRobe->save();

        return response()->json($cijenaRobe, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CijenaRobe  $cijenaRobe
     * @return \Illuminate\Http\Response
     */
    public function show(CijenaRobe $cijenaRobe)
    {
        return response()->json($cijenaRobe, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CijenaRobe  $cijenaRobe
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCijenaRobe $request, CijenaRobe $cijenaRobe)
    {
        $cijenaRobe->update($request->validated());
        $cijenaRobe->response()->json($cijenaRobe, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CijenaRobe  $cijenaRobe
     * @return \Illuminate\Http\Response
     */
    public function destroy(CijenaRobe $cijenaRobe)
    {
        $cijenaRobe->delete();

        return response()->json($cijenaRobe, 200);
    }
}
