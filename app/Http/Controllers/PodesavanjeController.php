<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Podesavanja\DodavanjeKorisnikaRequest;
use App\Http\Requests\Api\Podesavanja\PodesavanjaRequest;
use App\Models\Podesavanje;
use App\Models\Preduzece;
use App\Models\Racun;
use App\Models\User;
use App\Notifications\NalogRegistrovan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        return Podesavanje::all();
    }

    public function show(Request $request)
    {
        $preduzece = getAuthPreduzece($request);

        return response()->json(
            200,
            $preduzece->load('podesavanje')->toArray()
        );
    }

    public function store(PodesavanjaRequest $request)
    {
        if (property_exists(Podesavanje::where('preduzece_id', getAuthPreduzeceId($request)), 'id')) {
            return response()->json("Podesavanje za ovo preduzeće već postoji!", 403);
        }

        if (count(Racun::where('preduzece_id', getAuthPreduzeceId($request))->get()) > 0) {
            return response()->json("Podesavanja nije dozvoljeno mijenjati ukoliko ste izdali račun!", 403);
        }

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

        if ($request->pecat != null && $request->sertifikat != null) {
            getAuthPreduzece($request)->update([
                'pecat' => $request->pecat,
                'sertifikat' => $request->sertifikat,
                'pecatSifra' => $request->pecatSifra,
                'sertifikatSifra' => $request->sertifikatSifra,
            ]);
        }

        getAuthPreduzece($request)->update([
            'enu_kod' => $request->enu_kod,
            'software_kod' => $request->software_kod,
            'kod_pj' => $request->kod_pj,
            'kod_operatera' => $request->kod_operatera
        ]);

        $preduzece = getAuthPreduzece($request);

        auth()->user()->update([
            'kod_operatera' => $request->kod_operatera != null ? $request->kod_operatera : $preduzece->kod_operatera,
        ]);

        return response()->json($podesavanje, 201);
    }

    public function update(Podesavanje $podesavanje, PodesavanjaRequest $request)
    {
        if (count(Racun::where('preduzece_id', getAuthPreduzeceId($request))->get()) > 0) {
            return response()->json("Podesavanja nije dozvoljeno mijenjati ukoliko ste izdali račun!", 403);
        }

        $podesavanje->update([
            'redni_broj' => $request->redni_broj,
            'slanje_kupcu' => $request->slanje_kupcu,
            'izgled_racuna' => $request->izgled_racuna,
            'boja' => $request->boja,
            'jezik' => $request->jezik,
            'tamni_mod' => $request->tamni_mod,
            'user_id' => auth()->id(),
            'preduzece_id' => getAuthPreduzeceId($request),
        ]);

        if ($request->pecat != null && $request->sertifikat != null) {
            getAuthPreduzece($request)->update([
                'pecat' => $request->pecat,
                'sertifikat' => $request->sertifikat,
                'pecatSifra' => $request->pecatSifra,
                'sertifikatSifra' => $request->sertifikatSifra,
            ]);
        }

        getAuthPreduzece($request)->update([
            'enu_kod' => $request->enu_kod,
            'software_kod' => $request->software_kod,
            'kod_pj' => $request->kod_pj,
        ]);

        $preduzece = getAuthPreduzece($request);
        auth()->user()->update([
            'kod_operatera' => $request->kod_operatera != null ? $request->kod_operatera : $preduzece->kod_operatera,
        ]);

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
