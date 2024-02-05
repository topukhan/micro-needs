<?php

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\HashController;
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

    Route::get('/web-api', [ApiController::class, 'index'])->name('api.index');
    Route::post('/weather-map', [ApiController::class, 'weatherMapApi'])->name('api.weathermap');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
