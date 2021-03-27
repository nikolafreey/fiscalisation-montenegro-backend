<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreKategorijaDokumenta;
use App\Models\KategorijaDokumenta;
use App\Models\KategorijaRobe;
use App\Models\User;
use Illuminate\Http\Request;

class KategorijaDokumentaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(KategorijaDokumenta::class, 'kategorijaDokumenta');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return KategorijaDokumenta::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKategorijaDokumenta $request)
    {
        $kategorijaDokumenta = KategorijaDokumenta::create($request->validated());

        return response()->json($kategorijaDokumenta, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategorijaRobe  $kategorijaRobe
     * @return \Illuminate\Http\Response
     */
    public function show(KategorijaDokumenta $kategorijaDokumenta)
    {
        return response()->json($kategorijaDokumenta, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategorijaRobe  $kategorijaRobe
     * @return \Illuminate\Http\Response
     */
    public function update(StoreKategorijaDokumenta $request, KategorijaDokumenta $kategorijaDokumenta)
    {
        $kategorijaDokumenta->update($request->validated());

        return response()->json($kategorijaDokumenta, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategorijaRobe  $kategorijaRobe
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategorijaDokumenta $kategorijaDokumenta)
    {
        $kategorijaDokumenta->delete();

        return response()->json($kategorijaDokumenta, 200);
    }
}
