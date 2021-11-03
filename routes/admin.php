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
Route::post('register', [\App\Http\Controllers\Admin\Auth\UserController::class, 'register']);
Route::any('login', [\App\Http\Controllers\Admin\Auth\UserController::class, 'login'])->name('login');

//需要登录
Route::middleware(['admin.auth'])->group(function () {
    Route::group(['prefix' => 'user'], function() {
        Route::post('me',  [\App\Http\Controllers\Admin\Auth\UserController::class, 'me']);
    });
});



