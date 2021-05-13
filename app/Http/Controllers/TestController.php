<?php


namespace App\Http\Controllers;


use App\Jobs\TestJob;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Notes: 测试方法
     * User: hui
     * Date: 2021/1/23
     * Time: 5:39 下午
     * @param Request $request
     */
    public function test(Request $request)
    {
        echo 1;
        echo 2;
        echo 3;
    }
}
