<?php

namespace App\Livewire;

use Livewire\Component;

class WeatherDashboard extends Component
{
    public $data;
    public function render()
    {
        return view('livewire.weather-dashboard');
    }
}
