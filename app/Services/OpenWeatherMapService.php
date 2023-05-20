<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenWeatherMapService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = 'f0c0b0b56729998f56dcd0b9b2455cc1';
        $this->apiUrl = 'https://api.openweathermap.org/data/2.5';
    }

    public function getWeatherForecast($city)
    {
        $endpoint = $this->apiUrl . '/weather';
        $response = Http::get($endpoint, [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric',
        ]);

        return $response->json();
    }

    public function getRainHistory($city, $startDate, $endDate)
    {
        $endpoint = 'https://history.openweathermap.org/data/2.5/history/city';
        $response = Http::get($endpoint, [
            'q' => $city,
            'appid' => $this->apiKey,
            'start' => $startDate,
            'end' => $endDate,
            'type' => 'hour',
        ]);

        return $response->json();
    }
}
