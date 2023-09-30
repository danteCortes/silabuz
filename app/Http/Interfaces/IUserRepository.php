<?php

namespace App\Http\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserRepository
{
    public function userPaginate(Request $request): LengthAwarePaginator;

    public function getUserById(string $id): User | null;
}