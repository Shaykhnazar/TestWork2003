<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Вход в систему
     *
     * @param LoginRequest $request
     * @param AuthService $authService
     * @return JsonResponse
     */
    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {
        return $authService->login($request);
    }

    /**
     * Me
     *
     * Получить информацию о текущем авторизованном пользователе.
     * <aside class="notice">Для определения пользователя используется текущий bearer-токен</aside>
     * @param Request $request
     * @return UserResource
     */
    public function me(Request $request): UserResource
    {
        $user = $request->user();
        return new UserResource($user);
    }

    /**
     *  Выйти из системы
     *
     * @return JsonResponse
     */
    public function logout(Request $request, AuthService $authService)
    {
        $authService->logout($request);
        return response()->json(['message' => 'Successfully logged out']);
    }

}
