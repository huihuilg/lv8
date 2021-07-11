<?php

use Illuminate\Support\Facades\Route;

//不需要登录


Route::get('send_mail', [\App\Http\Controllers\Common\MailBaseController::class, 'sendMail']);