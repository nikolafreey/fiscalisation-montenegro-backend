<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DepozitWithdraw;
use App\Http\Requests\StoreDepozitWithdraw;

class DepozitWithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DepozitWithdraw::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepozitWithdraw $request)
    {
        $depozitWithdraw = DepozitWithdraw::create($request->validated());
        return response()->json($depozitWithdraw, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DepozitWithdraw  $depozitWithdraw
     * @return \Illuminate\Http\Response
     */
    public function show(DepozitWithdraw $depozitWithdraw)
    {
        return response()->json($depozitWithdraw, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DepozitWithdraw  $depozitWithdraw
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDepozitWithdraw $request, DepozitWithdraw $depozitWithdraw)
    {
        $depozitWithdraw->update($request->validated());
        return response()->json($depozitWithdraw, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DepozitWithdraw  $depozitWithdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepozitWithdraw $depozitWithdraw)
    {
        $depozitWithdraw->delete();
        return response()->json($depozitWithdraw, 200);
    }
}
