<?php

namespace App\Services\WeatherApi;

class WeatherService
{
    public function __construct(private WeatherStackApiClientService $serviceWS, private OpenWeatherMapApiClientService $serviceOPM)
    {}

    public function getAverageWeatherByCity($city)
    {
        $weatherDataWS = $this->serviceWS->getWeatherByCity($city);
        $weatherDataOPM = $this->serviceOPM->getWeatherByCity($city);

        $averageData = $this->calculateAverage($weatherDataWS, $weatherDataOPM);

        return $averageData;
    }

    private function calculateAverage($weatherDataWS, $weatherDataOPM)
    {
        return [
            'city' => $weatherDataWS['city'],
            'temperature' => ($weatherDataWS['temperature'] + $weatherDataOPM['temperature']) / 2,
            'windSpeed' => ($weatherDataWS['windSpeed'] + $weatherDataOPM['windSpeed']) / 2,
            'windDegree' => ($weatherDataWS['windDegree'] + $weatherDataOPM['windDegree']) / 2,
            'pressure' => ($weatherDataWS['pressure'] + $weatherDataOPM['pressure']) / 2,
        ];
    }
}
