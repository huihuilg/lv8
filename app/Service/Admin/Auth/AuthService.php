<?php


namespace App\Service\Admin\Auth;


use App\Models\UserAdmin;
use App\Service\BaseService;
use Illuminate\Support\Facades\Hash;

class AuthService extends BaseService
{


    /**
     * @desc 后台注册
     * @param  array  $data
     * @return array
     * @throws \App\Exceptions\ResponseCodeException
     */
    public function register(array $data)
    {
        $userAdmin = UserAdmin::query()->where(['email' => $data['email']])->first();
        if($userAdmin){
            throw_response_code('邮箱已存在');
        }
        $data['password'] = Hash::make($data['password']);
        if($userAdmin = UserAdmin::query()->create($data)) {
            if (! $token = auth()->login($userAdmin)) {
                throw_response_code('授权失败');
            }
            return [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ];
        }else {
            throw_response_code('注册失败');
        }

    }
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
            $token = auth('web')->refresh();
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
