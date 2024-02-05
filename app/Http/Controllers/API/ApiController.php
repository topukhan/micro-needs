<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public $base_api_url = "https://api.openweathermap.org/data/2.5/weather?";
    public $api_key = 'd244580c4ef65da36df45a219910e1fd';

    public function index()
    {
        return view('apis.index');
    }

    public function weatherMapApi(Request $request)
    {
        $city = $request->city;
        $api_url = $this->addQueryString('q', $city);

        $apiResponse = Http::get($api_url);
        return response()->json($apiResponse->json());
        // Log::info($api_response_json);
    }

    public function addQueryString($key, $value)
    {
        $api_url = $this->base_api_url . 'appid=' . $this->api_key . '&' . $key . '=' . $value;
        return $api_url;
    }
}
