<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StorePartner;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Partner::class, 'partner');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search') || $request->has('filter')) {
            $query = Partner::filter($request);

            $query = $query->with(['preduzece', 'fizicko_lice', 'preduzece_partner']);

            return $query->paginate(20);
        }

        $query = Partner::query()->filterByPermissions();

        $query = $query->with(['preduzece', 'fizicko_lice', 'preduzece_partner']);

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
        $partner->user_id = auth()->id();

        $partner->preduzece_id = getAuthPreduzeceId($request);
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
