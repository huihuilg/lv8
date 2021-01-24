<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
{

    /**
     * Notes: 获取用户列表
     * User: hui
     * Date: 2021/1/23
     * Time: 4:56 下午
     * @param Request $request
     */
    public function index(Request $request)
    {
        return Carbon::now()->toDateTimeString();
    }


    /**
     * Notes: 用户登录
     * User: hui
     * Date: 2021/1/23
     * Time: 5:30 下午
     * @param Request $request
     */
    public function login(Request $request)
    {
        return $request->all();
    }
}
