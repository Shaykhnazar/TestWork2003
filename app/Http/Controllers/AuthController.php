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
        return new UserResource($user->load('roles'));
    }

    /**
     *  Выйти из системы
     *
     * @param Request $request
     * @param AuthService $authService
     * @return JsonResponse
     */
    public function logout(Request $request, AuthService $authService): JsonResponse
    {
        $authService->logout($request);
        return $this->jsonResponse(message: 'Successfully logged out');
    }

}
