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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('/products', App\Http\Controllers\productController::class);
Route::get('/balance/create/{id}', [App\Http\Controllers\balanceController::class, 'create']);
Route::resource('/balance', App\Http\Controllers\balanceController::class);
Route::get('/profit/create/{id}', [App\Http\Controllers\profitController::class, 'create']);
Route::resource('/profit', App\Http\Controllers\profitController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
});
