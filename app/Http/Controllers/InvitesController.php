<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InvitesController extends Controller
{
    public function registerFromInvite(Invite $invite, Request $request)
    {
        $attributes = $request->validate([
            'ime' => 'required|string|max:255',
            'password' => 'required|string|min:6'
        ]);

        if ($request->token !== $invite->token) {
            return response()->json('Neodgovarajuci token', 400);
    }

        $user = User::create([
            'ime' => $attributes['ime'],
            'password' => Hash::make($attributes['password']),
            'email' => $invite->email,
        ]);

        $user->guestRacuni()->attach($invite->racun_id);

        $user->assignRole('Gost');

        $invite->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
            'data' => [
                'token' => $user->createToken('Api token')->plainTextToken,
            ]
        ], 200);
    }
}
