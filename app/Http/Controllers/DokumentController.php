<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreDokument;
use App\Http\Requests\Api\StoreKategorijaDokumenta;
use App\Models\Dokument;
use App\Models\KategorijaDokumenta;
use App\Models\User;
use Illuminate\Http\Request;

class DokumentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Dokument::class, 'dokument');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Dokument::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDokument $request)
    {
        $dokument = Dokument::make($request->validated());

        $user = auth()->user();

        $dokument->user_id = $user->id;

        $dokument->preduzece_id = $user->preduzeca()->where('preduzeca.id', $request->preduzece_id)->firstOrFail()->id;

        $dokument->kategorija_dokumenta_id = $request->kategorija_dokumenta_id;

        $dokument->save();

        return response()->json($dokument, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategorijaRobe  $kategorijaRobe
     * @return \Illuminate\Http\Response
     */
    public function show(Dokument $dokument)
    {
        return response()->json($dokument, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategorijaRobe  $kategorijaRobe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokument $dokument)
    {
        $dokument->delete();

        return response()->json($dokument, 200);
    }
}
