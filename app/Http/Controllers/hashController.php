<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class hashController extends Controller
{
    public function index(){
        return view('hashView');
    }
}
