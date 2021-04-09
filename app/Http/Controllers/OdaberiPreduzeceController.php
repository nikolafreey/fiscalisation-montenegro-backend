<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\OdaberiPreduzeceRequest;
use App\Models\Preduzece;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OdaberiPreduzeceController extends Controller
{
    public function index()
    {
        return Auth::user()->preduzeca();
    }

    public function update(OdaberiPreduzeceRequest $request)
    {
        // Preduzece mora da pripada trenutno ulogovanom korisniku

        if (! in_array($request->preduzece_id, auth()->user()->preduzeca()->pluck('preduzeca.id')->toArray(), true)) {
            return response()->json('Unauthorized', 403);
        }

        $preduzece = Preduzece::findOrFail($request->preduzece_id);

        $loggedInUsersIntoPreduzeceCount = DB::table('personal_access_tokens')
            ->where('preduzece_id', $preduzece->id)
            // ->where('last_used_at', '>', now()->subDays(30))
            ->count();

        if ($preduzece->paketi->isEmpty()) {
            return response()->json(['message' => 'Preduzece nema paket']);
        }

        if ($loggedInUsersIntoPreduzeceCount >= $preduzece->brojUredjaja) {
            return response()->json(['message' => 'Previse uredjaja je ulogovano na ovo preduzece']);
        }

        DB::table('personal_access_tokens')
            ->where('token', getAccessToken($request))
            ->update(['preduzece_id' => $preduzece->id]);

        return response()->json(['message' => 'Uspjesno ste odabrali preduzece']);
    }

    public function destroy(Request $request)
    {
        $preduzece = Preduzece::findOrFail($request->preduzece_id);

        DB::table('personal_access_tokens')
            ->where('preduzece_id', $preduzece->id)
            ->update(['preduzece_id' => null]);

        return response()->json(['message' => 'Uspjesno ste se izlogovali iz preduzeca']);
    }
}
