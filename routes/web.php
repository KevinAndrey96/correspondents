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
    return view('auth.login');
});

Auth::routes();


/*
Route::get('/dashboard', function () {
    return view('dashboard');
});*/

Route::group(['middleware' => ['auth', 'transactions', 'isenabled']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/products', [App\Http\Controllers\Products\IndexProductController::class, 'index']);
    Route::get('/products/create', [App\Http\Controllers\Products\CreateProductController::class, 'create']);
    Route::post('/products', [App\Http\Controllers\Products\StoreProductController::class, 'store']);
    Route::get('/products/{id}/edit', [App\Http\Controllers\Products\EditProductController::class, 'edit']);
    Route::patch('/products/{id}', [App\Http\Controllers\Products\UpdateProductController::class, 'update']);
    Route::post('/changeStatusProduct', [App\Http\Controllers\Products\ChangeStatusProductsController::class, 'changeStatus']);
    //Route::delete('/products/delete/{id}', [App\Http\Controllers\Products\DestroyProductController::class, 'destroy']);

    Route::get('/balance', [App\Http\Controllers\Balances\IndexBalanceController::class, 'index']);
    Route::get('/balance/create', [App\Http\Controllers\Balances\CreateBalanceController::class, 'create']);
    Route::post('/balance/store', [App\Http\Controllers\Balances\AddBalanceShopkeeperController::class, 'store']);
    Route::get('/balance/users', [App\Http\Controllers\Balances\ShowBalanceUsersController::class, 'index']);
    Route::get('/balance/add/{id}', [App\Http\Controllers\Balances\CreateBalanceAdminController::class, 'create']);
    Route::post('/balance', [App\Http\Controllers\Balances\AddBalanceAdminController::class, 'store']);
    Route::post('/balance/validate', [App\Http\Controllers\Balances\ValidateBalanceController::class, 'isValid']);
    Route::post('/balance/excel', [App\Http\Controllers\Balances\ExcelExportBalanceController::class, 'export']);

    Route::get('/profit', [App\Http\Controllers\Profits\IndexProfitController::class, 'index']);
    Route::get('/profit/create', [App\Http\Controllers\Profits\CreateProfitController::class, 'create']);
    Route::post('/profit/store', [App\Http\Controllers\Profits\WithdrawProfitController::class, 'store']);
    Route::get('/profit/users', [App\Http\Controllers\Profits\ShowWithdrawProfitController::class, 'index']);
    Route::post('/profit', [App\Http\Controllers\Profits\adminWithdrawProfitController::class, 'store']);
    Route::post('/profit/validate', [App\Http\Controllers\Profits\validateWithdrawProfitController::class, 'isValid']);
    Route::post('/profit/excel', [App\Http\Controllers\Profits\ExcelExportProfitController::class, 'export']);

    Route::get('/transactions', [App\Http\Controllers\Transactions\IndexTransactionController::class, 'index']);
    Route::get('/transactions/create', [App\Http\Controllers\Transactions\CreateTransactionController::class, 'create']);
    Route::post('/transaction/store', [App\Http\Controllers\Transactions\StoreTransactionController::class, 'store']);
    Route::post('/transaction/storeClientData', [App\Http\Controllers\Transactions\AddClientDataController::class, 'store']);
    Route::get('/transaction/cancel/{id}', [App\Http\Controllers\Transactions\CancelTransactionController::class, 'cancel']);
    Route::get('/transaction/detail-pdf/{id}', [App\Http\Controllers\Transactions\DetailTransactionPDFController::class, 'detailPDF']);
    Route::post('/transaction/excel', [App\Http\Controllers\Transactions\ExcelExportTransactionController::class, 'export']);

    Route::get('/users', [App\Http\Controllers\Users\IndexUsersController::class, 'index']);
    Route::get('/user/create', [App\Http\Controllers\Users\CreateUsersController::class, 'create']);
    Route::post('/user/store', [App\Http\Controllers\Users\StoreUsersController::class, 'store']);
    Route::get('/user/edit/{id}', [App\Http\Controllers\Users\EditUsersController::class, 'edit']);
    Route::post('/user/update', [App\Http\Controllers\Users\UpdateUsersController::class, 'update']);
    //Route::get('/user/delete/{id}', [App\Http\Controllers\Users\DeleteUsersController::class, 'delete']);
    Route::post('/changeStatusUser', [App\Http\Controllers\Users\ChangeStatusUsersController::class, 'changeStatus']);
    Route::get('/changePassword', [App\Http\Controllers\Users\ChangePasswordUsersController::class, 'changePassword']);
    Route::post('/updatePassword', [App\Http\Controllers\Users\UpdatePasswordUsersController::class, 'updatePassword']);
    Route::post('/changeOnlineStatusUser', [App\Http\Controllers\Users\ChangeOnlineStatusUsersController::class, 'changeOnlineStatus']);

    Route::get('/commissions', [App\Http\Controllers\Commissions\IndexCommissionsController::class, 'index']);
    Route::get('/commissions/users', [App\Http\Controllers\Commissions\UsersCommissionsController::class, 'usersCommissions']);
    Route::get('/commissions/create/{id}', [App\Http\Controllers\Commissions\CreateCommissionsController::class, 'create']);
    Route::post('/commissions/update', [App\Http\Controllers\Commissions\UpdateCommissionsController::class, 'update']);
});
    Route::get('/transactionLoad/{id}', [App\Http\Controllers\Transactions\LoadTransactionController::class, 'load'])->middleware('auth');
    Route::get('/transactionReasign', [App\Http\Controllers\Transactions\ReasignTransactionController::class, 'transactionReasign'])->middleware('auth');
    Route::get('/transaction/detail/{id}', [App\Http\Controllers\Transactions\DetailTransactionController::class, 'detail'])->middleware('auth');
    Route::post('/transaction/update', [App\Http\Controllers\Transactions\UpdateTransactionController::class, 'update'])->middleware('auth');
    Route::get('/transaction/cancel/{id}', [App\Http\Controllers\Transactions\CancelTransactionController::class, 'cancel']);
