<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Tenant\TenantController;
use App\Http\Controllers\Transaksi\TransaksiController;
use App\Http\Controllers\User\UserController;
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

Route::middleware('auth:sanctum')->namespace('Tenant')->prefix('tenants')->group(function (){
    Route::get('/', 'Tenant\TenantController@getAll');
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::resource('user', UserController::class);

Route::get('/tenants', [TenantController::class, 'getAll']);
Route::get('/tenants/{TenantId}', [TenantController::class, 'getSpecificTenant']);
Route::post('/order', [TransaksiController::class, 'store']);
Route::post('/order/detail', [TransaksiController::class, 'store'])->name('');

// Midtrans
Route::post('/getSnapToken', function(){
    
});
