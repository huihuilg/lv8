<?php


namespace App\Service\Admin\Auth;


use App\Enum\PlatformEnum;
use App\Models\UserAdmin;
use App\Service\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Service\Common\AuthService as CommonAuth;

class AdminAuthService extends BaseService
{


    /**
     * @desc 后台注册
     * @param  array  $data
     * @return array
     * @throws \App\Exceptions\ResponseCodeException
     */
    public function register(array $data)
    {
        $userAdmin = UserAdmin::query()->where('user_name', $data['user_name'])->first();
        if($userAdmin){
            throw_response_code('账号已存在');
        }
        $data['password'] = Hash::make($data['password']);
        DB::beginTransaction();
        if($userAdmin = UserAdmin::query()->create($data)) {
            if (! $token = app(CommonAuth::class)->login($userAdmin,
                CommonAuth::TOKEN_ACTIVE_CACHE_TTL,
             PlatformEnum::ADMIN)) {
                throw_response_code('授权失败');
            }

            DB::commit();
            return [
                'token' => $token,
                'expires_in' => CommonAuth::TOKEN_ACTIVE_CACHE_TTL - 1
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
    public function login($userName)
    {

        $credentials = request(['user_name', 'password']);
//        $userAdmin = UserAdmin::query()->where('user_name', $userName)->first();
//        if(!$userAdmin){
//            throw_response_code('用户不存在或密码错误');
//        }
//        if (!Hash::check(request('password'), $userAdmin->password)) {
//            throw_response_code('用户不存在或密码错误');
//        }
//        if (! $token = app(CommonAuth::class)->login($userAdmin,
//            CommonAuth::TOKEN_ACTIVE_CACHE_TTL,
//            PlatformEnum::ADMIN)) {
//            throw_response_code('授权失败');
//        }
        $token = auth('admin')->attempt($credentials);
        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60
        ];
    }

}
