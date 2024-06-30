<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class WeatherServices
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('WEATHER_API_KEY');
    }

    public function getWeather($latitude, $longitude)
    {
        $response = Http::get("https://api.openweathermap.org/data/2.5/onecall", [
            'lat' => $latitude,
            'lon' => $longitude,
            'appid' => $this->apiKey,
            'units' => 'metric'
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
