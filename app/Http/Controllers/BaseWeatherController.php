<?php

namespace App\Http\Controllers;

use App\Exceptions\WeatherApiException;

class BaseWeatherController extends Controller
{
    protected function standardResponse($data, $statusCode = 200)
    {
        return response()->json([
            'data' => $data
        ], $statusCode);
    }

    protected function errorResponse($message, $statusCode)
    {
        return response()->json([
            'error' => [
                'message' => $message,
                'code' => $statusCode,
            ],
        ], $statusCode);
    }

    protected function handleApiCall($apiCall)
    {
        try {
            return $this->standardResponse($apiCall());
        } catch (WeatherApiException $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
