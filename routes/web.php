<?php

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\ApiSimulatorController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FormBuilder\FormBuilderController;
use App\Http\Controllers\gatePolicy\PostController;
use App\Http\Controllers\HashController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Japanese\JapaneseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentGateway\SslCommerzPaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Redis\RedisWizardController;
use App\Http\Controllers\SettingController;
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

Route::get('/', fn () => view('welcome'));
// payment gateway routes without controller
Route::get('/payment-gateways', fn () => view('paymentGateways.index'))->name('paymentGateways');

Route::get('/dashboard', fn () => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

// guest login route
Route::post('/guest/login', [HomeController::class, 'guestLogin'])->name('guest.login');

Route::middleware('auth')->group(function () {
    // hashing
    Route::get('/hash', [HashController::class, 'index'])->name('hash.index');
    Route::post('/decrypt', [HashController::class, 'decrypt'])->name('hash.decrypt');
    Route::post('/encrypt', [HashController::class, 'encrypt'])->name('hash.encrypt');

    // Japaneses
    Route::resource('/crud', JapaneseController::class)->parameters(['crud' => 'japanese']);

    // SSLCOMMERZ Start
    Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('gateway.sslcommerz.index');
    Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

    Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
    // SSLCOMMERZ END

    // API's
    Route::get('/web-api', [ApiController::class, 'apis'])->name('api.index');
    Route::get('/weather-api', [ApiController::class, 'weatherAPIIndex'])->name('api.weather.index');
    Route::get('/news-api', [ApiController::class, 'newsAPIIndex'])->name('api.news.index');

    Route::post('/weather-map', [ApiController::class, 'weatherMapApi'])->name('api.weathermap');

    Route::get('/country-info', [CountryController::class, 'index'])->name('api.country.index');
    // End API

    // QR code
    Route::view('/qrcode', 'qrCode.index')->name('qrcode.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Post for auth check (gate policy)
    Route::resource('/posts', PostController::class);

    // form builder
    Route::get('/form-builder', [FormBuilderController::class, 'index'])->name('form.builder');
    Route::post('/form-builder/preview', [FormBuilderController::class, 'preview'])->name('form.builder.preview');
    Route::post('/form-builder/save', [FormBuilderController::class, 'store'])->name('form.builder.save');
    Route::get('/render-form', [FormBuilderController::class, 'renderForm'])->name('form.render');
    Route::post('/generate-preview', [FormBuilderController::class, 'generatePreview']);

    // stripe checkout route
    Route::get('/checkout', [PaymentController::class, 'showCheckoutForm'])->name('stripe.checkout');
    Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

    Route::get('/api-simulator', [ApiSimulatorController::class, 'index'])->name('api.simulator');
    Route::post('/api-simulator', [ApiSimulatorController::class, 'dispatchRequests'])->name('api.simulator.dispatch');
    Route::get('/api/queue-status', [ApiSimulatorController::class, 'getQueueStatus'])->name('api.simulator.status');

    // Redis Wizard Routes
    Route::prefix('redis-wizard')->group(function () {
        Route::get('/', [RedisWizardController::class, 'index'])->name('redis.wizard');
        Route::post('/generate-command', [RedisWizardController::class, 'generateCommand']);
        Route::post('/execute-command', [RedisWizardController::class, 'executeCommand']);
    });

    // Settings Routes
    Route::middleware('can:viewAppSettings')->group(function () {
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    });

    Route::resource('/articles', ArticleController::class);
    Route::resource('/products', ProductController::class);

});

require __DIR__.'/auth.php';
