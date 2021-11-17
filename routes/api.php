<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestBaseController;

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


//登录
Route::post('register', [\App\Http\Controllers\Api\Auth\UserController::class, 'register']);
Route::any('login', [\App\Http\Controllers\Api\Auth\UserController::class, 'login'])->name('login');
Route::any('me', [\App\Http\Controllers\Api\Auth\UserController::class, 'me'])->name('me');

//Route::middleware('auth:sanctum')->get('/User', function (Request $request) {
//    return $request->user();
//});

//Route::any('test',[\App\Http\Controllers\TestBaseController::class,'test']);
Route::resource('test',TestBaseController::class);



