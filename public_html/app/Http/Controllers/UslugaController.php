<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsluga;
use App\Models\Usluga;
use App\Models\User;
use Illuminate\Http\Request;

class UslugaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $query = Usluga::search($request->search . '*');
        } else {
            $query = Usluga::query();
        }

        if ($request->has('grupa_id')) {
            $query = $query->where('grupa_id', $request->grupa_id);
        }

        return $query->with([
            'grupa:id,naziv,opis,popust_procenti,popust_iznos',
            'jedinica_mjere:id,naziv',
            'porez:id,naziv,stopa'
        ])->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsluga $request)
    {
        $usluga = Usluga::make($request->validated());
        // $usluga->user_id = '60897ef2-14ed-415d-ba62-13e1955afbe3';

        $usluga->user_id = auth()->id();
        $user = User::find(auth()->id())->load('preduzeca');
        $usluga->preduzece_id = $user['preduzeca'][0]->id;
        // >>>>>>> 12d9d1ab1979836c1f71029393716ed3125acc53
        $usluga->save();

        return response()->json($usluga->save(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usluga  $usluga
     * @return \Illuminate\Http\Response
     */
    public function show(Usluga $usluga)
    {
        return response()->json($usluga, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usluga  $usluga
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUsluga $request, Usluga $usluga)
    {
        $usluga->update($request->validated());
        return response()->json($usluga, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usluga  $usluga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usluga $usluga)
    {
        $usluga->delete();
        return response()->json($usluga, 200);
    }
}
