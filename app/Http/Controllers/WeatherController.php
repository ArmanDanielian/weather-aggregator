<?php

namespace App\Http\Controllers;

use App\Services\WeatherApi\WeatherStackApiClientService;

class WeatherController extends BaseWeatherController
{
    public function getWeatherFromSourceWS($city, WeatherStackApiClientService $service)
    {
        return $this->handleApiCall(function () use ($city, $service) {
            return $service->getWeatherByCity($city);
        });
    }
}
