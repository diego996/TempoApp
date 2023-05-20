<?php

namespace App\Http\Controllers;
use App\Services\OpenWeatherMapService;
use Illuminate\Http\Request;
use App\Models\CallStatistic;
use Carbon\Carbon;


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
        $currentDate = Carbon::now()->toDateString();
        $callLimit = 2000;

        $callStatistic = CallStatistic::where('date', $currentDate)->first();
        if ($callStatistic && $callStatistic->call_count >= $callLimit) {
            // Hai superato il limite di chiamate per oggi
            // Aggiungi qui la logica di gestione dell'errore o delle azioni da intraprendere
        } else {
            $forecast = $this->openWeatherMapService->getWeatherForecast($city);
            $rainHistory = $this->openWeatherMapService->getRainHistory($city, '2023-05-01', '2023-05-15');
            return view('home.index', [
                'forecast' => $forecast,
                'rainHistory' => $rainHistory,
            ]);
        }

    }



}
