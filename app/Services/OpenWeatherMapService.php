<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenWeatherMapService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('app.openweathermap_api_key');
        $this->apiUrl = config('app.openweathermap_api_url');
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
        $endpoint = $this->apiUrl . '/history/city';
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
