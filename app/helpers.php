<?php

use Illuminate\Http\Request;

if (! function_exists('getAccessToken')) {
    function getAccessToken(Request $request): string {
        return hash('sha256', explode('|', $request->bearerToken())[1]);
    }
}

