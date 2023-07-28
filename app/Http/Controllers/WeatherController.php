<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherRequest;
use App\Services\WeatherApi\OpenWeatherMapApiClientService;
use App\Services\WeatherApi\WeatherService;
use App\Services\WeatherApi\WeatherStackApiClientService;

class WeatherController extends BaseWeatherController
{
    /**
     * @OA\Get(
     *     path="/api/weather/source-weather-stack/{city}",
     *     summary="Get weather data by city",
     *     tags={"Weather"},
     *     @OA\Parameter(
     *         name="city",
     *         in="path",
     *         required=true,
     *         description="The name of the city to get weather data for",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="city", type="string", example="Yerevan"),
     *                  @OA\Property(property="temperature", type="integer", example=34),
     *                  @OA\Property(property="windSpeed", type="integer", example=13),
     *                  @OA\Property(property="windDegree", type="integer", example=200),
     *                  @OA\Property(property="pressure", type="integer", example=1004),
     *              )
     *        )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="City not found",
     *         @OA\JsonContent(
     *              @OA\Property(property="error", type="object",
     *                  @OA\Property(property="message", type="string", example="City not found"),
     *                  @OA\Property(property="code", type="integer", example="404"),
     *              )
     *         )
     *     )
     * )
     */
    public function getWeatherFromSourceWS(WeatherRequest $request, $city, WeatherStackApiClientService $service)
    {
        return $this->handleApiCall(function () use ($city, $service) {
            return $service->getWeatherByCity($city);
        });
    }

    /**
     * @OA\Get(
     *     path="/api/weather/source-open-weather-map/{city}",
     *     summary="Get weather data by city",
     *     tags={"Weather"},
     *     @OA\Parameter(
     *         name="city",
     *         in="path",
     *         required=true,
     *         description="The name of the city to get weather data for",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="city", type="string", example="Yerevan"),
     *                  @OA\Property(property="temperature", type="integer", example=34),
     *                  @OA\Property(property="windSpeed", type="integer", example=13),
     *                  @OA\Property(property="windDegree", type="integer", example=200),
     *                  @OA\Property(property="pressure", type="integer", example=1004),
     *              )
     *        )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="City not found",
     *         @OA\JsonContent(
     *              @OA\Property(property="error", type="object",
     *                  @OA\Property(property="message", type="string", example="City not found"),
     *                  @OA\Property(property="code", type="integer", example="404"),
     *              )
     *         )
     *     )
     * )
     */
    public function getWeatherFromSourceOPM(WeatherRequest $request, $city, OpenWeatherMapApiClientService $service)
    {
        return $this->handleApiCall(function () use ($city, $service) {
            return $service->getWeatherByCity($city);
        });
    }

    /**
     * @OA\Get(
     *     path="/api/weather/average-weather/{city}",
     *     summary="Get average weather data by city",
     *     tags={"Weather"},
     *     @OA\Parameter(
     *         name="city",
     *         in="path",
     *         required=true,
     *         description="The name of the city to get weather data for",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful response",
     *         @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="city", type="string", example="Yerevan"),
     *                  @OA\Property(property="temperature", type="integer", example=34),
     *                  @OA\Property(property="windSpeed", type="integer", example=13),
     *                  @OA\Property(property="windDegree", type="integer", example=200),
     *                  @OA\Property(property="pressure", type="integer", example=1004),
     *              )
     *        )
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="City not found",
     *         @OA\JsonContent(
     *              @OA\Property(property="error", type="object",
     *                  @OA\Property(property="message", type="string", example="City not found"),
     *                  @OA\Property(property="code", type="integer", example="404"),
     *              )
     *         )
     *     )
     * )
     */
    public function getAverageWeather(WeatherRequest $request, $city, WeatherService $service)
    {
        return $this->handleApiCall(function () use ($city, $service) {
            return $service->getAverageWeatherByCity($city);
        });
    }
}
