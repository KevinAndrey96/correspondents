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

// Roles
Route::post('/role-store', App\Http\Controllers\Roles\StoreRolesController::class)->name('roles.store');
Route::get('/get-all-roles', App\Http\Controllers\Roles\GetAllRolesController::class)->name('roles.getAll');
Route::get('/get-role-register/{id}', App\Http\Controllers\Roles\GetRegisterRolesController::class)->name('roles.getRegister');
Route::post('/role-update', App\Http\Controllers\Roles\UpdateRolesController::class)->name('roles.update');
Route::get('/get-all-and-assigned-permissions/{id}', App\Http\Controllers\Roles\GetAllAndAssignedPermissionsRolesController::class)->name('roles.getAllAndAssignedPermissions');
Route::post('/save-permission-assignments', App\Http\Controllers\Roles\SavePermissionAssignmentsRolesController::class)->name('roles.savePermissionAssignments');

// Permissions
Route::get('/get-all-permissions', App\Http\Controllers\Permissions\GetAllPermissionsController::class)->name('permissions.getAll');
Route::post('/permission-store', App\Http\Controllers\Permissions\StorePermissionsController::class)->name('permissions.store');
Route::get('/get-permission-register/{id}', App\Http\Controllers\Permissions\GetRegisterPermissionsController::class)->name('permissions.getRegister');
Route::post('/permission-update', App\Http\Controllers\Permissions\UpdatePermissionsController::class)->name('permissions.update');
Route::post('/save-role-assignments', App\Http\Controllers\Permissions\SaveRoleAssignmentsPermissionsController::class)->name('permissions.saveRoleAssignments');
