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
        $response = Http::get("http://api.weatherapi.com/v1/forecast.json", [
            'key' => $this->apiKey,
            'q' => 'samarkand',
//            'lat' => $latitude,
//            'lon' => $longitude,

        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
