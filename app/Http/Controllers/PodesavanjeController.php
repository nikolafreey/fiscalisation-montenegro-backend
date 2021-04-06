<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Podesavanja\DodavanjeKorisnikaRequest;
use App\Http\Requests\Api\Podesavanja\PodesavanjaRequest;
use App\Mail\SendPassword;
use App\Models\Podesavanje;
use App\Models\Preduzece;
use App\Models\User;
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
            'redniBroj' => $request->redni_broj,
            'slanjeKupcu' => $request->slanje_kupcu,
            'izgledRacuna' => $request->izgled_racuna,
            'boja' => $request->boja,
            'jezik' => $request->jezik,
            'mod' => $request->mod,
            'user_id' => User::first()->id,
            'preduzece_id' => Preduzece::first()->id,
        ]);

        $preduzece = Preduzece::where('id', $podesavanje->preduzece_id)->first();

        if ($request->pecat != null && $request->sertifikat != null) {
            $preduzece->update([
                'pecat' => $request->pecat,
                'sertifikat' => $request->sertifikat,
                'pecatSifra' => $request->pecat_sifra,
                'sertifikatSifra' => $request->sertifikat_sifra,
            ]);
        }

        $preduzece->update([
            'enu_kod' => $request->enu_kod,
            'software_kod' => $request->software_kod,
            'kod_pj' => $request->kod_pj
        ]);

        $user = User::where('id', $podesavanje->user_id)->first();

        $user->update([
            'kod_operatera' => $request->kod_operatera != null ? $request->kod_operatera : $preduzece->kod_operatera,
        ]);

        return response()->json($podesavanje, 201);
    }

    public function update(Podesavanje $podesavanje, PodesavanjaRequest $request)
    {
        $podesavanje->update([
            'redniBroj' => $request->redniBroj,
            'slanjeKupcu' => $request->slanjeKupcu,
            'izgledRacuna' => $request->izgledRacuna,
            'boja' => $request->boja,
            'jezik' => $request->jezik,
            'mod' => $request->mod,
            'user_id' => User::first()->id,
            'preduzece_id' => Preduzece::first()->id,
        ]);

        $preduzece = Preduzece::where('id', $podesavanje->preduzece_id)->first();

        if ($request->pecat != null && $request->sertifikat != null) {
            $preduzece->update([
                'pecat' => $request->pecat,
                'sertifikat' => $request->sertifikat,
                'pecatSifra' => $request->pecatSifra,
                'sertifikatSifra' => $request->sertifikatSifra,
            ]);
        }

        $preduzece->update([
            'enu_kod' => $request->enu_kod,
            'software_kod' => $request->software_kod,
            'kod_pj' => $request->kod_pj,
        ]);

        $user = User::where('id', $podesavanje->user_id)->first();

        $user->update([
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

        $user = User::create([
            'ime' => $trim[0],
            'prezime' => (isset($trim[1]) && $trim[1]) ? $trim[1] : null,
            'password' => Hash::make(Str::random(40)),
            'email' => $attributes['email'],
        ]);

        $user->preduzeca()->attach($request->preduzece_id);

        $user->syncRoles($request->uloga);

        Mail::to($user->email)
            ->send(new SendPassword($user));

        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
        ], 201);
    }
}
