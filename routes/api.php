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

    Route::group(['prefix' => 'project', 'middleware' => 'auth:api'], function ($router) {
        Route::get('/', [App\Http\Controllers\Api\ApiProjectController::class, 'index']);
        Route::post('/', [App\Http\Controllers\Api\ApiProjectController::class, 'store']);
        Route::get('/{project}', [App\Http\Controllers\Api\ApiProjectController::class, 'show']);
        Route::put('/{project}', [App\Http\Controllers\Api\ApiProjectController::class, 'update']);
        Route::delete('/{project}', [App\Http\Controllers\Api\ApiProjectController::class, 'destroy']);
    });

    Route::group(['prefix' => 'task', 'middleware' => 'auth:api'], function ($router) {
        Route::get('/', [App\Http\Controllers\Api\ApiTaskController::class, 'index']);
        Route::post('/', [App\Http\Controllers\Api\ApiTaskController::class, 'store']);
        Route::get('/{task}', [App\Http\Controllers\Api\ApiTaskController::class, 'show']);
        Route::put('/{task}', [App\Http\Controllers\Api\ApiTaskController::class, 'update']);
        Route::delete('/{task}', [App\Http\Controllers\Api\ApiTaskController::class, 'destroy']);
    });

    Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function ($router) {
        Route::get('/', [App\Http\Controllers\Api\ApiUserController::class, 'index']);
        Route::post('/', [App\Http\Controllers\Api\ApiUserController::class, 'store']);
        Route::get('/{user}', [App\Http\Controllers\Api\ApiUserController::class, 'show']);
        Route::put('/{user}', [App\Http\Controllers\Api\ApiUserController::class, 'update']);
        Route::delete('/{user}', [App\Http\Controllers\Api\ApiUserController::class, 'destroy']);
    });
});