<?php

namespace App\Services\WeatherApi;

use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

abstract class WeatherApiClientService
{
    protected $url;
    protected $apiKey;
    protected $cachePrefix;

    public function __construct(string $url, string $apiKey, string $cachePrefix)
    {
        $this->url = $url;
        $this->apiKey = $apiKey;
        $this->cachePrefix = $cachePrefix;
    }

    public function getWeatherByCity($city)
    {
        $cacheKey = $this->cachePrefix . $city;

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $response = $this->fetchWeatherFromAPI($city);

        $data = $this->extractWeatherData($response);

        $now = Carbon::now();
        $endOfDay = $now->copy()->endOfDay();
        $remainingTime = $now->diffInSeconds($endOfDay);

        Cache::put($cacheKey, $data, $remainingTime);

        return $data;
    }

    abstract protected function fetchWeatherFromAPI($city);

    abstract protected function extractWeatherData($response);
}
