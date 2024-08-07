<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TwoFAController;
use App\Http\Middleware\IsenabledMiddleware;
use App\Http\Middleware\TransactionsMiddleware;
use Illuminate\Support\Facades\Auth;
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



/*
Route::get('/', function () {
    return view('auth.login');
});
*/

Route::get('/', App\Http\Controllers\Users\PersonalizeLoginUserController::class);

Auth::routes();
Route::impersonate();


//'disable2fa'
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
    Route::get('/products/{id}/edit', [App\Http\Controllers\Products\EditProductController::class, 'edit']);
    Route::get('/products-transactions-excel/{id}', [App\Http\Controllers\Products\TransactionsProductController::class, 'transactions']);
    Route::get('/delete-product/{id}', App\Http\Controllers\Products\DeleteProductController::class)->name('product.delete');

    //Routes for translations
    Route::get('/translations', App\Http\Controllers\Translations\IndexTranslationsController::class)->name('translations.index');
    Route::get('/product-fields', App\Http\Controllers\Products\FieldsProductsController::class)->name('product.fields');
    Route::get('/product-fields-edit', App\Http\Controllers\Products\EditFieldsProductsController::class)->name('product.fields-edit');
    Route::post('/product-fields-store', App\Http\Controllers\Products\StoreFieldsProductsController::class)->name('product.fields-store');
    Route::get('/transactions-fields', App\Http\Controllers\Transactions\FieldsTransactionsController::class)->name('transactions.fields');
    Route::get('/transactions-fields-edit', App\Http\Controllers\Transactions\EditFieldsTransactionsController::class)->name('transactions.fields-edit');
    Route::post('/transactions-fields-store', App\Http\Controllers\Transactions\StoreFieldsTransactionsController::class)->name('transactions.fields-store');
    Route::get('/keywords', App\Http\Controllers\Translations\IndexKeywordsController::class)->name('keywords.index');


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
    Route::get('/balance-detail-pdf/{id}', App\Http\Controllers\Balances\DetailPDFBalancesController::class)->name('balance.detail-pdf');


    Route::get('/profit', [App\Http\Controllers\Profits\IndexProfitController::class, 'index']);
    Route::get('/profit/create', [App\Http\Controllers\Profits\CreateProfitController::class, 'create']);
    Route::post('/profit/store', [App\Http\Controllers\Profits\WithdrawProfitController::class, 'store']);
    Route::get('/profit/users', [App\Http\Controllers\Profits\ShowWithdrawProfitController::class, 'index']);
    Route::post('/profit', [App\Http\Controllers\Profits\adminWithdrawProfitController::class, 'store']);
    Route::post('/profit/validate', [App\Http\Controllers\Profits\ValidateWithdrawProfitController::class, 'isValid']);
    Route::post('/profit/excel', [App\Http\Controllers\Profits\ExcelExportProfitController::class, 'export']);


    Route::get('/transactions', [App\Http\Controllers\Transactions\IndexTransactionController::class, 'index']);
    Route::get('/transactions/create', [App\Http\Controllers\Transactions\CreateTransactionController::class, 'create'])->middleware('requestDailyPassword');
    Route::get('/giros/create', [App\Http\Controllers\Transactions\CreateGirosTransactionController::class, 'create']);
    Route::post('/transaction/store', [App\Http\Controllers\Transactions\StoreTransactionController::class, 'store']);
    Route::post('/transaction/storeClientData', [App\Http\Controllers\Transactions\AddClientDataController::class, 'store']);
    Route::get('/transaction/cancel/{id}', [App\Http\Controllers\Transactions\CancelTransactionController::class, 'cancel']);
    Route::post('/transaction/excel', [App\Http\Controllers\Transactions\ExcelExportTransactionController::class, 'export']);


    Route::get('/users', [App\Http\Controllers\Users\IndexUsersController::class, 'index']);
    Route::get('/user/create', [App\Http\Controllers\Users\CreateUsersController::class, 'create']);
    Route::post('/user/store', [App\Http\Controllers\Users\StoreUsersController::class, 'store']);
    Route::get('/user/edit/{id}', [App\Http\Controllers\Users\EditUsersController::class, 'edit']);
    Route::post('/user/update', [App\Http\Controllers\Users\UpdateUsersController::class, 'update']);
    Route::post('/changeStatusUser', [App\Http\Controllers\Users\ChangeStatusUsersController::class, 'changeStatus']);
    Route::get('/changePassword', [App\Http\Controllers\Users\ChangePasswordUsersController::class, 'changePassword']);
    Route::post('/updatePassword', [App\Http\Controllers\Users\UpdatePasswordUsersController::class, 'updatePassword']);
    Route::post('/enabled-daily', App\Http\Controllers\Users\EnabledDailyUsersController::class)
        ->name('users.shopkeeper.enabled.daily');
    Route::get('/mode-spectator/{id}/{isInspector}', App\Http\Controllers\Users\ModeSpectatorUsersController::class)
        ->name('mode.spectator');
    Route::post('/user-enable-qr', App\Http\Controllers\Users\EnableQRUsersController::class)
        ->name('users.enableQR');
    Route::get('/change-distributor/{id}', App\Http\Controllers\Users\ChangeDistributorUsersController::class)
        ->name('users.change-distributor');
    Route::post('/store-distributor-change', App\Http\Controllers\Users\StoreDistributorChangeUsersController::class)
        ->name('users.store-distributor-change');
    Route::get('/users-change-transaction-limit/{id}', App\Http\Controllers\Users\ChangeTransactionLimitUsersController::class)
        ->name('users.change-transaction-limit');
    Route::post('/users-store-transaction-limits', App\Http\Controllers\Users\StoreTransactionLimitsUsersController::class)
        ->name('users.store-transaction-limits');
    Route::get('/users-delete-transaction-limits/{id}', App\Http\Controllers\Users\DeleteTransactionLimitsUsersController::class)
        ->name('users.delete-transaction-limits');
    Route::post('/user-enable-dev-mode', App\Http\Controllers\Users\EnableDevModeUsersController::class)
        ->name('users.enableDevMode');



    Route::get('/commissions', [App\Http\Controllers\Commissions\IndexCommissionsController::class, 'index'])->name('commissions.index');
    Route::get('/commissions/users', [App\Http\Controllers\Commissions\UsersCommissionsController::class, 'usersCommissions']);
    Route::get('/commissions/create/{id}', [App\Http\Controllers\Commissions\CreateCommissionsController::class, 'create']);
    Route::post('/commissions/update', [App\Http\Controllers\Commissions\UpdateCommissionsController::class, 'update']);
    Route::get('/commission-groups', App\Http\Controllers\Commissions\IndexGroupsCommissionsController::class)->name('commissions.groups');
    Route::get('/create-commission-group', App\Http\Controllers\Commissions\CreateGroupCommissionsController::class)->name('commissions.create-group');
    Route::post('/store-commission-group', App\Http\Controllers\Commissions\StoreGroupCommissionsController::class)->name('commissions.store-group');
    Route::get('/commission-groups', App\Http\Controllers\Commissions\IndexGroupsCommissionsController::class)->name('commissions.groups');
    Route::get('/assign-commissions-group/{id}', App\Http\Controllers\Commissions\AssignGroupCommissionsController::class)->name('commissions.assign-group');
    Route::post('/store-commissions-group-assignment', App\Http\Controllers\Commissions\StoreGroupAssigmentCommissionsController::class)->name('commissions.store-group-assignment');
    Route::get('/edit-commissions-group/{id}', App\Http\Controllers\Commissions\EditGroupCommissionsController::class)->name('commissions.edit-group');
    Route::post('/update-commission-group', App\Http\Controllers\Commissions\UpdateGroupCommissionsController::class)->name('commissions.update-group');

    /**
     * Routes for cards
     */

    Route::get('/cards-create', App\Http\Controllers\Cards\ConfigCardsController::class)
        ->name('cards.create');
    Route::post('/cards-store', App\Http\Controllers\Cards\StoreCardsController::class)
        ->name('cards.store');
    Route::get('/cards-edit/{id}', App\Http\Controllers\Cards\EditCardsController::class)
        ->name('cards.edit');
    Route::post('/cards-update', App\Http\Controllers\Cards\UpdateCardsController::class)
        ->name('cards.update');
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
Route::get('/transactions-transfer/{id}',
    App\Http\Controllers\Transactions\TransferTransactionController::class)
    ->name('transactions.transfer');

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

