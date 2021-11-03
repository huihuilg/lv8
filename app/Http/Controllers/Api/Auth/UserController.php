<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\UserAdmin;
use App\Service\Admin\Auth\AdminAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends BaseController
{

    /**
     * @desc 注册
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->valid($request, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => '用户名不能为空',
            'password.required' => '密码不能为空'
        ]);
        $user = User::query()->where('email', $request->email)->first();
        if($user){
            throw_response_code('账号已存在');
        }
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        User::query()->create($data);
        return $this->success();
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $token = auth('api')->attempt(['email' => '123@qq.com', 'password' => '123456']);
        return $this->success($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->success(auth('api')->user());
    }



}
