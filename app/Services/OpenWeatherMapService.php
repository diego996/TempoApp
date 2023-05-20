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
        $currentDate = Carbon::now()->toDateString();
        $callStatistic = CallStatistic::firstOrNew(['date' => $currentDate]);
        $callStatistic->call_count += 1;
        $callStatistic->save();
        dd($currentDate, $callStatistic);
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
        $currentDate = Carbon::now()->toDateString();
        $callStatistic = CallStatistic::firstOrNew(['date' => $currentDate]);
        $callStatistic->call_count += 1;
        $callStatistic->save();
        dd($currentDate, $callStatistic);
        $endpoint = 'http://history.openweathermap.org/data/2.5/history/accumulated_precipitation';
        $startDate = strtotime(date('Y-m-01 00:00:00'));
        $endDate = strtotime(date('Y-m-d 00:00:00'));
        $response = Http::get($endpoint, [
            'lat' => "45.54",
            'long' => "9.48",
            'appid' => $this->apiKey,
            'start' => $startDate,
            'end' => $endDate,
            'type' => 'hour',
        ]);

        return $response->json();
    }
}
