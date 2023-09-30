<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeezerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth'], function(){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'auth'], function(){
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
        Route::post('change-password', [AuthController::class, 'changePassword']);
    });

    Route::resource('user', UserController::class);

    Route::group(['prefix' => 'deezer'], function(){
        Route::get('album/{id}', [DeezerController::class, 'album'])->where('id', '[0-9]+');
        Route::get('artist/{id}', [DeezerController::class, 'artist'])->where('id', '[0-9]+');
        Route::get('search', [DeezerController::class, 'search']);
    });
});

