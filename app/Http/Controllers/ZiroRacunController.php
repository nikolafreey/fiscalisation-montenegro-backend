<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZiroRacun;
use App\Models\ZiroRacun;
use Illuminate\Http\Request;

class ZiroRacunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ZiroRacun::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreZiroRacun $request)
    {
        $ziroRacun = ZiroRacun::create($request->all());

        $ziroRacun->user_id = '60897ef2-14ed-415d-ba62-13e1955afbe3';
        $ziroRacun->save();

        return response()->json($ziroRacun, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ZiroRacun  $ziroRacun
     * @return \Illuminate\Http\Response
     */
    public function show(ZiroRacun $ziroRacun)
    {
        return response()->json($ziroRacun, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ZiroRacun  $ziroRacun
     * @return \Illuminate\Http\Response
     */
    public function update(StoreZiroRacun $request, ZiroRacun $ziroRacun)
    {
        $ziroRacun->update($request->all());
        return response()->json($ziroRacun, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ZiroRacun  $ziroRacun
     * @return \Illuminate\Http\Response
     */
    public function destroy(ZiroRacun $ziroRacun)
    {
        $ziroRacun->delete();
        return response()->json($ziroRacun, 200);
    }
}
