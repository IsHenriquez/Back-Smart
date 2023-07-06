<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
                'success' => true,
                'tipo_usuario' => $user->id_user_type
            ]);
        }

        return response()->json(['message' => 'Invalid credentials','success' => false], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }


    public function loginWithToken(Request $request)
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['error' => 'Unauthorized','success' => false], 401);
        }
        $api_token = str_replace('Bearer ', '', $token);
        $accessToken = PersonalAccessToken::findToken($api_token);
        if (!$accessToken) {
            return response()->json(['error' => 'Unauthorized' ,'success' => false], 401);
        }
        $user = $accessToken->tokenable;
        $tokenType = 'Bearer';
        return response()->json([
            'user' => $user,
            'access_token' => $api_token,
            'token_type' => $tokenType,
            'success' => true,
            'tipo_usuario' => $user->id_user_type
        ]);
    }



}
