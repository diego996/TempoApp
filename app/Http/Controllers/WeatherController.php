<?php

namespace App\Http\Controllers;

use App\Services\OpenWeatherMapService;
use App\Models\CallStatistic;
use Carbon\Carbon;

class WeatherController extends Controller
{
    protected $openWeatherMapService;

    public function __construct(OpenWeatherMapService $openWeatherMapService)
    {
        $this->openWeatherMapService = $openWeatherMapService;
    }

    public function getWeatherForecast($city)
    {
        $currentDate = Carbon::now()->toDateString();
        $callStatistic = CallStatistic::firstOrNew(['date' => $currentDate]);
        $callStatistic->call_count += 1;
        $callStatistic->save();
        $forecast = $this->openWeatherMapService->getWeatherForecast($city);
        // Elabora e restituisci i dati delle previsioni
    }

    public function getRainHistory($city, $startDate, $endDate)
    {
        $currentDate = Carbon::now()->toDateString();
        $callStatistic = CallStatistic::firstOrNew(['date' => $currentDate]);
        $callStatistic->call_count += 1;
        $callStatistic->save();
        $rainHistory = $this->openWeatherMapService->getRainHistory($city, $startDate, $endDate);
        // Elabora e restituisci i dati dello storico delle piogge
    }
}
