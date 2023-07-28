<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherRequest;
use App\Services\WeatherApi\WeatherStackApiClientService;

class WeatherController extends BaseWeatherController
{
    public function getWeatherFromSourceWS(WeatherRequest $request, $city, WeatherStackApiClientService $service)
    {
        return $this->handleApiCall(function () use ($city, $service) {
            return $service->getWeatherByCity($city);
        });
    }
}
