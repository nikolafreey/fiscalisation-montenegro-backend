<?php

use App\Models\PoslovnaJedinica;
use App\Models\Preduzece;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

if (! function_exists('getAccessToken')) {
    function getAccessToken(Request $request): string {
        $bearer = explode('|', $request->bearerToken());

        if (isset($bearer[1])) {
            return hash('sha256', $bearer[1]);
        }

        throw new \Exception('Nedostaje Bearer token');
    }
}

if (! function_exists('getAuthPreduzece')) {
    function getAuthPreduzece(Request $request): Preduzece {
        $id = DB::table('personal_access_tokens')
            ->where('token', getAccessToken($request))
            ->first()
            ->preduzece_id;

        return Preduzece::find($id);
    }
}

if (! function_exists('getAuthPreduzeceId')) {
    function getAuthPreduzeceId(Request $request): string {
        return DB::table('personal_access_tokens')
            ->where('token', getAccessToken($request))
            ->first()
            ->preduzece_id;
    }
}

if (! function_exists('getAuthPoslovnaJedinica')) {
    function getAuthPoslovnaJedinica(Request $request): PoslovnaJedinica {
        $id = DB::table('personal_access_tokens')
                ->where('token', getAccessToken($request))
                ->first()
                ->poslovna_jedinica_id;

        return PoslovnaJedinica::find($id);
    }
}

if (! function_exists('getAuthPoslovnaJedinicaId')) {
    function getAuthPoslovnaJedinicaId(Request $request): string {
        return DB::table('personal_access_tokens')
                ->where('token', getAccessToken($request))
                ->first()
                ->poslovna_jedinica_id;
    }
}

