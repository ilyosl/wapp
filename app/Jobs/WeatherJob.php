<?php

namespace App\Jobs;

use App\Services\WeatherServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WeatherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(){}

    public function handle(WeatherServices $weatherService)
    {
        $weather = $weatherService->getWeather($this->location->latitude, $this->location->longitude);
        // Process weather data and generate alerts if needed
    }
}
