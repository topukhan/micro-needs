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
    
    public function newsAPIIndex() {
        return view('apis.news.index');
    }
}
