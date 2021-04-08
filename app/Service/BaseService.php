<?php


namespace App\Service;


use Illuminate\Support\Facades\DB;

class BaseService
{
    /**
     * @var $instance
     */
    protected static $instance;

    /**
     * Notes: 单例禁止克隆
     * User: hui
     * Date: 2021/4/8
     * Time: 6:50 下午
     */
    private function __clone()
    {

    }

    /**
     * 获取单例对象
     * @return static
     */
    public static function instance()
    {
        if (!static::$instance instanceof static) {
            static::$instance = new static(...func_get_args());
        }
        return static::$instance;
    }


    /**
     * 开启打印查询日志
     */
    public static function log()
    {
        DB::enableQueryLog();
    }

    /**
     * 打印
     */
    public static function dump()
    {
        dd(DB::getQueryLog());
    }
}
