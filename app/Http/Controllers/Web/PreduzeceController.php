<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Preduzece;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PreduzeceController extends Controller
{

    public function index()
    {
        return view('preduzeca', [
            'preduzeca' => Preduzece::all()
        ]);
    }

    public function edit(Preduzece $preduzece)
    {
        if (! auth()->user()->can('update', $preduzece)) {
            abort(403);
        }

        return view('update', [
            'preduzece' => $preduzece
        ]);
    }

    public function update(Preduzece $preduzece, Request $request)
    {
        $preduzece->update([
            'pecat' => $request->pecat,
            'sertifikat' => $request->sertifikat,
            'sifra' => Hash::make($request->sifra)
        ]);

        return back();
    }
}
