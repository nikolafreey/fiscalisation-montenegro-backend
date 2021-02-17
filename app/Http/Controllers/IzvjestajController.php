<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PoslovnaJedinica;
use App\Services\IzvjestajService;
use App\Http\Requests\FiskalniPresjekStanjaRequest;
use App\Http\Requests\FiskalniDnevniIzvjestajRequest;
use App\Http\Requests\PeriodicniFiskalniIzvjestajRequest;

class IzvjestajController extends Controller
{
    public function fiskalniPresjekStanja(FiskalniPresjekStanjaRequest $request)
    {
        $izvjestajService = new IzvjestajService(
            PoslovnaJedinica::find($request->poslovna_jedinica_id),
            'PRESJEK STANJA',
            today(),
            now()
        );

        $fiskalniPresjekStanja = array_merge(
            $izvjestajService->getPoreskiObveznikInformacije(),
            $izvjestajService->getKalkulacije()
        );

        return response()->json($fiskalniPresjekStanja);
    }

    public function fiskalniDnevniIzvjestaj(FiskalniDnevniIzvjestajRequest $request)
    {
        $izvjestajService = new IzvjestajService(
            PoslovnaJedinica::find($request->poslovna_jedinica_id),
            'FISKALNI DNEVNI IZVJEŠTAJ – KRAJ DANA',
            Carbon::parse($request->datum)->startOfDay(),
            Carbon::parse($request->datum)->endOfDay()
        );

        $fiskalniPresjekStanja = array_merge(
            $izvjestajService->getPoreskiObveznikInformacije(),
            $izvjestajService->getKalkulacije()
        );

        return response()->json($fiskalniPresjekStanja);
    }

    public function periodicniFiskalniIzvjestaj(PeriodicniFiskalniIzvjestajRequest $request)
    {
        $izvjestajService = new IzvjestajService(
            PoslovnaJedinica::find($request->poslovna_jedinica_id),
            'PERIODIČNI FISKALNI IZVJEŠTAJ',
            Carbon::parse($request->datum_od)->startOfDay(),
            Carbon::parse($request->datum_do)->endOfDay()
        );

        $fiskalniPresjekStanja = array_merge(
            $izvjestajService->getPoreskiObveznikInformacije(),
            $izvjestajService->getKalkulacije()
        );

        return response()->json($fiskalniPresjekStanja);
    }
}
