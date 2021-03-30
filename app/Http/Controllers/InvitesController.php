<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use App\Models\Racun;
use App\Models\User;
use Illuminate\Http\Request;

class InvitesController extends Controller
{
    public function registerFromInvite(Invite $invite, Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'token' => 'required|string|digits:40',
        ]);

        abort_if($request->token !== $invite->token, 400);

        $user = User::create([
            'name' => $attr['name'],
            'password' => bcrypt($attr['password']),
            'email' => $invite->email,
        ]);

        $user->guestRacuni->attach($invite->racun_id);

        $user->createToken('Api token')->plainTextToken;

        $redirectTo = $invite->route;

        $invite->delete();

        return redirect($redirectTo);
    }
}
