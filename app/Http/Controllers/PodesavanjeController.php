<?php

namespace App\Http\Controllers;

use App\Mail\SendPassword;
use App\Models\Podesavanje;
use App\Models\Preduzece;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        $podesavanje = Podesavanje::create([
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
        ]);

        $user = User::where('id', $podesavanje->user_id)->first();

        $user->update([
            'kod_operatera' => $request->kod_operatera != null ? $request->kod_operatera : $preduzece->kod_operatera,
        ]);

        return response()->json($podesavanje, 201);
    }

    public function update(Podesavanje $podesavanje, Request $request)
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

    public function dodajKorisnika(Request $request)
    {
        $attributes = $request->validate([
            'puno_ime' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'preduzece_id' => 'required',
            'uloga' => 'required',
        ]);

        if ($attributes['uloga'] === 'SuperAdmin') {
            abort(403, "Nemate pravo za dodjeljivanje ove uloge");
        }

        $preduzece = Preduzece::find($attributes['preduzece_id']);

        if (
            $preduzece->najjaciPaket === 1
            && $attributes['uloga'] !== 'Kasir'
        ) {
            abort(403, "Uzmite veci paket kako biste dodijelili ovu ulogu");
        }

        $trim = explode(' ', trim($attributes['puno_ime']));

        $user = User::create([
            'ime' => $trim[0],
            'prezime' => (isset($trim[1]) && $trim[1]) ? $trim[1] : null,
            'password' => bcrypt(Str::random(40)),
            'email' => $attributes['email'],
        ]);

        $user->preduzeca()->attach($attributes['preduzece_id']);

        $user->syncRoles($attributes['uloga']);

        Mail::to($user->email)
            ->send(new SendPassword($user));

        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
            'data' => [
                'token' => $user->createToken('Api token')->plainTextToken,
            ]
        ], 201);
    }
}
