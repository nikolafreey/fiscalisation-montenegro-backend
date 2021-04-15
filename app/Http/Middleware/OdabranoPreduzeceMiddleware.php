<?php

namespace App\Http\Middleware;

use App\Models\Preduzece;
use App\Models\User;
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

                if ($preduzece->paketi->isEmpty()) {
                    return response()->json(['message' => 'Preduzece nema paket']);
                }

                if ($loggedInUsersIntoPreduzeceCount >= $preduzece->brojUredjaja) {
                    $loggedInUsers = DB::table('personal_access_tokens')
                        ->where('preduzece_id', $preduzece->id)
                        ->get();

                    $array = [
                        'message' => 'Previse uredjaja je ulogovano na ovo preduzece',
                        'ulogovani_korisnici' => [],
                    ];

                    foreach ($loggedInUsers as $id) {
                        $user = User::find($id->tokenable_id);

                        $array['ulogovani_korisnici'][] = [
                            'ime' => $user->punoIme,
                            'email' => $user->email,
                            'uredjaj' => $id->device,
                            'pretrazivac' => $id->browser,
                            'opetarivni_sistem' => $id->platform,
                            'user_agent' => $id->user_agent,
                        ];
                    }

                    return response()->json($array, 403);
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
