<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;
use Topukhan\Geokit\Facades\Geokit;

Route::get('/test-geokit', function () {
    $param = request('search');
    $response = Geokit::search($param);

    return [
        'query' => $response->query,
        'results_count' => $response->count(),
        'used_fallback' => $response->usedFallback,
        'failed_providers' => $response->failedProviders,
        'results' => $response->toArray()['results'],
    ];
});

// Search address
Route::resource('/search-address', SearchController::class)->only(['create', 'store']);
Route::get('/search-address/search', [SearchController::class, 'search'])->name('search-address.search');
Route::post('/search-address/add-to-cache', [SearchController::class, 'addToCache'])->name('search-address.add-to-cache');
Route::post('/search-address/remove-from-cache', [SearchController::class, 'removeFromCache'])->name('search-address.remove-from-cache');
Route::post('/search-address/clear-cache', [SearchController::class, 'clearCache'])->name('search-address.clear-cache');
Route::get('/search-address/get-cached', [SearchController::class, 'getCached'])->name('search-address.get-cached');

Route::get('/clear-cache', [SupportController::class, 'clearCache'])->name('support.clear-cache');
