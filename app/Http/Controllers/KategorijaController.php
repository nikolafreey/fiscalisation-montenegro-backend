<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategorija;
use App\Models\JedinicaMjere;
use App\Models\Kategorija;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KategorijaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Kategorija::class, 'kategorija');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Kategorija::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKategorija $request)
    {
        $kategorija = Kategorija::create($request->all());
        $kategorija->updated_at = Carbon::now()->addHour();
        $kategorija->created_at = Carbon::now()->addHour();

        return response()->json($kategorija, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategorija  $kategorija
     * @return \Illuminate\Http\Response
     */
    public function show(Kategorija $kategorija)
    {
        return response()->json($kategorija->created_at->format('d-m-Y h:i:s A'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategorija  $kategorija
     * @return \Illuminate\Http\Response
     */
    public function update(StoreKategorija $request, Kategorija $kategorija)
    {
        $kategorija->update($request->all());
        $kategorija->updated_at = Carbon::now()->addHour();

        return response()->json($kategorija, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategorija  $kategorija
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategorija $kategorija)
    {
        $kategorija->delete();

        return response()->json($kategorija, 200);
    }
}
