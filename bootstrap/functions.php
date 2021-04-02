<?php



if (!function_exists('is_production')) {
    /**
     * 判断是否生产环境
     *
     * @return bool
     */
    function is_production()
    {
        return env('APP_ENV') === 'production';
    }
}


