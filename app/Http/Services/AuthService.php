<?php

namespace App\Http\Services;

use Auth;
use Hash;
use Exception;
use Illuminate\Http\{Request, JsonResponse};
use App\Http\DTO\{LoginAuthData, UserStoreData, ChangePasswordData};
use App\Http\Interfaces\IAuthService;
use App\Models\User;

class AuthService implements IAuthService
{
    public function login(LoginAuthData $data): JsonResponse
    {
        try {
            if(Auth::attempt($data->toArray())){
                $user = Auth::user();
                $token = $user->createToken(config('passport.token_name'))->accessToken;

                return response()->json([
                    'message' => 'Successfully login',
                    'token' => $token,
                    'user' => $user
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Incorrect credentials'
                ], 401);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function register(UserStoreData $data): JsonResponse
    {
        try {
            $user = User::create($data->toArray());
            $token = $user->createToken(config('passport.token_name'))->accessToken;

            return response()->json([
                'message' => 'Successfully register',
                'token' => $token,
                'user' => $user
            ], 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $request->user('api')->token()->revoke();

            return response()->json([
                'message' => 'Successful logout'
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function user(Request $request): JsonResponse
    {
        try {
            return response()->json($request->user('api'), 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function changePassword(ChangePasswordData $data, Request $request): JsonResponse
    {
        try {
            $user = $request->user('api');
            $user->password = Hash::make($data->password);
            $user->save();

            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}