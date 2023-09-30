<?php

namespace App\Http\Interfaces;

use Illuminate\Http\{Request, JsonResponse};
use App\Http\DTO\{UserStoreData, UserUpdateData};

interface IUserService
{
    public function index(Request $request): JsonResponse;

    public function store(UserStoreData $data): JsonResponse;

    public function show(string $id): JsonResponse;

    public function update(UserUpdateData $data, string $id): JsonResponse;

    public function destroy(string $id): JsonResponse;
}