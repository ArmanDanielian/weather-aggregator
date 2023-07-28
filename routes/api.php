<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('weather')->group(function () {
    Route::get('/source-weather-stack/{city}', [WeatherController::class, 'getWeatherFromSourceWS']);
    Route::get('/source-open-weather-map/{city}', [WeatherController::class, 'getWeatherFromSourceOPM']);
    Route::get('/average-weather/{city}', [WeatherController::class, 'getAverageWeather']);
});
