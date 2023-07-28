<?php

namespace Tests\Feature;

use Tests\TestCase;

class WeatherApiTest extends TestCase
{
    public function testGetWeatherFromSourceWS()
    {
        $city = 'Yerevan';
        $response = $this->get("/api/weather/source-weather-stack/{$city}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'city',
                    'temperature',
                    'windSpeed',
                    'windDegree',
                    'pressure',
                ]
            ]);
    }

    public function testGetWeatherFromSourceWSCityNotFound()
    {
        $city = 'blablabla';
        $response = $this->get("/api/weather/source-weather-stack/{$city}");

        $response->assertStatus(404)
            ->assertJson([
                'error' => [
                    'message' => 'City not found',
                    'code' => 404,
                ]
            ]);
    }

    public function testGetWeatherFromSourceOPM()
    {
        $city = 'Yerevan';
        $response = $this->get("/api/weather/source-open-weather-map/{$city}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'city',
                    'temperature',
                    'windSpeed',
                    'windDegree',
                    'pressure',
                ]
            ]);
    }

    public function testGetWeatherFromSourceOPMCityNotFound()
    {
        $city = 'blablabla';
        $response = $this->get("/api/weather/source-open-weather-map/{$city}");

        $response->assertStatus(404)
            ->assertJson([
                'error' => [
                    'message' => 'City not found',
                    'code' => 404,
                ]
            ]);
    }

    public function testGetAverageWeather()
    {
        $city = 'Yerevan';
        $response = $this->get("/api/weather/average-weather/{$city}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'city',
                    'temperature',
                    'windSpeed',
                    'windDegree',
                    'pressure',
                ]
            ]);
    }

    public function testGetAverageWeatherCityNotFound()
    {
        $city = 'blablabla';
        $response = $this->get("/api/weather/average-weather/{$city}");

        $response->assertStatus(404)
            ->assertJson([
                'error' => [
                    'message' => 'City not found',
                    'code' => 404,
                ]
            ]);
    }
}
