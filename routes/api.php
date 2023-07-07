<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/auth/check', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
        Route::get('/{user}', 'ShowController');
    });

    Route::group(['namespace' => 'User', 'prefix' => 'settings'], function () {
        Route::group(['namespace' => 'About', 'prefix' => 'about'], function () {
            Route::patch('/', 'UpdateController');
        });
    });

    Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
        Route::post('/', 'StoreController');
    });
});

Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
    Route::get('/', 'IndexController');
    Route::get('/{post}', 'ShowController');
});
