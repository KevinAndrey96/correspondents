<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TwoFAController;
use App\Http\Middleware\IsenabledMiddleware;
use App\Http\Middleware\TransactionsMiddleware;
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

Route::group(['middleware' => ['auth', 'transactions', 'isenabled', 'isAuthorized']], static function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home')
        ->middleware('distributorExtrainfo', '2fa', 'firstPassword', 'dailyPassword');
    Route::get('/products', [App\Http\Controllers\Products\IndexProductController::class, 'index']);
    Route::get('/products/create', [App\Http\Controllers\Products\CreateProductController::class, 'create']);
    Route::post('/products', [App\Http\Controllers\Products\StoreProductController::class, 'store']);
    Route::get('/products/{id}/edit', [App\Http\Controllers\Products\EditProductController::class, 'edit']);
    Route::patch('/products/{id}', [App\Http\Controllers\Products\UpdateProductController::class, 'update']);
    Route::post('/changeStatusProduct', [App\Http\Controllers\Products\ChangeStatusProductsController::class, 'changeStatus']);
    //Route::delete('/products/delete/{id}', [App\Http\Controllers\Products\DestroyProductController::class, 'destroy']);
    Route::get('/products/{id}/edit', [App\Http\Controllers\Products\EditProductController::class, 'edit']);
    Route::get('/products-transactions-excel/{id}', [App\Http\Controllers\Products\TransactionsProductController::class, 'transactions']);


    Route::get('/balance', [App\Http\Controllers\Balances\IndexBalanceController::class, 'index']);
    Route::get('/balance/create', [App\Http\Controllers\Balances\CreateBalanceController::class, 'create']);
    Route::post('/balance/store', [App\Http\Controllers\Balances\AddBalanceShopkeeperController::class, 'store']);
    Route::get('/balance/users', [App\Http\Controllers\Balances\ShowBalanceUsersController::class, 'index']);
    Route::get('/balance/add/{id}', [App\Http\Controllers\Balances\CreateBalanceAdminController::class, 'create']);
    Route::post('/balance', [App\Http\Controllers\Balances\AddBalanceAdminController::class, 'store']);
    Route::post('/balance/validate', [App\Http\Controllers\Balances\ValidateBalanceController::class, 'isValid']);
    Route::post('/balance/excel', [App\Http\Controllers\Balances\ExcelExportBalanceController::class, 'export']);
    Route::post('/balanceSummary/excel', [App\Http\Controllers\Balances\ExcelExportSummaryController::class, 'export']);
    Route::get('/balance-all', App\Http\Controllers\Balances\AllBalancesController::class);
    Route::get('/balance-assign-supplier/{id}', App\Http\Controllers\Balances\AssignSupplierBalancesController::class);
    Route::post('/balance-store-assignment', App\Http\Controllers\Balances\StoreAssignmentBalanceController::class)->name('balance.store-assignment');


    Route::get('/profit', [App\Http\Controllers\Profits\IndexProfitController::class, 'index']);
    Route::get('/profit/create', [App\Http\Controllers\Profits\CreateProfitController::class, 'create']);
    Route::post('/profit/store', [App\Http\Controllers\Profits\WithdrawProfitController::class, 'store']);
    Route::get('/profit/users', [App\Http\Controllers\Profits\ShowWithdrawProfitController::class, 'index']);
    Route::post('/profit', [App\Http\Controllers\Profits\adminWithdrawProfitController::class, 'store']);
    Route::post('/profit/validate', [App\Http\Controllers\Profits\ValidateWithdrawProfitController::class, 'isValid']);
    Route::post('/profit/excel', [App\Http\Controllers\Profits\ExcelExportProfitController::class, 'export']);


    Route::get('/transactions', [App\Http\Controllers\Transactions\IndexTransactionController::class, 'index']);
    Route::get('/transactions/create', [App\Http\Controllers\Transactions\CreateTransactionController::class, 'create'])->middleware('requestDailyPassword');
    Route::post('/transaction/store', [App\Http\Controllers\Transactions\StoreTransactionController::class, 'store']);
    Route::post('/transaction/storeClientData', [App\Http\Controllers\Transactions\AddClientDataController::class, 'store']);
    Route::get('/transaction/cancel/{id}', [App\Http\Controllers\Transactions\CancelTransactionController::class, 'cancel']);
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
    Route::post('/enabled-daily', App\Http\Controllers\Users\EnabledDailyUsersController::class)
        ->name('users.shopkeeper.enabled.daily');


    Route::get('/commissions', [App\Http\Controllers\Commissions\IndexCommissionsController::class, 'index']);
    Route::get('/commissions/users', [App\Http\Controllers\Commissions\UsersCommissionsController::class, 'usersCommissions']);
    Route::get('/commissions/create/{id}', [App\Http\Controllers\Commissions\CreateCommissionsController::class, 'create']);
    Route::post('/commissions/update', [App\Http\Controllers\Commissions\UpdateCommissionsController::class, 'update']);

    /**
     * Routes for cards
     */

    Route::get('/cards-create', App\Http\Controllers\Cards\ConfigCardsController::class)
        ->name('cards.create');
    Route::post('/cards-store', App\Http\Controllers\Cards\StoreCardsController::class)
        ->name('cards.store');
    Route::get('/cards', App\Http\Controllers\Cards\IndexCardsController::class)
        ->name('cards');
    Route::get('/cards-delete/{id}', App\Http\Controllers\Cards\DeleteCardsController::class)
        ->name('cards.delete');



});
Route::post('/changeOnlineStatusUser', [App\Http\Controllers\Users\ChangeOnlineStatusUsersController::class, 'changeOnlineStatus'])->middleware('auth');

