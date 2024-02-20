<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getStatus/{id}', [App\Http\Controllers\GetstatusController::class, 'index']);
Route::get('/getCountryName', [App\Http\Controllers\GetCountryNameController::class, 'index']);

// Statistics Data
Route::post('/get-statistics-data', App\Http\Controllers\StatisticsDataController::class)->name('GetStatisticsData');
