<?php

namespace App\Http\Controllers;

use App\Services\OpenWeatherMapService;

class WeatherController extends Controller
{
    protected $openWeatherMapService;

    public function __construct(OpenWeatherMapService $openWeatherMapService)
    {
        $this->openWeatherMapService = $openWeatherMapService;
    }

    public function getWeatherForecast($city)
    {
        $forecast = $this->openWeatherMapService->getWeatherForecast($city);

        // Elabora e restituisci i dati delle previsioni
    }

    public function getRainHistory($city, $startDate, $endDate)
    {
        $rainHistory = $this->openWeatherMapService->getRainHistory($city, $startDate, $endDate);

        // Elabora e restituisci i dati dello storico delle piogge
    }
}
