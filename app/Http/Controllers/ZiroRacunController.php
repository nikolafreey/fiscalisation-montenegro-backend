<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreZiroRacun;
use App\Models\User;
use App\Models\ZiroRacun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZiroRacunController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(ZiroRacun::class, 'ziroRacun');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ZiroRacun::filterByPermissions()->get();
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
        $ziroRacun->user_id = auth()->id();

        $ziroRacun->preduzece_id = getAuthPreduzeceId($request);
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
