<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OdaberiPreduzeceController extends Controller
{
    public function index()
    {
        return Auth::user()->preduzeca();
    }

    public function show(Request $request)
    {
        return ['preduzece' => $request->preduzece];
    }

    public function update(Request $request)
    {
        $accessToken = Auth::user()->currentAccessToken();

        $loggedInUsersIntoPreduzeceCount = DB::table('personal_access_tokens')
            ->where('preduzece', $request->preduzece)
            ->where('last_used_at', '>', now()->subDays(30))
            ->count();

        $brojUredjaja = $request->preduzece->izracunajBrojUredjaja();

        if ($loggedInUsersIntoPreduzeceCount >= $brojUredjaja) {
            return ['message' => 'Previse uredjaja ulogovano na ovo preduzece'];
        }

        DB::table('personal_access_tokens')
            ->where('id', $accessToken->id)
            ->where('token', $accessToken->token)
            ->update(['preduzece_id' => $request->preduzece->id]);

        return ['message' => 'Preduzece updated'];
    }

    public function destroy()
    {
        // leave preduzece
    }
}
