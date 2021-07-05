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
        return DepozitWithdraw::filterByPermissions()
                ->whereDate('created_at', today())
                ->whereNull('iznos_withdraw')
                ->where('fiskalizovan', true)
                ->first();
    }

    public function index()
    {
        return DepozitWithdraw::filterByPermissions()->paginate();
    }

    public function store(StoreDepozitWithdraw $request)
    {
        $depozitWithdraw = DepozitWithdraw::make($request->all());

        if ($depozitWithdraw->iznos_depozit && $depozitWithdraw->iznos_withdraw) {
            return response()->json('Ne možete unijeti i povući depozit istovremeno', 400);
        }

        if ($depozitWithdraw->iznos_depozit < 0 ) {
            return response()->json('Depozit nije validan!', 400);
        }

        if ($depozitWithdraw->iznos_withdraw < 0) {
            return response()->json('Withdraw nije validan!', 400);
        }

        $depozitLoaded =  $this->getDepozitToday();

        if ($depozitWithdraw->iznos_depozit != null) {
            if ($depozitLoaded) {
                return response()->json('Već je dodat depozit za današnji dan!', 400);
            }
        }

        if ($depozitWithdraw->iznos_withdraw != null) {
            $depozit = 0;
            if ($depozitLoaded) {
                $depozit = $depozitLoaded->iznos_depozit;
            }

            $blagajna = getAuthPreduzece($request)->racuni()
                    ->where('vrsta_racuna', 'gotovinski')
                    ->where('status', '!=', 'storniran')
                    ->where('status', '!=', 'korektivni')
                    ->whereNotNull('jikr')
                    ->whereDate('created_at', Carbon::today())
                    ->sum('ukupna_cijena_sa_pdv_popust') + $depozit;

            $withdrawLoaded = DepozitWithdraw::filterByPermissions()
                                ->whereDate('created_at', Carbon::today())
                                ->whereNull('iznos_depozit')
                                ->where('fiskalizovan', true)
                                ->sum('iznos_withdraw') + $depozitWithdraw->iznos_withdraw;

            if ($withdrawLoaded > $blagajna) {
                return response()->json('Već je podignut cijeli iznos iz blagajne za današnji dan!', 400);
            }
        }

        $depozitWithdraw->user_id = auth()->id();
        $depozitWithdraw->preduzece_id = getAuthPreduzeceId($request);
        $depozitWithdraw->poslovna_jedinica_id = getAuthPoslovnaJedinicaId($request);

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
