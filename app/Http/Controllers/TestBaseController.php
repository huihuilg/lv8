<?php


namespace App\Http\Controllers;

use App\Models\User\UserAdmin;
use Illuminate\Http\Request;

class TestBaseController extends BaseController
{
    /**
     * Notes: 测试方法
     * User: hui
     * Date: 2021/1/23
     * Time: 5:39 下午
     * @param Request $request
     */
    public function index(Request $request)
    {
        return UserAdmin::query()->whereHas('userAdminOfRole', function ($query) {
            $query->where('id', 3);
        })
            ->where('created_at', '2020-01-01')
            ->where('nickname','like', '%'.'a'.'%')
            ->get();
    }
}
