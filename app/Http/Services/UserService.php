<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Http\{Request, JsonResponse};
use App\Http\DTO\{UserStoreData, UserUpdateData};
use App\Http\Repositories\UserRepository;
use App\Http\Interfaces\IUserService;
use App\Models\User;

class UserService implements IUserService
{
    public function index(Request $request): JsonResponse
    {
        try {
            $users = (new UserRepository)->userPaginate($request);

            return response()->json($users, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store(UserStoreData $data): JsonResponse
    {
        try {
            $user = User::create($data->toArray());

            return response()->json($user, 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            if(!$user = (new UserRepository)->getUserById($id)){

                return response()->json('User not found', 404);
            }
            
            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function update(UserUpdateData $data, string $id): JsonResponse
    {
        try {
            if(!$user = (new UserRepository)->getUserById($id)){

                return response()->json('User not found', 404);
            }

            $user->name = $data->name;
            $user->email = $data->email;
            $user->country = $data->country;
            $user->save();

            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            if(!$user = (new UserRepository)->getUserById($id)){

                return response()->json('User not found', 404);
            }

            $user->delete();

            return response()->json('User deleted successful', 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}