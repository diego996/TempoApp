<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class AgromonitoringController extends Controller
{
    private $apiKey = '9d0cf34c69c88a955df46d50236e2373';
    private $polygonApiUrl = 'https://api.agromonitoring.com/agro/1.0/polygons?appid=';
    private $weatherApiUrl = 'https://api.agromonitoring.com/agro/1.0/weather?appid=';
    private $client;

    public function __construct() {
        $this->client = new Client([
            'base_uri' => $this->weatherApiUrl . $this->apiKey,
            'timeout' => 10,
            'http_errors' => false
        ]);
    }

    public function getPolygonIds() {
        $client = new Client();
        $response = $client->get($this->polygonApiUrl . $this->apiKey);

        $polygons = json_decode($response->getBody());
        $ids = array();

        foreach ($polygons as $polygon) {
            $ids[] = $polygon->id;
        }

        return $ids;
    }

    public function getPolygonById($polygonId) {
        $client = new Client(['base_uri' => 'https://api.agromonitoring.com']);

        $response = $client->request('GET', '/agro/1.0/polygons/' . $polygonId, [
            'query' => [
                'appid' => $this->apiKey,
            ],
        ]);

        $body = json_decode($response->getBody()->getContents(), true);

        return $body;
    }

    public function getTodayWeatherData($polygonId)
    {
        // Get the polygon data
        $polygon = $this->getPolygonById($polygonId);
//        dd($polygon);
        // Set up the API endpoint
        $apiEndpoint = "https://api.agromonitoring.com/agro/1.0/weather?lat={$polygon["center"][1]}&lon={$polygon["center"][0]}&appid={$this->apiKey}";

        // Set up the HTTP client
        $client = new Client();

        // Make the API request
        $response = $client->request('GET', $apiEndpoint);

        // Parse the response JSON data
        $data = json_decode($response->getBody()->getContents());

        // Get the temperature in Celsius
        $temperatureCelsius = round($data->main->temp - 273.15, 2);

        // Return the weather data as a JSON response
        return response()->json([
            'description' => $data->weather[0]->description,
            'temperature' => $temperatureCelsius,
            'icon' => "https://openweathermap.org/img/wn/{$data->weather[0]->icon}@4x.png",
        ]);
    }

    public function getWeatherData($polygonId, $type = 'current') {
        $url = $this->weatherApiUrl . $this->apiKey . '&polyid=' . $polygonId;

        if ($type === 'forecast') {
            $url .= '&units=metric&cnt=7';
        }

        $response = $this->client->get($url);

        return json_decode($response->getBody());
    }

    public function getWeatherDataForAllPolygons() {
        $polygonIds = $this->getPolygonIds();
        $data = array();

        foreach ($polygonIds as $polygonId) {
            $data[$polygonId] = $this->getWeatherData($polygonId);
        }

        return ($data);
    }
}