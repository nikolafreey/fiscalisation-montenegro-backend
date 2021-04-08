<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OdabranoPreduzeceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->hasRole('Gost')) {
            return $next($request);
        }

        $odabranoPreduzeceID = DB::table('personal_access_tokens')
            ->where('token', getAccessToken($request))
            ->first()
            ->preduzece_id;

        if ($odabranoPreduzeceID === null) {
            $brojPreduzeca = auth()->user()->preduzeca()->count();

            if ($brojPreduzeca === 1) {
                $preduzece = auth()->user()->preduzeca->first();

                $loggedInUsersIntoPreduzeceCount = DB::table('personal_access_tokens')
                    ->where('preduzece_id', $preduzece->id)
                    ->count();

                if ($loggedInUsersIntoPreduzeceCount >= $preduzece->brojUredjaja) {
                    return response()->json(['message' => 'Previse uredjaja je ulogovano na ovo preduzece']);
                }

                DB::table('personal_access_tokens')
                    ->where('token', getAccessToken($request))
                    ->update(['preduzece_id' => $preduzece->id]);

                return $next($request);
            }

            return response()->json('Nije odabrano Preduzece', 401);
        }

        return $next($request);
    }
}
