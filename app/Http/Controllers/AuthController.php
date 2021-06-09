<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();

        $preduzecaSuDostupna = false;
        foreach ($user->preduzeca as $preduzece) {
            $loggedInUsersIntoPreduzeceCount = DB::table('personal_access_tokens')
                ->where('preduzece_id', $preduzece->id)
                // ->where('last_used_at', '>', now()->subDays(30))
                ->count();

            if ($loggedInUsersIntoPreduzeceCount < $preduzece->brojUredjaja) {
                $preduzecaSuDostupna = true;
                break;
            }
        }

        if (!$preduzecaSuDostupna) {
            return response()->json('Broj uređaja sa kojih možete koristiti platformu je popunjen! U vašem paketu je broj uređaja ograničen na ' . $preduzece->brojUredjaja, 400);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json('Neuspješna prijava!');
        }

        $token = Auth::user()->createToken('Api token')->plainTextToken;

        $agent = new Agent();

        DB::table('personal_access_tokens')
            ->where('token', hash('sha256', explode('|', $token)[1]))
            ->update([
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'device' => $agent->device(),
                'user_agent' => $request->header('USER_AGENT'),
            ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
            'data' => [
                'token' => $token,
            ]
        ], 200);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'ime' => $request->ime,
            'password' => Hash::make($request->password),
            'email' => $request->email
        ]);

        $token = Auth::user()->createToken('Api token')->plainTextToken;

        $agent = new Agent();

        DB::table('personal_access_tokens')
            ->where('token', hash('sha256', explode('|', $token)[1]))
            ->update([
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'device' => $agent->device(),
                'user_agent' => $request->header('USER_AGENT'),
            ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
            'data' => [
                'token' => $token,
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()
            ->where('token', getAccessToken($request))
            ->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
        ], 200);
    }
}
