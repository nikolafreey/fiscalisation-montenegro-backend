<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePreduzece;
use App\Models\Preduzece;
use App\Models\Racun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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
        // TODO: Uncomment later
        // if (! Auth::user()->can('update', $preduzece)) {
        //     abort(403, 'Nemate pristup');
        // }

        return view('update', [
            'preduzece' => $preduzece
        ]);
    }

    public function update(Preduzece $preduzece, UpdatePreduzece $request)
    {
        // TODO: Uncomment later
        // if (! Auth::user()->can('update', $preduzece)) {
        //     abort(403, 'Nemate pristup');
        // }

        $preduzece->update($request->validated());

        return redirect(route('preduzeca.index'));
    }
}