/**
 * Routes for preloaded answers
 */

Route::get('/answers', App\Http\Controllers\Answers\IndexAnswersController::class)
    ->name('answers.index');
Route::get('/answers-create', App\Http\Controllers\Answers\CreateAnswersController::class)
    ->name('answers.create');
Route::post('/answers-store', App\Http\Controllers\Answers\StoreAnswersController::class)
    ->name('answers.store');
Route::get('/answers-delete/{id}', App\Http\Controllers\Answers\DeleteAnswersController::class)
    ->name('answers.delete');

/**
 * Routes for chats
 */

Route::get('/chat/{id}', App\Http\Controllers\Chats\indexChatsController::class)
    ->name('chat');

/**
 * Routes for publicity
 */

Route::get('/publicity', App\Http\Controllers\Publicity\IndexPublicityController::class)
    ->name('publicity.index');
Route::get('/publicity-create', App\Http\Controllers\Publicity\CreatePublicityController::class)
    ->name('publicity.create');
Route::post('/publicity-store', App\Http\Controllers\Publicity\StorePublicityController::class)
    ->name('publicity.store');
Route::get('/publicity-delete/{id}', App\Http\Controllers\Publicity\DeletePublicityController::class)
    ->name('publicity.delete');
Route::get('/publicity-download/{id}', App\Http\Controllers\Publicity\DownloadPublicityController::class)
    ->name('publicity.download');

/**
 * Routes for Exchange
 */

Route::get('/exchanges', App\Http\Controllers\Exchanges\IndexExchangesController::class)
    ->name('exchanges.index');
Route::get('/exchanges-edit/{id}', App\Http\Controllers\Exchanges\EditExchangesController::class)
    ->name('exchanges.edit');
Route::post('/exchanges-update', App\Http\Controllers\Exchanges\UpdateExchangesController::class)
    ->name('exchanges.update');

/**
 * Routes for brands
 */

Route::get('/brands', App\Http\Controllers\Brands\IndexBrandsController::class)
    ->name('brands.index');
Route::get('/brands-create', App\Http\Controllers\Brands\CreateBrandsController::class)
    ->name('brands.create');
Route::post('/brands-store', App\Http\Controllers\Brands\StoreBrandsController::class)
    ->name('brands.store');
Route::get('/brands-edit/{id}', App\Http\Controllers\Brands\EditBrandsController::class)
    ->name('brands.edit');
Route::post('/brands-update', App\Http\Controllers\Brands\UpdateBrandsController::class)
    ->name('brands.update');

/**
 * Routes for roles and permissions
 */

//Roles
Route::get('/roles', App\Http\Controllers\Roles\IndexRolesController::class)
    ->name('roles.index');

//Permissions
Route::get('/permissions', App\Http\Controllers\Permissions\IndexPermissionsController::class)
    ->name('permissions.index');






