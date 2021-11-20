<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/stocks', [\App\Http\Controllers\StocksController::class, 'index'])->middleware('auth');
Route::post('/stocks', [\App\Http\Controllers\StocksController::class, 'showSymbols'])->middleware('auth');
Route::get('/stock/{symbol}', [\App\Http\Controllers\StocksController::class, 'showCompanyInfo'])->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
