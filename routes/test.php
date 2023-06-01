<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


//测试
Route::get('', [\App\Http\Controllers\TestController::class, 'test']);

