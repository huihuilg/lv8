<?php


namespace App\Service;


use Illuminate\Support\Facades\DB;

class BaseService
{
    protected static $instance;

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
