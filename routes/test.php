<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


//测试方法
Route::get('test', [\App\Http\Controllers\TestController::class, 'test']);

