<?php

namespace App\Services\WeatherApi;

use App\Exceptions\WeatherApiException;
use Illuminate\Support\Facades\Http;

class WeatherStackApiClientService extends WeatherApiClientService
{
    public function __construct()
    {
        parent::__construct(
            'http://api.weatherstack.com/current',
            config('weather.weather_stack_api_key'),
            'weather_WS'
        );
    }

    protected function fetchWeatherFromAPI($city)
    {
        $response =  Http::get($this->url, [
            'access_key' => $this->apiKey,
            'query' => $city
        ])->json();

        if (empty($response['location']['name'])) {
            throw new WeatherApiException('City not found', 404);
        }

        return $response;
    }

    protected function extractWeatherData($response)
    {
        return [
            'city' => $response['location']['name'],
            'temperature' => $response['current']['temperature'],
            'windSpeed' => $response['current']['wind_speed'],
            'windDegree' => $response['current']['wind_degree'],
            'pressure' => $response['current']['pressure'],
        ];
    }
}
