<?php

namespace App\Http;

class ResponseCode
{
    //基础通用返回码
    const SUCCESS    = ['code' => 0, 'message' => '成功'];
    const FAIL       = ['code' => 10001, 'message' => '失败'];
    const NOT_LOGIN = ['code' => 10005, 'message' => "请重新登录"];

}
