<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\OdaberiPoslovnuJedinicuRequest;
use App\Models\Preduzece;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OdaberiPoslovnuJedinicuController extends Controller
{
    public function index(Request $request)
    {
        $preduzece_id = DB::table('personal_access_tokens')
            ->where('token', getAccessToken($request))
            ->first()
            ->preduzece_id;

        return Preduzece::find($preduzece_id)->poslovne_jedinice;
    }

    public function update(OdaberiPoslovnuJedinicuRequest $request)
    {
        // Poslovna jedinica mora da pripada trenutno ulogovanom preduzecu

        $preduzece_id = DB::table('personal_access_tokens')
            ->where('token', getAccessToken($request))
            ->first()
            ->preduzece_id;

        if (! in_array($request->poslovna_jedinica_id, Preduzece::find($preduzece_id)->poslovne_jedinice->pluck('id')->toArray())) {
            return response()->json('Unauthorized', 403);
        }

        DB::table('personal_access_tokens')
            ->where('token', getAccessToken($request))
            ->update(['poslovna_jedinica_id' => $request->poslovna_jedinica_id]);

        return response()->json(['message' => 'Uspjesno ste odabrali Poslovnu Jedinicu']);
    }

    public function destroy(Request $request)
    {
        DB::table('personal_access_tokens')
            ->where('token', getAccessToken($request))
            ->update(['poslovna_jedinica_id' => null]);

        return response()->json(['message' => 'Uspješno ste se izlogovali iz Poslovne Jedinice']);
    }
}
