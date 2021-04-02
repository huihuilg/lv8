<?php

namespace App\Http\Controllers;

use App\Http\ResponseCode;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
    public function fail($data = null)
    {
        return response()->json([
            'code' => ResponseCode::FAIL['code'],
            'message' => ResponseCode::FAIL['message'],
            'data' => $data,
        ]);
    }

}
