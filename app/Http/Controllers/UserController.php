<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, JsonResponse};
use App\Http\Requests\{StoreUserRequest, UpdateUserRequest};
use App\Http\DTO\{UserStoreData, UserUpdateData};
use App\Http\Services\UserService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            return (new UserService)->index($request);
        } catch (Exception $e) {
            return response()->json($e->getMessaje(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            return (new UserService)->store(UserStoreData::from($request));
        } catch (Exception $e) {
            return response()->json($e->getMessaje(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            return (new UserService)->show($id);
        } catch (Exception $e) {
            return response()->json($e->getMessaje(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id): JsonResponse
    {
        try {
            return (new UserService)->update(UserUpdateData::from($request), $id);
        } catch (Exception $e) {
            return response()->json($e->getMessaje(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            return (new UserService)->destroy($id);
        } catch (Exception $e) {
            return response()->json($e->getMessaje(), 500);
        }
    }
}
