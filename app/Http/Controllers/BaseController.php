<?php

namespace App\Http\Controllers;

use App\Http\ResponseCode;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    private static $user;


    /**
     * Notes: 表单验证
     * @param  Request  $request
     * @param  array  $rules
     * @param  array  $error
     * @author huihu
     * @throws \App\Exceptions\ResponseCodeException
     */
    final protected function valid(Request $request, $rules = [], $error = [])
    {
        try {
            $request->validate($rules, $error);
        } catch (ValidationException $e) {
            throw_response_code($e->validator->errors()->first(), ResponseCode::FAIL['code'], json_encode($request->input()));
        }
    }

    /**
     * $msg   返回提示消息
     * $data  返回数据
     */
    public function success($data = null)
    {
        return response()->json([
            'code' => ResponseCode::SUCCESS['code'],
            'message' => ResponseCode::SUCCESS['message'],
            'data' => $data,
        ]);
    }


    /**
     * $msg   返回提示消息
     * $data  返回数据
     */
    public function fail($msg = '')
    {
        return response()->json([
            'code' => ResponseCode::FAIL['code'],
            'message' => $msg,
            'data' => null,
        ]);
    }


    /**
     * Notes: 全局设置用户
     * @param $user
     * @author huihu
     */
    public static function setUser($user)
    {
        self::$user = $user;
    }

    /**
     * Notes: 获取用户
     * @return mixed
     * @author huihu
     */
    public static function getUser()
    {
        return self::$user;
    }

}
