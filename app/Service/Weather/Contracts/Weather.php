<?php


namespace App\Service\Weather\Contracts;


interface Weather
{

    /**
     * Notes: 天气
     * User: hui
     * Date: 2021/4/8
     * Time: 5:21 下午
     * @return mixed
     */
    public function getWeatherByCity($city);

}
