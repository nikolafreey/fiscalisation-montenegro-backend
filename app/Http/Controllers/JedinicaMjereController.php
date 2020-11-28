<?php

namespace App\Http\Controllers;

use App\Models\JedinicaMjere;
use Illuminate\Http\Request;

class JedinicaMjereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return JedinicaMjere::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JedinicaMjere  $jedinicaMjere
     * @return \Illuminate\Http\Response
     */
    public function show(JedinicaMjere $jedinicaMjere)
    {
        return $jedinicaMjere;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JedinicaMjere  $jedinicaMjere
     * @return \Illuminate\Http\Response
     */
    public function edit(JedinicaMjere $jedinicaMjere)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JedinicaMjere  $jedinicaMjere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JedinicaMjere $jedinicaMjere)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JedinicaMjere  $jedinicaMjere
     * @return \Illuminate\Http\Response
     */
    public function destroy(JedinicaMjere $jedinicaMjere)
    {
        //
    }
}
