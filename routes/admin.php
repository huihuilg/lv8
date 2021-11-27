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

Route::any('/', function () {
    echo phpinfo();
});

//登录
Route::post('register', [\App\Http\Controllers\Admin\Auth\AdminAuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Admin\Auth\AdminAuthController::class, 'login'])->name('login');

//需要登录
Route::middleware(['main.auth', 'admin.auth'])->group(function () {
    Route::group(['prefix' => 'user'], function() {
        Route::post('me',  [\App\Http\Controllers\Admin\Auth\AdminAuthController::class, 'me']);
    });
});


Route::get('test', [\App\Http\Controllers\TestController::class, 'test']);
Route::any('commit', [\App\Http\Controllers\TestController::class, 'commit']);





