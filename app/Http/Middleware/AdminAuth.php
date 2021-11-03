<?php

namespace App\Http\Middleware;

use App\Http\Controllers\BaseController;
use App\Http\ResponseCode;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AdminAuth extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        try {
            $tokenRole =  $this->auth->parseToken()->getClaim('role');
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $exception) {
            return response()->json([
                "code" => ResponseCode::NOT_LOGIN['code'],
                'message' => 'token过期请刷新'
            ]);
        } catch(TokenInvalidException $e) {
            return response()->json([
                "code" => ResponseCode::NOT_LOGIN['code'],
                'message' => 'token 失效'
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'code' => ResponseCode::NOT_LOGIN['code'],
                'message' => 'token 参数错误'
            ], $e->getStatusCode());

        }
        return $next($request);
    }
}
