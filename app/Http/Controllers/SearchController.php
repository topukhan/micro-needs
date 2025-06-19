<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Topukhan\Geokit\Facades\Geokit;

class SearchController extends Controller
{
    public function create()
    {
        return view('other.address_search');
    }

    public function search(Request $request)
    {
        $request->validate(['search' => 'required|string|min:3']);

        $response = Geokit::search($request->search);

        return response()->json($response);
    }

    public function addToCache(Request $request)
    {
        $address = $request->address;
        $key = 'address_'.md5(json_encode($address));

        // Get existing cached keys or initialize empty array
        $cachedKeys = Cache::get('address_keys', []);

        // Add new key if not already exists
        if (! in_array($key, $cachedKeys)) {
            $cachedKeys[] = $key;
            Cache::put('address_keys', $cachedKeys, now()->addDays(30));
            Cache::put($key, $address, now()->addDays(30));
        }

        return response()->json(['success' => true]);
    }

    public function removeFromCache(Request $request)
    {
        $address = $request->address;
        $key = 'address_'.md5(json_encode($address));

        Cache::forget($key);

        return response()->json(['success' => true]);
    }

    public function clearCache()
    {
        $keys = Cache::get('address_keys', []);
        foreach ($keys as $key) {
            Cache::forget($key);
        }
        Cache::forget('address_keys');

        return response()->json(['success' => true]);
    }

    public function getCached()
    {
        $cachedAddresses = [];
        $keys = Cache::get('address_keys', []);

        foreach ($keys as $key) {
            if (Cache::has($key)) {
                $cachedAddresses[] = Cache::get($key);
            }
        }

        return response()->json($cachedAddresses);
    }
}
