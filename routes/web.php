<?php

use App\Http\Controllers\HashController;
use App\Http\Controllers\Japanese\JapaneseController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/hash', [HashController::class, 'index'])->name('hash.index');
    Route::post('/decrypt', [HashController::class, 'decrypt'])->name('hash.decrypt');
    Route::post('/encrypt', [HashController::class, 'encrypt'])->name('hash.encrypt');

    // Japaneses
    Route::resource('/japaneses', JapaneseController::class);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
