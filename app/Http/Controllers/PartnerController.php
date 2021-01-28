<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartner;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $query = Partner::filter($request);

            $query = $query->with(['preduzece', 'fizicko_lice']);

            return $query->paginate(20);
        }

        $query = Partner::query();

        $query = $query->with(['preduzece', 'fizicko_lice']);

        return $query->paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartner $request)
    {
        $partner = Partner::make($request->validated());
        // <<<<<<< HEAD
        $partner->user_id = '60897ef2-14ed-415d-ba62-13e1955afbe3';
        // =======
        //         $partner->user_id = auth()->id();
        //         $user = User::find(auth()->id())->load('preduzeca');
        //         $partner->preduzece_id = $user['preduzeca'][0]->id;
        // >>>>>>> 12d9d1ab1979836c1f71029393716ed3125acc53
        $partner->save();

        return response()->json($partner, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        return response()->json($partner, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(StorePartner $request, Partner $partner)
    {
        $partner->update($request->validated());
        return response()->json($partner, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return response()->json($partner, 200);
    }
}
