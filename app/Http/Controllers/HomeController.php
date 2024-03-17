<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function guestLogin(Request $request) {
        $guestMail = 'guest@gmail.com';
        $password = '12345678';

    
        User::where('email', $guestMail)->first();
        
        $credentials = [
            'email' =>  $guestMail,
            'password' => $password
        ];
        

        if (Auth::attempt($credentials, $request->remember)) {
            // Authentication passed...
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    } 
}
