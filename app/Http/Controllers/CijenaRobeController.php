<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCijenaRobe;
use App\Models\CijenaRobe;
use App\Models\User;
use Illuminate\Http\Request;

class CijenaRobeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CijenaRobe::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCijenaRobe $request)
    {
        $cijenaRobe = CijenaRobe::make($request->validated());
//<<<<<<< HEAD
        $cijenaRobe->user_id = '60897ef2-14ed-415d-ba62-13e1955afbe3';
//=======
//        $cijenaRobe->user_id = auth()->id();
//        $user = User::find(auth()->id())->load('preduzeca');
//        $cijenaRobe->preduzece_id = $user['preduzeca'][0]->id;
//>>>>>>> 12d9d1ab1979836c1f71029393716ed3125acc53
        $cijenaRobe->save();

        return response()->json($cijenaRobe, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CijenaRobe  $cijenaRobe
     * @return \Illuminate\Http\Response
     */
    public function show(CijenaRobe $cijenaRobe)
    {
        return response()->json($cijenaRobe, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CijenaRobe  $cijenaRobe
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCijenaRobe $request, CijenaRobe $cijenaRobe)
    {
        $cijenaRobe->update($request->validated());
        $cijenaRobe->response()->json($cijenaRobe, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CijenaRobe  $cijenaRobe
     * @return \Illuminate\Http\Response
     */
    public function destroy(CijenaRobe $cijenaRobe)
    {
        $cijenaRobe->delete();
        return response()->json($cijenaRobe, 200);
    }
}
