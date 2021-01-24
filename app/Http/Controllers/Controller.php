<?php

namespace App\Http\Controllers;

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
    public function success($msg,$data = [])
    {
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => $msg,
            'data' => $data,
        ]);
    }


    /**
     * $msg   返回提示消息
     * $data  返回数据
     */
    public function fail($msg,$data = [])
    {
        return response()->json([
            'status' => false,
            'code' => 501,
            'message' => $msg,
            'data' => $data,
        ]);
    }

}
