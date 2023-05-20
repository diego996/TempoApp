<?php

namespace App\Http\Controllers;
use App\Services\OpenWeatherMapService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $openWeatherMapService;

    public function __construct(OpenWeatherMapService $openWeatherMapService)
    {
        $this->openWeatherMapService = $openWeatherMapService;
    }

    public function index(Request $request, $city = 'inzago')
    {
        $forecast = $this->openWeatherMapService->getWeatherForecast($city);
        $rainHistory = $this->openWeatherMapService->getRainHistory($city, '2023-01-01', '2023-12-31');

        // Puoi elaborare ulteriormente i dati se necessario

        return view('home.index', [
            'forecast' => $forecast,
            'rainHistory' => $rainHistory,
        ]);
    }



}
