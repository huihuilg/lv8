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
Route::get('test', [\App\Http\Controllers\TestController::class, 'test']);
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout',  [\App\Http\Controllers\AuthController::class, 'loginout']);
    Route::post('refresh',  [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me',  [\App\Http\Controllers\AuthController::class, 'me']);
    Route::post('userinfo',  [\App\Http\Controllers\AuthController::class, 'userinfo']);

});


