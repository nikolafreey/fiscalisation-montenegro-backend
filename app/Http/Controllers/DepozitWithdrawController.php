<?php

namespace App\Http\Controllers;

use App\Jobs\Depozit;
use App\Models\CijenaRobe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DepozitWithdraw;
use App\Http\Requests\Api\StoreDepozitWithdraw;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DepozitWithdrawController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(DepozitWithdraw::class, 'depozitWithdraw');
    }

    public function index()
    {
        return DepozitWithdraw::paginate();
    }

    public function store(StoreDepozitWithdraw $request)
    {
        $depozitWithdraw = DepozitWithdraw::create($request->validated());

        if ($depozitWithdraw->iznos_depozit > 0) {
            Depozit::dispatch($depozitWithdraw);
        }

        // if($depozitWithdraw->iznos_withdraw > 0) {
        //     Withdraw::dispatch($depozitWithdraw);
        // }

        return response()->json($depozitWithdraw, 201);
    }

    public function show(DepozitWithdraw $depozitWithdraw)
    {
        return response()->json($depozitWithdraw, 200);
    }

    public function update(StoreDepozitWithdraw $request, DepozitWithdraw $depozitWithdraw)
    {
        $depozitWithdraw->update($request->validated());

        return response()->json($depozitWithdraw, 200);
    }

    public function destroy(DepozitWithdraw $depozitWithdraw)
    {
        $depozitWithdraw->delete();

        return response()->json($depozitWithdraw, 200);
    }

    public function getDepozitToday()
    {
        $dan = Carbon::now()->day;
        $mjesec = Carbon::now()->month;
        $godina = Carbon::now()->year;

        $pocetakDana = "{$godina}-{$mjesec}-{$dan} 00:00:00";
        $krajDana = "{$godina}-{$mjesec}-{$dan} 23:59:59";

        return DB::select(DB::raw('SELECT iznos_depozit FROM `depozit_withdraws` WHERE created_at BETWEEN "' . $pocetakDana . '" AND "' . $krajDana . '"'));
        // return DepozitWithdraw::whereBetween('created_at', ["2021-03-02 00:00:00", "2021-03-02 23:59:59"])->get(); ?? Zasto ne radi?
    }
}
