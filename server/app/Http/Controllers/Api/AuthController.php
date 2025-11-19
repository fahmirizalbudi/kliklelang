<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Masyarakat;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginMasyarakat(Request $request)
    {
        $credentials = (object) $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $masyarakat = Masyarakat::where('username', $request->username)->first();

        if (!$masyarakat || !Hash::check($credentials->password, $masyarakat->password)) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthenticated.',
                'data' => null
            ], 401);
        }

        $token = $masyarakat->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 200,
            'message' => 'Login successful.',
            'data' => [
                'token' => $token
            ]
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            'status' => 200,
            'message' => 'Authenticated user successfully retrieved.',
            'data' => $request->masyarakat
        ]);
    }
}
