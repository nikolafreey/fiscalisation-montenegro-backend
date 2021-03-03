<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class MobileAuthController extends Controller
{
    public function token(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                "email" => ['Unešeni kredencijali nisu validni.']
            ]);
        }

        return response()->json(['user' => $user, 'token' => $user->createToken($user->ime)->plainTextToken]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'ime' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = new User();
        $user->ime = $request->ime;
        $user->tip_id = $request->tip_id;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['user' => $user, 'token' => $user->createToken($user->ime)->plainTextToken]);
    }

    public function profile(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }

    public function refresh(Request $request)
    {
        $user = $request->user();

        $user->tokens()->delete();

        return response()->json(['token' => $user->createToken($user->ime)->plainTextToken]);
    }
}
