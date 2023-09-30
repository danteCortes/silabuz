<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\{Request, JsonResponse};
use App\Http\Requests\{LoginAuthRequest, StoreUserRequest, ChangePasswordRequest};
use App\Http\DTO\{LoginAuthData, UserStoreData, ChangePasswordData};
use App\Http\Services\AuthService;

class AuthController extends Controller
{
    /**
     * Return a token for user login.
     */
    public function login(LoginAuthRequest $request): JsonResponse
    {
        try {
            return (new AuthService)->login(LoginAuthData::from($request));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function register(StoreUserRequest $request): JsonResponse
    {        
        try {
            return (new AuthService)->register(UserStoreData::from($request));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {        
        try {
            return (new AuthService)->logout($request);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function user(Request $request): JsonResponse
    {
        try {
            return (new AuthService)->user($request);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        try {
            return (new AuthService)->changePassword(ChangePasswordData::from($request), $request);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
