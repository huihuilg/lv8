<?php


namespace App\Service\Common;


use App\Service\BaseService;
use Illuminate\Support\Facades\Mail;

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
        $content = '这是一封的测试邮件.';
        Mail::raw($content, function ($message) use ($toMail) {
            $message->subject('[ 测试 ] 测试邮件SendMail - ' .date('Y-m-d H:i:s'));
            $message->to($toMail);
        });
        return true;
    }
}
