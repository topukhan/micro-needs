<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class SupportController extends Controller
{
    public function clearCache()
    {
        Artisan::call('cache:clear');

        return redirect()->back()->with('success', 'Cache cleared successfully');
    }
}
