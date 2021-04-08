<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Podesavanja\DodavanjeKorisnikaRequest;
use App\Http\Requests\Api\Podesavanja\PodesavanjaRequest;
use App\Models\Podesavanje;
use App\Models\Preduzece;
use App\Models\User;
use App\Notifications\AccountRegistered;
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

    public function show(Podesavanje $podesavanje)
    {
        return response()->json(200, $podesavanje);
    }

    public function store(PodesavanjaRequest $request)
    {
        $podesavanje = Podesavanje::create([
            'redni_broj' => $request->redni_broj,
            'slanje_kupcu' => $request->slanje_kupcu,
            'izgled_racuna' => $request->izgled_racuna,
            'boja' => $request->boja,
            'jezik' => $request->jezik,
            'mod' => $request->mod,
            'user_id' => auth()->id(),
            'preduzece_id' => getAuthPreduzeceId($request),
        ]);

        if ($request->pecat != null && $request->sertifikat != null) {
            getAuthPreduzece($request)->update([
                'pecat' => $request->pecat,
                'sertifikat' => $request->sertifikat,
                'pecatSifra' => $request->pecat_sifra,
                'sertifikatSifra' => $request->sertifikat_sifra,
            ]);
        }

        getAuthPreduzece($request)->update([
            'enu_kod' => $request->enu_kod,
            'software_kod' => $request->software_kod,
            'kod_pj' => $request->kod_pj
        ]);

        auth()->user()->update([
            'kod_operatera' => $request->kod_operatera != null ? $request->kod_operatera : $preduzece->kod_operatera,
        ]);

        return response()->json($podesavanje, 201);
    }

    public function update(Podesavanje $podesavanje, PodesavanjaRequest $request)
    {
        $podesavanje->update([
            'redni_broj' => $request->redni_broj,
            'slanje_kupcu' => $request->slanje_kupcu,
            'izgled_racuna' => $request->izgled_racuna,
            'boja' => $request->boja,
            'jezik' => $request->jezik,
            'mod' => $request->mod,
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

        $preduzece = Preduzece::find($request->preduzece_id);

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

        $user->notify(new AccountRegistered($request, $password));

        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
        ], 201);
    }
}