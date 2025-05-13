<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HashController extends Controller
{
    public function index(){
        $encrypted_data = null;
        return view('hashView', compact('encrypted_data'));
    }
    public function encrypt(Request $request){
        $raw_data = $request->encrypt;
        $encrypted_data = md5($raw_data);

        Log::info('Encrypted data; ', ['data'=> $encrypted_data]);
        return response()->json(['encrypted_data' => $encrypted_data]);
        return view('hashView', compact('encrypted_data'));
    }
    public function decrypt(Request $request){
        dd($request->all());
        return view('hashView');
    }
}
