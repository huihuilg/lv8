<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\JWTGuard;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        // 使用辅助函数
        $user = User::query()->where(['email' => request('email')])->first();
        if(!$user){
            return $this->fail('用户不存在');
        }
        if (!Hash::check(request('password'), $user->password)) {
            return $this->fail('密码错误');
        }
        if (! $token = auth()->login($user)) {
            return $this->fail('授权失败');
        }
        return $this->success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->success(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return $this->success();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            $token = auth()->refresh();
        }catch (\Exception $e){
            return $this->fail($e->getMessage());
        }
        return $this->success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


    /**
     * Notes: 获取用户信息
     * User: hui
     * Date: 2021/1/23
     * Time: 10:27 下午
     */
    public function userInfo(Request $request)
    {
       return auth()->user();
    }
}
