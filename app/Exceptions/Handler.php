<?php

namespace App\Exceptions;

use App\Http\ResponseCode;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }




    /**
     * Notes: 异常处理
     * User: hui
     * Date: 2021/4/1
     * Time: 10:48 上午
     * @param \Illuminate\Http\Request $request
     * @param Throwable $e
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            return response()->json([
                "code" => ResponseCode::NOT_LOGIN['code'],
                'message' => 'token过期请刷新'
            ]);
        }
        //系统异常
        if ($e instanceof ResponseCodeException) {
            return response()->json([
                'code' => $e->responseCode,
                'message' => $e->responseMessage,
                'data' => $e->data]);
        }
        //错误异常
        if(config('app.error_log_monitor.error_notice_enabled')){
            return response()->json([
                'code' => 500,
                'message' => '系统正在开小差'
            ]);
        }
        return parent::render($request, $e);
    }


}
