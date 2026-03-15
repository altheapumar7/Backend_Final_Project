<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (!$username || !$password) {
            return response()->json(['message' => 'Username and password are required'], 400);
        }

        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found: ' . $username], 401);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Mali ang password para ni ' . $username], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }
}