<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Podesavanje;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NalogRegistrovan;
use App\Http\Requests\Api\SertifikatRequest;
use App\Http\Requests\Api\Podesavanja\PodesavanjaRequest;
use App\Http\Requests\Api\Podesavanja\DodavanjeKorisnikaRequest;

/**
 * @group Podesavanja
 *
 * Class PodesavanjeController
 * @package App\Http\Controllers
 */

class PodesavanjeController extends Controller
{
    public function index()
    {
        return Podesavanje::filterByPermissions()->get();
    }

    public function show(Request $request)
    {
        $preduzece = getAuthPreduzece($request);

        return response()->json(
            200,
            $preduzece->load('podesavanje')->toArray()
        );
    }

    public function store(PodesavanjaRequest $request, SertifikatRequest $sertifikatRequest)
    {
        if (property_exists(Podesavanje::where('preduzece_id', getAuthPreduzeceId($request)), 'id')) {
            return response()->json("Podesavanje za ovo preduzeće već postoji!", 403);
        }

        // TODO:: ovaj kod ne treba uopste zato sto je napravljeno unutar racuna da obracunava redni broj
        // ako nema  ni jednog racuna
        // if (count(Racun::where('preduzece_id', getAuthPreduzeceId($request))->get()) > 0) {
        //     return response()->json("Podesavanja nije dozvoljeno mijenjati ukoliko ste izdali račun!", 403);
        // }

        $podesavanje = Podesavanje::create([
            'redni_broj' => $request->redni_broj,
            'slanje_kupcu' => $request->slanje_kupcu,
            'izgled_racuna' => $request->izgled_racuna,
            'boja' => $request->boja,
            'jezik' => $request->jezik,
            'tamni_mod' => $request->tamni_mod,
            'user_id' => auth()->id(),
            'preduzece_id' => getAuthPreduzeceId($request),
        ]);

        getAuthPreduzece($request)->update(array_filter($sertifikatRequest->validated()));

        $kodovi = [];
        if($request->enu_kod != null) $kodovi['enu_kod'] = $request->enu_kod;
        if($request->software_kod != null) $kodovi['software_kod'] = config('third_party_apis.poreska.sw_kod');
        if($request->kod_pj != null) $kodovi['kod_pj'] = $request->kod_pj;
        if($request->kod_operatera != null) $kodovi['kod_operatera'] = $request->kod_operatera;

        getAuthPreduzece($request)->update(array_filter($kodovi));

        $preduzece = getAuthPreduzece($request);

        auth()->user()->update([
            'kod_operatera' => $request->kod_operatera != null ? $request->kod_operatera : $preduzece->kod_operatera,
        ]);

        // TODO: sacuvati kod poslovnog prostora u poslovne_jedinice tabelu

        return response()->json($podesavanje, 201);
    }

    public function update(Podesavanje $podesavanje, PodesavanjaRequest $request, SertifikatRequest $sertifikatRequest)
    {
        // TODO: ovaj if moze da se brise
        // if (count(Racun::where('preduzece_id', getAuthPreduzeceId($request))->get()) > 0) {
        //     return response()->json("Podesavanja nije dozvoljeno mijenjati ukoliko ste izdali račun!", 403);
        // }

        // \Log::error($request);
        // \Log::error($podesavanje);
        // return;

        $podesavanje->update([
            // TODO: ne moze da se apdejtuje redni broj ako je vec jednom unesen za tu godinu
            // 'redni_broj' => $request->redni_broj,
            'slanje_kupcu' => $request->slanje_kupcu,
            'izgled_racuna' => $request->izgled_racuna,
            'boja' => $request->boja,
            'jezik' => $request->jezik,
            'tamni_mod' => $request->tamni_mod,
            'user_id' => auth()->id(),
            'preduzece_id' => getAuthPreduzeceId($request),
        ]);

        getAuthPreduzece($request)->update(array_filter($sertifikatRequest->validated()));

        $kodovi = [];
        if($request->enu_kod != null) $kodovi['enu_kod'] = $request->enu_kod;
        if($request->software_kod != null) $kodovi['software_kod'] = config('third_party_apis.poreska.sw_kod');
        if($request->kod_pj != null) $kodovi['kod_pj'] = $request->kod_pj;
        if($request->kod_operatera != null) $kodovi['kod_operatera'] = $request->kod_operatera;

        getAuthPreduzece($request)->update(array_filter($kodovi));

        $preduzece = getAuthPreduzece($request);
        auth()->user()->update([
            'kod_operatera' => $request->kod_operatera != null ? $request->kod_operatera : $preduzece->kod_operatera,
        ]);

        // TODO: sacuvati kod poslovnog prostora u poslovne_jedinice tabelu

        return response()->json($podesavanje, 201);
    }

    public function dodajKorisnika(DodavanjeKorisnikaRequest $request)
    {
        if ($request->uloga === 'SuperAdmin') {
            abort(403, "Nemate pravo za dodjeljivanje ove uloge");
        }

        $preduzece = getAuthPreduzece($request);

        if (
            $preduzece->najjaciPaket === 1
            && $request->uloga !== 'Kasir'
        ) {
            abort(403, "Uzmite veci paket kako biste dodijelili ovu ulogu");
        }

        $trim = explode(' ', trim($request->puno_ime));

        $password = Str::random(40);

        $user = User::create([
            'ime' => $trim[0],
            'prezime' => (isset($trim[1]) && $trim[1]) ? $trim[1] : null,
            'password' => Hash::make($password),
            'email' => $request->email,
        ]);

        $user->preduzeca()->attach($request->preduzece_id);

        $user->syncRoles($request->uloga);

        $user->notify(new NalogRegistrovan($request, $password));

        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
        ], 201);
    }
}
