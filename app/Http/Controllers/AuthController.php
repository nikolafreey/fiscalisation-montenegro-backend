<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (! Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            dd('Fail');
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
            'data' => [
                'token' => Auth::user()->createToken('Api token')->plainTextToken,
            ]
        ], 200);
    }

    public function register(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $attr['name'],
            'password' => Hash::make($attr['password']),
            'email' => $attr['email']
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
            'data' => [
                'token' => $user->createToken('Api token')->plainTextToken,
            ]
        ], 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
