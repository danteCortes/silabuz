<?php

namespace App\Http\Interfaces;

use Illuminate\Http\{Request, JsonResponse};
use App\Http\DTO\{LoginAuthData, UserStoreData, ChangePasswordData};

interface IAuthService
{
    public function login(LoginAuthData $data): JsonResponse;

    public function register(UserStoreData $data): JsonResponse;

    public function logout(Request $request): JsonResponse;

    public function user(Request $request): JsonResponse;

    public function changePassword(ChangePasswordData $data, Request $request): JsonResponse;
}