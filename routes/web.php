<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
    return 1;
});

//登录
Route::post('register', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'login']);


//需要登录
Route::middleware('web.auth:web')->group(function () {
    Route::group(['prefix' => 'user'], function() {
        Route::post('logout',  [\App\Http\Controllers\Admin\Auth\AuthController::class, 'logout']);
        Route::get('refresh',  [\App\Http\Controllers\Admin\Auth\AuthController::class, 'refresh']);
        Route::get('me',  [\App\Http\Controllers\Admin\Auth\AuthController::class, 'me']);
    });
});



