<?php

namespace App\Http\Middleware;

use App\Enum\PlatformEnum;
use App\Http\Controllers\BaseController;
use App\Models\UserAdmin;
use App\Service\Admin\User\UserAdminService;
use App\Service\Common\AuthService;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class MainAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $tokenData = app(AuthService::class)->analyticToken($request->header('token'));

        if(!$tokenData || $tokenData['ttl'] < Carbon::parse()->timestamp) {
            throw_response_code('请重新登录');
        }

        switch ($tokenData['platform']) {
            case PlatformEnum::ADMIN:
                BaseController::setUser(app(UserAdminService::class)->find($tokenData['user_id']));
                break;
            default:
                throw_response_code('登录平台不存在');
        }
        return $next($request);
    }
}
