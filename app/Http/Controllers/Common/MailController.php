<?php


namespace App\Http\Controllers\Common;


use App\Http\Controllers\Controller;
use App\Service\Common\MailService;
use Illuminate\Http\Request;

class MailController extends Controller
{
    /**
     * Notes: 发送邮箱
     * User: hui
     * Date: 2021/4/21
     * Time: 11:30 上午
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMail(Request $request)
    {
        MailService::instance()->sendMail($request->input('email'));
        return $this->success();
    }
}
