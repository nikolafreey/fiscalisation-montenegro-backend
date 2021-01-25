<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategorijaRobe;
use App\Models\KategorijaRobe;
use App\Models\Preduzece;
use App\Models\User;
use Illuminate\Http\Request;

class KategorijaRobeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return KategorijaRobe::with('podkategorije_robe:id,naziv,kategorija_id')->get();
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
// <<<<<<< HEAD
        $kategorijaRobe->user_id = '60897ef2-14ed-415d-ba62-13e1955afbe3';
        $kategorijaRobe->preduzece_id = Preduzece::all()->first()->id;
// =======
        // $kategorijaRobe->user_id = auth()->id();
        // $user = User::find(auth()->id())->load('preduzeca');
        // $kategorijaRobe->preduzece_id = $user['preduzeca'][0]->id;
        // $kategorijaRobe->preduzece_id = Preduzece::all()->first()->id;
// >>>>>>> 12d9d1ab1979836c1f71029393716ed3125acc53

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
