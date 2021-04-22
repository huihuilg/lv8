<?php


namespace App\Service\Admin\Auth;


use App\Models\UserAdmin;
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
    public function login($email)
    {
        // 使用辅助函数
        $user = UserAdmin::query()->where(['email' => $email])->first();
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

    /**
     * Notes: 刷新token
     * User: hui
     * Date: 2021/4/12
     * Time: 2:15 下午
     * @return mixed
     */
    public function refresh()
    {
        try {
            $token = auth()->refresh();
        }catch (\Exception $e){
            throw_response_code($e->getMessage());
        }
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
