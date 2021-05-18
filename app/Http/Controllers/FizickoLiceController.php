<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreFizickoLice;
use App\Models\FizickoLice;
use App\Models\Partner;
use App\Models\ZiroRacun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FizickoLiceController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(FizickoLice::class, 'fizickoLice');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            return FizickoLice::search($request->search . '*')->query(function ($query) {
                return $query->filterByPermissions();
            })->paginate();
        }

        return FizickoLice::filterByPermissions()->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFizickoLice $request)
    {
        // TODO: ubaciti u Partnere
        // DB::transaction(function () use ($request) {}
        // ubaciti oba

        $fizickoLice = DB::transaction(function () use ($request) {
            $fizickoLice = FizickoLice::make($request->validated());

            $fizickoLice->user_id = auth()->id();
            $fizickoLice->preduzece_id = getAuthPreduzeceId($request);

            if (count($request->ziro_racuni) !== 0) {
                $ziro_racuni = $request->ziro_racuni;
                foreach ($ziro_racuni as $ziro_racun) {
                    $ziro_racuni_objects[] = new ZiroRacun($ziro_racun);
                }
                $fizickoLice->ziro_racuni()->saveMany($ziro_racuni_objects);
            }

            $fizickoLice->save();

            //Dodavanje Fizickog Lica u Partnere:
            $partner = Partner::make(
                [
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now(),
                    "kontakt_ime" => $fizickoLice->ime,
                    "kontakt_prezime" => $fizickoLice->prezime,
                    "fizicko_lice_id" => $fizickoLice->id,
                ]
            );
            $partner->user_id = auth()->id();
            $partner->preduzece_id = getAuthPreduzeceId($request);

            $partner->save();

            return collect(["fizicko_lice" => $fizickoLice, "partner" => $partner]);
        });

        return response()->json($fizickoLice, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FizickoLice  $fizickoLice
     * @return \Illuminate\Http\Response
     */
    public function show(FizickoLice $fizickoLice)
    {
        return $fizickoLice->load('ziro_racuni', 'preduzeca');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FizickoLice  $fizickoLice
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFizickoLice $request, FizickoLice $fizickoLice)
    {
        $fizickoLice->update($request->validated());

        $fizickoLice->ziro_racuni()->delete();
        $ziro_racuni = $request->ziro_racuni;
        foreach ($ziro_racuni as $ziro_racun) {
            $ziro_racuni_objects[] = ZiroRacun::make($ziro_racun);
        }
        $fizickoLice->ziro_racuni()->saveMany($ziro_racuni_objects);

        return response()->json($fizickoLice, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FizickoLice  $fizickoLice
     * @return \Illuminate\Http\Response
     */
    public function destroy(FizickoLice $fizickoLice)
    {
        $fizickoLice->delete();

        return response()->json($fizickoLice, 200);
    }
}
