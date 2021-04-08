<?php


namespace App\Service\Auth;


use App\Models\User;
use App\Service\BaseService;
use Illuminate\Support\Facades\Hash;

class AuthService extends BaseService
{
    /**
     * Notes: 登录
     * User: hui
     * Date: 2021/4/8
     * Time: 7:56 下午
     * @return array
     * @throws \App\Exceptions\ResponseCodeException
     */
    public function login()
    {
        // 使用辅助函数
        $user = User::query()->where(['email' => request('email')])->first();
        if(!$user){
            throw_response_code('用户不存在或密码错误');
        }
        if (!Hash::check(request('password'), $user->password)) {
            throw_response_code('用户不存在或密码错误');
        }
        if (! $token = auth()->login($user)) {
            throw_response_code('授权失败');
        }
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
