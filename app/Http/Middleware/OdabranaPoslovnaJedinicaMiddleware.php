<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OdabranaPoslovnaJedinicaMiddleware
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
        if (auth()->user()->hasRole('Gost')) {
            return $next($request);
        }

        $odabranaPoslovnaJedinicaID = DB::table('personal_access_tokens')
            ->where('token', getAccessToken($request))
            ->first()
            ->poslovna_jedinica_id;

        if ($odabranaPoslovnaJedinicaID === null) {
            $brojPoslovnihJedinica = auth()->user()->poslovne_jedinice()->count();

            if ($brojPoslovnihJedinica === 1) {
                $poslovnaJedinica = auth()->user()->poslovne_jedinice()->first();

                DB::table('personal_access_tokens')
                    ->where('token', getAccessToken($request))
                    ->update(['poslovna_jedinica_id' => $poslovnaJedinica->id]);

                return $next($request);
            }

            return response()->json('Nije odabrana Poslovna Jedinica', 401);
        }

        return $next($request);
    }
}
