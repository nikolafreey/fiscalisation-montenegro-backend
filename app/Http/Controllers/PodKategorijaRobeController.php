<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StorePodKategorijaRobe;
use App\Models\PodKategorijaRobe;
use Illuminate\Http\Request;

class PodKategorijaRobeController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(PodKategorijaRobe::class, 'podKategorijaRobe');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PodKategorijaRobe::filterByPermissions()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePodKategorijaRobe $request)
    {
        $podKategorijaRobe = PodKategorijaRobe::make($request->validated());
        $podKategorijaRobe->user_id = auth()->id();

        $podKategorijaRobe->preduzece_id = getAuthPreduzeceId($request);
        $podKategorijaRobe->save();

        return response()->json($podKategorijaRobe, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PodKategorijaRobe  $podKategorijaRobe
     * @return \Illuminate\Http\Response
     */
    public function show(PodKategorijaRobe $podKategorijaRobe)
    {
        return response()->json($podKategorijaRobe, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PodKategorijaRobe  $podKategorijaRobe
     * @return \Illuminate\Http\Response
     */
    public function update(StorePodKategorijaRobe $request, PodKategorijaRobe $podKategorijaRobe)
    {
        $podKategorijaRobe->update($request->validated());

        return response()->json($podKategorijaRobe, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PodKategorijaRobe  $podKategorijaRobe
     * @return \Illuminate\Http\Response
     */
    public function destroy(PodKategorijaRobe $podKategorijaRobe)
    {
        $podKategorijaRobe->delete();

        return response()->json($podKategorijaRobe, 200);
    }
}
