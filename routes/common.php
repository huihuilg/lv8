<?php

use Illuminate\Support\Facades\Route;


Route::get('send_mail', [\App\Http\Controllers\Common\MailController::class, 'sendMail']);