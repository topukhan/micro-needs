<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function apis() {
        return view('apis.index');
    }
    public function weatherAPIIndex() {
        return view('apis.weather.index');
    }
    
    public function weatherMapApi(Request $request) {
        $cityName = $request->input('cityMapInput');
        log::info($cityName);

        // Make a request to the OpenWeatherMap API
        $apiKey = 'your-api-key';
        $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=$cityName&appid=$apiKey";
        $response = Http::get($apiUrl);

        // Return the response from the OpenWeatherMap API
        return $response->json();
    }
    
    public function newsAPIIndex() {
        return view('apis.news.index');
    }
}
