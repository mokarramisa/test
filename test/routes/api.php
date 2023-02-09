<?php

use App\Http\Controllers\Admin\AccessController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
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

Route::post('/login', [LoginController::class, 'login']);
// region roles and permissions
Route::get('/create-role', [RolesController::class, 'create']);
Route::get('/create-permissions', [PermissionsController::class, 'create']);
Route::post('add-permissions/ {permission_id}', [PermissionsController::class, 'store'] );

Route::resource('/admin/users', UserController::class);

Route::post('/admin/users/view-user', [UserController::class, 'viewUser']);
Route::post('/admin/users/show-user', [UserController::class, 'show']);

Route::post('/admin/discounts/create', [PromotionController::class, 'create']);