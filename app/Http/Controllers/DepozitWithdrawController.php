<?php

namespace App\Http\Controllers;

use App\Jobs\Depozit;
use App\Models\CijenaRobe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DepozitWithdraw;
use App\Http\Requests\StoreDepozitWithdraw;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DepozitWithdrawController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(DepozitWithdraw::class, 'depozit-withdraw');
    }

    public function index()
    {
        return DepozitWithdraw::paginate();
    }

    public function store(StoreDepozitWithdraw $request)
    {
        $depozitWithdraw = DepozitWithdraw::create($request->all());

        $depozitWithdraw->user_id = auth()->id();
        $user = User::find(auth()->id())->load(['preduzeca', 'preduzeca.poslovne_jedinice']);

        $depozitWithdraw->preduzece_id = $user['preduzeca'][0]->id;
        $depozitWithdraw->poslovna_jedinica_id = $user['preduzeca'][0]['poslovne_jedinice'][0]->id;
        $depozitWithdraw->save();

        if ($depozitWithdraw->iznos_depozit > 0) {
            Depozit::dispatch($depozitWithdraw);
        }

        // if($depozitWithdraw->iznos_withdraw > 0) {
        //     Withdraw::dispatch($depozitWithdraw);
        // }

        return response()->json($depozitWithdraw);
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

        return DB::select(DB::raw('SELECT iznos_depozit FROM `depozit_withdraws` WHERE deleted_at IS NULL AND created_at BETWEEN "' . $pocetakDana . '" AND "' . $krajDana . '"'));
        // return DepozitWithdraw::whereBetween('created_at', ["2021-03-02 00:00:00", "2021-03-02 23:59:59"])->get(); ?? Zasto ne radi?
    }
}
