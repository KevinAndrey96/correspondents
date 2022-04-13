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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
Route::get('/dashboard', function () {
    return view('dashboard');
});*/

Route::get('/products', [App\Http\Controllers\Products\IndexProductController::class, 'index'])->middleware('auth');
Route::get('/products/create', [App\Http\Controllers\Products\CreateProductController::class, 'create'])->middleware('auth');
Route::post('/products', [App\Http\Controllers\Products\StoreProductController::class, 'store'])->middleware('auth');
Route::get('/products/{id}/edit', [App\Http\Controllers\Products\EditProductController::class, 'edit'])->middleware('auth');
Route::patch('/products/{id}', [App\Http\Controllers\Products\UpdateProductController::class, 'update'])->middleware('auth');
Route::delete('/products/{id}', [App\Http\Controllers\Products\DestroyProductController::class, 'destroy'])->middleware('auth');

Route::get('/balance', [App\Http\Controllers\Balances\IndexBalanceController::class, 'index'])->middleware('auth');
Route::get('/balance/create/{id}', [App\Http\Controllers\Balances\CreateBalanceController::class, 'create'])->middleware('auth');
Route::post('/balance', [App\Http\Controllers\Balances\StoreBalanceController::class, 'store'])->middleware('auth');
Route::get('/balance/{id}/edit', [App\Http\Controllers\Balances\EditBalanceController::class, 'edit'])->middleware('auth');
Route::patch('/balance/{id}', [App\Http\Controllers\Balances\UpdateBalanceController::class, 'update'])->middleware('auth');
Route::delete('/balance/{id}', [App\Http\Controllers\Balances\DestroyBalanceController::class, 'destroy'])->middleware('auth');

Route::get('/profit', [App\Http\Controllers\Profits\IndexProfitController::class, 'index'])->middleware('auth');
Route::get('/profit/create/{id}', [App\Http\Controllers\Profits\CreateProfitController::class, 'create'])->middleware('auth');
Route::post('/profit', [App\Http\Controllers\Profits\StoreProfitController::class, 'store'])->middleware('auth');
Route::get('/profit/{id}/edit', [App\Http\Controllers\Profits\EditProfitController::class, 'edit'])->middleware('auth');
Route::patch('/profit/{id}', [App\Http\Controllers\Profits\WithdrawalProfitController::class, 'update'])->middleware('auth');
Route::delete('/profit/{id}', [App\Http\Controllers\Profits\DestroyProfitController::class, 'destroy'])->middleware('auth');

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
