<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class TestController extends BaseController
{
    /**
     * Notes: 测试方法
     * User: hui
     * Date: 2021/1/23
     * Time: 5:39 下午
     * @param  Request  $request
     */
    public function test(Request $request)
    {
        dump('Hello');

//        return view('admin/test');
    }

}
