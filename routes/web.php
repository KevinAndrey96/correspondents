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


Route::get('/balance/create/{id}', [App\Http\Controllers\BalanceController::class, 'create']);
Route::resource('/balance', App\Http\Controllers\BlanceController::class);
Route::get('/profit/create/{id}', [App\Http\Controllers\ProfitController::class, 'create']);
Route::resource('/profit', App\Http\Controllers\ProfitController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
Route::get('/dashboard', function () {
    return view('dashboard');
});*/
Route::resource('/products', App\Http\Controllers\ProductController::class);

Route::get('/transactions', [App\Http\Controllers\Transactions\IndexTransactionController::class, 'index'])->middleware('auth');
Route::get('/transaction/create', [App\Http\Controllers\Transactions\CreateTransactionController::class, 'create'])->middleware('auth');
Route::post('/transaction/store', [App\Http\Controllers\Transactions\StoreTransactionController::class, 'store'])->middleware('auth');
Route::post('/transaction/storeClientData', [App\Http\Controllers\Transactions\AddClientDataController::class, 'store'])->middleware('auth');

Route::get('/users', [App\Http\Controllers\Users\IndexUsersController::class, 'index'])->middleware('auth');
Route::get('/user/create', [App\Http\Controllers\Users\CreateUsersController::class, 'create'])->middleware('auth');
Route::post('/user/store', [App\Http\Controllers\Users\StoreUsersController::class, 'store'])->middleware('auth');
Route::get('/user/edit/{id}', [App\Http\Controllers\Users\EditUsersController::class, 'edit'])->middleware('auth');
Route::post('/user/update', [App\Http\Controllers\Users\UpdateUsersController::class, 'update'])->middleware('auth');
Route::get('/user/delete/{id}', [App\Http\Controllers\Users\DeleteUsersController::class, 'delete'])->middleware('auth');
Route::post('/changeStatusUser', [App\Http\Controllers\Users\ChangeStatusUsersController::class, 'changeStatus'])->middleware('auth');
Route::get('/changePassword', [App\Http\Controllers\Users\ChangePasswordUsersController::class, 'changePassword'])->middleware('auth');
Route::post('/updatePassword', [App\Http\Controllers\Users\UpdatePasswordUsersController::class, 'updatePassword'])->middleware('auth');
