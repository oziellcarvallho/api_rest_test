<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], function ($router) {
    Route::group(['prefix' => 'auth'], function ($router) {
        Route::post('login', [App\Http\Controllers\Api\ApiAuthController::class, 'login']);
        Route::post('logout', [App\Http\Controllers\Api\ApiAuthController::class, 'logout']);
        Route::post('refresh', [App\Http\Controllers\Api\ApiAuthController::class, 'refresh']);
        Route::post('me', [App\Http\Controllers\Api\ApiAuthController::class, 'me']);
    });

    Route::group(['prefix' => 'user'], function ($router) {
        Route::get('/', [App\Http\Controllers\Api\ApiUserController::class, 'index']);
        Route::post('/', [App\Http\Controllers\Api\ApiUserController::class, 'store']);
        Route::get('/{user}', [App\Http\Controllers\Api\ApiUserController::class, 'show']);
        Route::put('/{user}', [App\Http\Controllers\Api\ApiUserController::class, 'update']);
        Route::delete('/{user}', [App\Http\Controllers\Api\ApiUserController::class, 'destroy']);
    });
});