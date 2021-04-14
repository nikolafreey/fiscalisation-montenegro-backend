<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PoslovnaJedinica;
use App\Services\IzvjestajService;
use App\Http\Requests\Api\FiskalniPresjekStanjaRequest;
use App\Http\Requests\Api\FiskalniDnevniIzvjestajRequest;
use App\Http\Requests\Api\PeriodicniIzvjestajRequest;
use App\Http\Requests\Api\PeriodicniFiskalniIzvjestajRequest;
use Illuminate\Http\Request;

class IzvjestajController extends Controller
{
    public function fiskalniPresjekStanja(Request $request)
    {
        $izvjestajService = new IzvjestajService(
            getAuthPoslovnaJedinica($request),
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
            getAuthPoslovnaJedinica($request),
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
            getAuthPoslovnaJedinica($request),
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
            getAuthPoslovnaJedinica($request),
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
            getAuthPoslovnaJedinica($request),
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
            getAuthPoslovnaJedinica($request),
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
