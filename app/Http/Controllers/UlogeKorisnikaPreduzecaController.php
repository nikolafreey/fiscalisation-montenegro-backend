<?php

namespace App\Http\Controllers;

use App\Http\Requests\Web\UlogaKorisnikaPreduzecaRequest;
use App\Models\Preduzece;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UlogeKorisnikaPreduzecaController extends Controller
{
    public function index(Preduzece $preduzece)
    {
        return $preduzece->users;
    }

    public function store(Preduzece $preduzece, UlogaKorisnikaPreduzecaRequest $request)
    {
        if (
            ! auth()->user()->hasRole('Vlasnik')
            || ! $preduzece->users()->where('users.id', auth()->id())->exists()
        ) {
            abort(403);
        }

        $user = $preduzece->users()->where('users.id', $request->user_id)->firstOrFail();

        $role = Role::find($request->role_id);

        if ($role->name === 'SuperAdmin'){
            abort(400);
        }

        $user->assignRole($role->name);

        return response()->json(200, 'Uspjesno ste dodali ulogu korisniku');
    }
}
