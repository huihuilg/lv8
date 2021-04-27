<?php


namespace App\Service\Common;


use App\Jobs\SendMailJob;
use App\Models\UserAdmin;
use App\Service\BaseService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class MailService extends BaseService
{

    /**
     * Notes: 发送邮箱
     * User: hui
     * Date: 2021/4/21
     * Time: 11:44 上午
     */
    public function sendMail($toMail)
    {
        $number = mt_rand(100000, 999999);
        if(!Redis::connection()->set(UserAdmin::PREFIX_EMAIL_VERIFY.$toMail, $number, 100)){
            throw_response_code('验证码设置失败,请重试');
        }
//        $content = '您的注册码为 ' . $number;
//        Mail::raw($content, function ($message) use ($toMail) {
//            $message->subject('用户注册' .date('Y-m-d H:i:s'));
//            $message->to($toMail);
//        });
        SendMailJob::dispatch(['email' => $toMail, 'number' => $number]);
        return true;
    }
}
