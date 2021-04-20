<?php


namespace App\Service\Weather;

use App\Service\Weather\Contracts\Weather;

class WeatherService implements Weather
{

    /**
     * Notes:
     * User: hui
     * Date: 2021/4/8
     * Time: 6:14 下午
     * @return mixed|void
     */
    public function getWeatherByCity($city)
    {
        return $city;
    }
}
