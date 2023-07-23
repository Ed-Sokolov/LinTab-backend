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
        Route::get('/{user}', 'ShowController')->withTrashed();
    });

    Route::group(['namespace' => 'User', 'prefix' => 'settings'], function () {
        Route::group(['namespace' => 'About', 'prefix' => 'about'], function () {
            Route::patch('/', 'UpdateController');
        });

        Route::group(['namespace' => 'Avatar', 'prefix' => 'avatar'], function () {
            Route::patch('/', 'UpdateController');
            Route::delete('/', 'DestroyController');
        });

        Route::group(['namespace' => 'Setups', 'prefix' => 'setups'], function () {
            Route::group(['namespace' => 'Password', 'prefix' => 'password'], function () {
                Route::patch('/', 'UpdateController');
            });
        });

        Route::delete('/user', 'DestroyController');
    });

    Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
        Route::post('/', 'StoreController');
        Route::patch('/{post}', 'UpdateController');
        Route::delete('/{post}', 'DestroyController');
    });
});

Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
    Route::group(['namespace' => 'Popular', 'prefix' => 'popular'], function () {
        Route::get('/', 'IndexController');
    });

    Route::get('/', 'IndexController');
    Route::get('/{post}', 'ShowController');
});
