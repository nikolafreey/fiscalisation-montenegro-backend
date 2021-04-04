<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OdabranoPreduzeceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role === 'Gost') {
            return $next($request);
        }

        if (
            DB::table('personal_access_tokens')
                ->where('token', getAccessToken($request))
                ->first()
                ->preduzece_id  === null
        ) {
            return route('odabir.preduzeca');
        }

        return $next($request);
    }
}
