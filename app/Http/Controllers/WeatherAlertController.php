<?php

namespace App\Http\Controllers;

use App\Services\WeatherServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeatherAlertController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherServices $weatherService)
    {
        $this->weatherService = $weatherService;
    }


    public function index(){
        $user = Auth::user();
        $data = $this->weatherService->getWeather('123', '123');
//        dd($data);
        return view('dashboard', compact('user','data'));

    }

    public function show(Request $request)
    {
        $data = $this->weatherService->getWeather($request->latitude, $request->longitude);

        return response()->json($data);
    }
}
