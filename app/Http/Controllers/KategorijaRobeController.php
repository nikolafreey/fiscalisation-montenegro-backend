<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreKategorijaRobe;
use App\Models\KategorijaRobe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategorijaRobeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(KategorijaRobe::class, 'kategorijaRobe');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return KategorijaRobe::filterByPermissions()->with('podkategorije_robe:id,naziv,kategorija_id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKategorijaRobe $request)
    {
        $kategorijaRobe = KategorijaRobe::make($request->validated());
        $kategorijaRobe->user_id = auth()->id();

        $kategorijaRobe->preduzece_id = getAuthPreduzeceId($request);
        $kategorijaRobe->save();

        return response()->json($kategorijaRobe, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategorijaRobe  $kategorijaRobe
     * @return \Illuminate\Http\Response
     */
    public function show(KategorijaRobe $kategorijaRobe)
    {
        return response()->json($kategorijaRobe, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategorijaRobe  $kategorijaRobe
     * @return \Illuminate\Http\Response
     */
    public function update(StoreKategorijaRobe $request, KategorijaRobe $kategorijaRobe)
    {
        $kategorijaRobe->update($request->validated());
        $kategorijaRobe->user_id = auth()->id();

        return response()->json($kategorijaRobe, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategorijaRobe  $kategorijaRobe
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategorijaRobe $kategorijaRobe)
    {
        $kategorijaRobe->delete();

        return response()->json($kategorijaRobe, 200);
    }
}
