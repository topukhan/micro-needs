<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index()
    {
        return view('apis.countries.index');
    }
}
