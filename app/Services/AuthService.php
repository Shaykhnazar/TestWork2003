<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login($request): JsonResponse
    {
        $user = User::where('email', $request->get('email'))->first();
        if (!$user || !Hash::check($request->get('password'), $user->password)) {
            return response()->json('Неверный логин или пароль', 401);
        }
        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json(compact('token'));
    }

    public function logout($request): void
    {
        $request->user()->currentAccessToken()->delete();
    }

}
