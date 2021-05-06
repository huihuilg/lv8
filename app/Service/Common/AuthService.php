<?php
/**
 * Created by PhpStorm.
 * User: wuzx
 * Date: 2020/2/11
 * Time: 20:37
 */

namespace App\Service\User;

use App\Enum\User\UserLoginPlatformEnum;
use App\Model\User\User;
use App\Service\BaseService;
use App\Service\Common\Rsa\Rsa;
use Illuminate\Support\Facades\Redis;

class AuthService extends BaseService
{
    /**
     *  token 有效期 cache 前缀
     */
    const TOKEN_ACTIVE_CACHE_PREFIX = 'Token:';

    /**
     *  token 有效期
     */
    const TOKEN_ACTIVE_CACHE_TTL = 64800;

    /**
     * 登录获取token
     * @param int $ttl
     * @return mixed
     * @throws \App\Exceptions\ResponseCodeException
     */
    public function login($user, int $ttl, int $platform)
    {
        return $this->generateToken($user, $ttl, $platform);
    }

    /**
     * 生成token
     * @param int $ttl
     * @return mixed
     * @throws \App\Exceptions\ResponseCodeException
     */
    private function generateToken($user, int $ttl, $platform = 'web')
    {
        if ($ttl < 10) {
            throw_response_code("登录有效期异常");
        }
        $tokenData = [
            "user_id" => $user->id,
            "ttl" => time() + $ttl,
            "mobile" => $user->mobile,
            "email" => $user->email,
            'platform' => $platform
        ];
        $rsa = new Rsa();
        $token = $rsa->encode($tokenData);

        return $token;
    }

    /**
     * 解析token
     * @param string $token
     * @return bool|mixed
     */
    public function analyticToken(string $token)
    {
        $rsa = new Rsa();
        $tokenData = $rsa->decode($token);
        //判断是否解析成功
        if (!$tokenData) {
            return false;
        }
        //判断是否为token
        if (!isset($tokenData["user_id"]) || empty($tokenData['platform'])) {
            return false;
        }

        return $tokenData;
    }


    /**
     * @return string
     */
    public function genSalt()
    {
        $salt = '';
        $str = 'abcdefghijklmopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        for ($i = 0; $i < 6; $i++) {
            $salt .= $str[rand(0, strlen($str) - 1)];
        }
        return $salt;
    }

}
