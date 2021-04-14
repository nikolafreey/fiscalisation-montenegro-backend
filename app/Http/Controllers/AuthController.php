<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (! Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json('Neuspješno');
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
            'data' => [
                'token' => Auth::user()->createToken('Api token')->plainTextToken,
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

        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
            'data' => [
                'token' => $user->createToken('Api token')->plainTextToken,
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
