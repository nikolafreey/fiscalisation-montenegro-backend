<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PoslovnaJedinica;
use App\Services\IzvjestajService;
use App\Http\Requests\FiskalniPresjekStanjaRequest;
use App\Http\Requests\FiskalniDnevniIzvjestajRequest;
use App\Http\Requests\PeriodicniIzvjestajRequest;
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
            $izvjestajService->getKalkulacije(),
            $izvjestajService->getVrijeme(),
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
            $izvjestajService->getKalkulacije(),
            $izvjestajService->getVrijeme(),
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
            $izvjestajService->getKalkulacije(),
            $izvjestajService->getVrijeme(),
        );

        return response()->json($fiskalniPresjekStanja);
    }

    public function periodicniAnalitickiPregled(PeriodicniIzvjestajRequest $request)
    {
        $izvjestajService = new IzvjestajService(
            PoslovnaJedinica::find($request->poslovna_jedinica_id),
            'Periodični analitički pregled (izvještaj) – elektronski žurnal',
            Carbon::parse($request->datum_od)->startOfDay(),
            Carbon::parse($request->datum_do)->endOfDay()
        );

        $fiskalniPresjekStanja = array_merge(
            $izvjestajService->getPoreskiObveznikInformacije(),
            $izvjestajService->getRacuni(true, true),
            $izvjestajService->getVrijeme()

        );

        return response()->json($fiskalniPresjekStanja);
    }

    public function periodicniAnalitickiPregledOffline(PeriodicniIzvjestajRequest $request)
    {
        $izvjestajService = new IzvjestajService(
            PoslovnaJedinica::find($request->poslovna_jedinica_id),
            'Periodični analitički pregled (izvještaj) sa stavkama svih offline računa i dnevnim subtotalima – offline elektronski žurnal',
            Carbon::parse($request->datum_od)->startOfDay(),
            Carbon::parse($request->datum_do)->endOfDay()
        );

        $fiskalniPresjekStanja = array_merge(
            $izvjestajService->getPoreskiObveznikInformacije(),
            $izvjestajService->getRacuni(),
            $izvjestajService->getOfflineRacuniKalkulacije(),
            $izvjestajService->getVrijeme(),

        );

        return response()->json($fiskalniPresjekStanja);
    }

    public function periodicniAnalitickiPregledKorektivni(PeriodicniIzvjestajRequest $request)
    {
        $izvjestajService = new IzvjestajService(
            PoslovnaJedinica::find($request->poslovna_jedinica_id),
            'Periodični analitički pregled (izvještaj) sa stavkama svih korektivnih računa sa dnevnim subtotalima – korektivni elektronski žurnal',
            Carbon::parse($request->datum_od)->startOfDay(),
            Carbon::parse($request->datum_do)->endOfDay()
        );

        $fiskalniPresjekStanja = array_merge(
            $izvjestajService->getPoreskiObveznikInformacije(),
            $izvjestajService->getRacuni(),
            $izvjestajService->getKorektivniRacuniKalkulacije(),
            $izvjestajService->getVrijeme(),

        );

        return response()->json($fiskalniPresjekStanja);
    }
}
