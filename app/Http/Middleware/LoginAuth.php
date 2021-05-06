<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use App\Service\Api\Auth\AuthService;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class LoginAuth
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $type = 'api')
    {
        $this->auth($request, $type);
        return $next($request);
    }

    /**
     * 验证登录
     * @param $request
     * @param $type
     * @throws \App\Exceptions\ResponseCodeException
     */
    public function auth($request, $type)
    {
        //解密
        $user = AuthService::instance()->decode($request->token);
        switch ($type) {
            case 'web':
                $user = '';
                break;
            case 'api':
                $user = '';
                break;
            default:
                throw_response_code('类型错误');
        }
        Controller::setUser($user);
    }

}
