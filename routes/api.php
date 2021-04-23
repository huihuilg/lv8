<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/User', function (Request $request) {
//    return $request->user();
//});


//登录
Route::post('register', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'login']);


//需要登录
Route::group([
    'middleware' => ['api', 'auth.jwt'],
], function ($router) {

    //登录相关
    Route::group(['prefix' => 'auth'], function() {
        Route::post('logout',  [\App\Http\Controllers\Admin\Auth\AuthController::class, 'loginout']);
        Route::post('refresh',  [\App\Http\Controllers\Admin\Auth\AuthController::class, 'refresh']);
        Route::get('me',  [\App\Http\Controllers\Admin\Auth\AuthController::class, 'me']);
    });



});


