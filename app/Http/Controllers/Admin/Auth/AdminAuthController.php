<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\BaseController;
use App\Service\Admin\Auth\AdminAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminAuthController extends BaseController
{

    /**
     * @desc 注册
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request, AdminAuthService $adminAuthService)
    {
        $this->valid($request, [
            'user_name' => 'required',
            'password' => 'required'
        ], [
        'user_name.required' => '用户名不能为空',
            'password.required' => '密码不能为空'
        ]);
        $data = $adminAuthService->register($request->all());
        return $this->success($data);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request, AdminAuthService $adminAuthService)
    {
        $this->valid($request, [
            'user_name' => 'required',
            'password' => 'required'
        ], [
            'user_name.required' => '用户名不能为空',
            'password.required' => '密码不能为空'
        ]);
        $data = $adminAuthService->login($request->user_name);
        return $this->success($data);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->success(BaseController::getUser());
    }



}
