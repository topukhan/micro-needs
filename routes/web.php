<?php

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\gatePolicy\PostController;
use App\Http\Controllers\HashController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Japanese\JapaneseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentGateway\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// payment gateway routes without controller
Route::get('/payment-gateways', function () {
    return view('paymentGateways.index');
})->name('paymentGateways');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// guest login route 
Route::post('/guest/login', [HomeController::class, 'guestLogin'])->name('guest.login');

Route::middleware('auth')->group(function () {
    //hashing
    Route::get('/hash', [HashController::class, 'index'])->name('hash.index');
    Route::post('/decrypt', [HashController::class, 'decrypt'])->name('hash.decrypt');
    Route::post('/encrypt', [HashController::class, 'encrypt'])->name('hash.encrypt');

    // Japaneses
    Route::resource('/japaneses', JapaneseController::class);

    // SSLCOMMERZ Start
    Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('gateway.sslcommerz.index');
    Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

    Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
    //SSLCOMMERZ END

    // API's
    Route::get('/web-api', [ApiController::class, 'apis'])->name('api.index');
    Route::get('/weather-api', [ApiController::class, 'weatherAPIIndex'])->name('api.weather.index');
    Route::get('/news-api', [ApiController::class, 'newsAPIIndex'])->name('api.news.index');

    Route::post('/weather-map', [ApiController::class, 'weatherMapApi'])->name('api.weathermap');
    
    Route::get('/country-info', [CountryController::class, 'index'])->name('api.country.index');
    // End API

    // QR code 
    Route::view('/qrcode', 'qrcode.index')->name('qrcode.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Post for auth check (gate policy)
    Route::resource('/posts', PostController::class);


});

require __DIR__ . '/auth.php';