Route::get('/transactionLoad/{id}', [App\Http\Controllers\Transactions\LoadTransactionController::class, 'load'])->middleware('auth');
Route::get('/transactionReasign', [App\Http\Controllers\Transactions\ReasignTransactionController::class, 'transactionReasign'])->middleware('auth');
Route::get('/transaction/detail/{id}', [App\Http\Controllers\Transactions\DetailTransactionController::class, 'detail'])->middleware('auth');
Route::post('/transaction/update', [App\Http\Controllers\Transactions\UpdateTransactionController::class, 'update'])->middleware('auth');
Route::get('/transaction/cancel/{id}', [App\Http\Controllers\Transactions\CancelTransactionController::class, 'cancel']);
Route::get('/transaction/detail-pdf/{id}', [App\Http\Controllers\Transactions\DetailTransactionPDFController::class, 'detailPDF']);

/**
 * Middleware for 2FA
 */

Route::middleware(['2fa'])->group(function () {
    Route::post('/2fa', static function () {
        return redirect(route('home'));
    })->name('2fa');
});

/**
 * Route for controller {@link TwoFAController} QR code view
 */

Route::get('/complete-registration', [TwoFAController::class, 'index'])->name('complete.registration')->middleware('distributorExtrainfo');
Route::get('/complete-registration2', [RegisterController::class, 'fullRegister'])->name('complete.registration2');


/**
 *  Routes for whatsapp
 */
Route::get('/whatsapp-number-transaction',
    App\Http\Controllers\Transactions\NumberWhatsappTransactionController::class)
          ->name('number.whatsapp');


/**
 *  Routes for banners
 */
Route::get('/banners', App\Http\Controllers\Banners\indexBannersController::class)
    ->name('banners.index');
Route::get('/banners-create', App\Http\Controllers\Banners\CreateBannersController::class)
    ->name('banners.create');
Route::post('/banners-store', App\Http\Controllers\Banners\StoreBannersController::class)
    ->name('banners.store');
Route::get('/banners-edit/{id}', App\Http\Controllers\Banners\EditBannersController::class)
    ->name('banners.edit');
Route::post('/banners-update', App\Http\Controllers\Banners\UpdateBannersController::class)
    ->name('banners.update');
Route::get('/banners-delete/{id}', App\Http\Controllers\Banners\DeleteBannersController::class)
    ->name('banners.delete');

/**
 * Routes for top shopkeepers
 */
Route::get('/shopkeepers-top-date', App\Http\Controllers\Users\ShopkeepersTopDateUsersController::class)
    ->name('shopkeeper.top.date');
Route::post('/shopkeepers-top', App\Http\Controllers\Users\ShopkeepersTopUsersController::class)
    ->name('shopkeeper.top');

/**
 * Routes to assign products to suppliers
 */
Route::get('/assign-products/{id}', App\Http\Controllers\Products\AssignProductsController::class)
    ->name('product.assign');
Route::post('/store-assignments-products', App\Http\Controllers\Products\StoreAssignmentsProductsController::class)
    ->name('product.store.assignments');

/**
 * Route to authorize shopkeepers on the platform
 */
Route::post('/change-authorized-user', App\Http\Controllers\Users\AuthorizeShopkeeperUserController::class)
    ->name('users.shopkeeper.authorized');

/**
 * Routes to lock platform
 */

Route::get('/platform-lock-index', App\Http\Controllers\Platforms\LockIndexPlatformController::class)
    ->name('platform.lock.index');

Route::post('/platform-lock', App\Http\Controllers\Platforms\LockPlatformController::class)
    ->name('platform.lock');

/**
 * Route for daily password view
 */

Route::get('/daily-password', App\Http\Controllers\Users\DailyPasswordIndexUsersController::class)
    ->name('users.daily.password.index');

Route::post('/daily-password', App\Http\Controllers\Users\DailyPasswordUsersController::class)
    ->name('users.daily.password');

Route::get('/require-daily-password', App\Http\Controllers\Users\RequireDailyPasswordUsersController::class)
    ->name('users.require.daily.password');

Route::post('/store-required-daily-password', App\Http\Controllers\Users\StoreDailyPasswordUsersController::class)
    ->name('users.store.required.daily.password');

/**
 * Routes for first password
 */

Route::get('/first-password', App\Http\Controllers\Users\FirstPasswordUsersController::class)
    ->name('users.first.password');

Route::post('/store-first-password', App\Http\Controllers\Users\StoreFirstPasswordUsersController::class)
    ->name('users.store.first.password');

/**
 * Routes for distributor extra info
 */
Route::get('/extrainfo', App\Http\Controllers\Users\DistributorExtrainfoUsersController::class)
    ->name('distributor.extrainfo');

Route::post('/store-distributor-extrainfo', App\Http\Controllers\Users\StoreDistributorExtrainfoUsersController::class)
    ->name('store.distributor.extrainfo');

