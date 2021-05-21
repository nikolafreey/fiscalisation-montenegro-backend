<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreDepozitWithdraw;
use App\Jobs\Depozit;
use App\Models\FailedJobsCustom;
use App\Models\DepozitWithdraw;
use Carbon\Carbon;

class DepozitWithdrawController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(DepozitWithdraw::class, 'depozit-withdraw');
    // }

    public function getDepozitToday()
    {
        $dan = Carbon::now()->day;
        $mjesec = Carbon::now()->month;
        $godina = Carbon::now()->year;

        $pocetakDana = "{$godina}-{$mjesec}-{$dan} 00:00:00";
        $krajDana = "{$godina}-{$mjesec}-{$dan} 23:59:59";

        return DepozitWithdraw::filterByPermissions()->whereDate('created_at', Carbon::today())->where('fiskalizovan', 1)->first();

        // return DB::select(DB::raw('SELECT iznos_depozit FROM `depozit_withdraws` WHERE created_at BETWEEN "' . $pocetakDana . '" AND "' . $krajDana . '" LIMIT 1'));
        // return DepozitWithdraw::whereBetween('created_at', ["2021-03-02 00:00:00", "2021-03-02 23:59:59"])->get(); ?? Zasto ne radi?
    }

    public function index()
    {
        return DepozitWithdraw::filterByPermissions()->paginate();
    }

    public function store(StoreDepozitWithdraw $request)
    {
        $depozitWithdraw = DepozitWithdraw::make($request->all());

        $depozitLoaded = $this->getDepozitToday();
        if ($depozitWithdraw->iznos_depozit != null) {
            if ($depozitLoaded) {
                return response()->json('Već je dodat depozit za današnji dan!', 400);
            }
        }

        if ($depozitWithdraw->iznos_withdraw != null) {
            $withdrawLoaded =
                DepozitWithdraw::filterByPermissions()->whereDate('created_at', Carbon::today())->where('iznos_withdraw', '!=', null)->first();
            if ($withdrawLoaded) {
                return response()->json('Već je podignut depozit za današnji dan!', 400);
            }
        }

        if ($depozitWithdraw->iznos_withdraw > $depozitLoaded->iznos_depozit) {
            return response()->json('Iznos koji podižete ne može biti veći od iznosa depozita za današnji dan!', 400);
        }

        $depozitWithdraw->user_id = auth()->id();
        $depozitWithdraw->preduzece_id = getAuthPreduzeceId($request);
        $depozitWithdraw->poslovna_jedinica_id = getAuthPoslovnaJedinicaId($request);

        if ($depozitWithdraw->iznos_depozit < 0) {
            return response()->json('Depozit nije validan', 400);
        }

        if ($depozitWithdraw->iznos_withdraw < 0) {
            return response()->json('Withdraw nije validan', 400);
        }

        $depozitWithdraw->save();

        Depozit::dispatch($depozitWithdraw)->onConnection('sync');

        $depozitWithdraw->update([
            'fiskalizovan' => true,
        ]);

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

    public function nefiskalizovaniDepoziti()
    {
        return DepozitWithdraw::filterByPermissions()->where('fiskalizovan', false)->get();
    }

    public function fiskalizujDepozit(DepozitWithdraw $depozit)
    {
        Depozit::dispatch($depozit)->onConnection('sync');

        $depozit->update([
            'fiskalizovan' => true,
        ]);

        FailedJobsCustom::where('payload', $depozit->id)->delete();

        return response()->json('Uspjesno ste fiskalizovali depozit', 200);
    }
}
