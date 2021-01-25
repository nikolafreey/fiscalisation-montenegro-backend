<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePodKategorijaRobe;
use App\Models\PodKategorijaRobe;
use App\Models\Preduzece;
use App\Models\User;
use Illuminate\Http\Request;

class PodKategorijaRobeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PodKategorijaRobe::all();
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
// <<<<<<< HEAD
        $podKategorijaRobe->user_id = '60897ef2-14ed-415d-ba62-13e1955afbe3';
        $podKategorijaRobe->preduzece_id = Preduzece::all()->first()->id;
// =======
        // $podKategorijaRobe->user_id = auth()->id();
        // $user = User::find(auth()->id())->load('preduzeca');
        // $podKategorijaRobe->preduzece_id = $user['preduzeca'][0]->id;
        // $podKategorijaRobe->preduzece_id = Preduzece::all()->first()->id;
// >>>>>>> 12d9d1ab1979836c1f71029393716ed3125acc53

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
