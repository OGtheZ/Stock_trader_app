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
Route::post('/stock/{symbol}/buy', [\App\Http\Controllers\TransactionsController::class, 'buyStock'])->middleware('auth');
Route::get('/addFunds', [\App\Http\Controllers\TransactionsController::class, 'showAddFundsPage'])->middleware('auth');
Route::post('/addFunds', [\App\Http\Controllers\TransactionsController::class, 'addFunds'])->middleware('auth');
Route::get('/portfolio', [\App\Http\Controllers\StocksController::class, 'showPortfolio'])->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
