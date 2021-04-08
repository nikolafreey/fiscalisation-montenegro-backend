<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

if (! function_exists('getAccessToken')) {
    function getAccessToken(Request $request): string {
        return hash('sha256', explode('|', $request->bearerToken())[1]);
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

if (! function_exists('getAuthPoslovnaJedinicaId')) {
    function getAuthPoslovnaJedinicaId(Request $request): string {
        return DB::table('personal_access_tokens')
            ->where('token', getAccessToken($request))
            ->first()
            ->poslovna_jedinica_id;
    }
}

