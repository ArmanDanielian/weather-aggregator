<?php

namespace App\Services\WeatherApi;

use App\Exceptions\WeatherApiException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class OpenWeatherMapApiClientService extends WeatherApiClientService
{
    public function __construct()
    {
        parent::__construct(
            'https://api.openweathermap.org/data/2.5/weather',
            config('weather.open_weather_map_api_key'),
            'weather_OPM'
        );
    }

    protected function fetchWeatherFromAPI($city)
    {
        $response =  Http::get($this->url, [
            'q' => $city,
            'appid' => $this->apiKey
        ])->json();

        if (empty($response['name'])) {
            throw new WeatherApiException('City not found', 404);
        }

        return $response;
    }

    protected function extractWeatherData($response)
    {
        $kelvinTemperatue = -273;
        return [
            'city' => $response['name'],
            'temperature' => $response['main']['temp'] + $kelvinTemperatue,
            'windSpeed' => $response['wind']['speed'],
            'windDegree' => $response['wind']['deg'],
            'pressure' => $response['main']['pressure'],
        ];
    }
}
