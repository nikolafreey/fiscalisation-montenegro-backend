<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreDokument;
use App\Models\Dokument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return Dokument::filterByPermissions()->get();
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

        $dokument->user_id = auth()->id();

        $dokument->preduzece_id = getAuthPreduzeceId($request);

        $dokument->kategorija_dokumenta_id = $request->kategorija_dokumenta_id;

        $dokument->save();

        return response()->json($dokument, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokument  $dokument
     * @return \Illuminate\Http\Response
     */
    public function show(Dokument $dokument)
    {
        return response()->json($dokument, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokument  $dokument
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokument $dokument)
    {
        $dokument->delete();

        return response()->json($dokument, 200);
    }
}
