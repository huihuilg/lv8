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
//登录
Route::post('register', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'login']);


Route::post('logout',  [\App\Http\Controllers\Admin\Auth\AuthController::class, 'logout']);
Route::get('me',  [\App\Http\Controllers\Admin\Auth\AuthController::class, 'me']);
//需要登录
Route::group([
    'middleware' => ['api', 'auth.jwt'],
], function ($router) {


});



