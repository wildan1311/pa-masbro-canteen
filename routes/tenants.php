<?php

use App\Http\Controllers\Kelola\TenantController;
use App\Http\Controllers\Kelola\TenantOrderController;
use App\Http\Controllers\Transaksi\TransaksiDetailController;
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

Route::prefix('tenant')->middleware(['auth:sanctum', 'role:tenant'])->name('api.tenant.')->group(function(){
    Route::get('/', [TenantController::class, 'index']);
    Route::post('/menu', [TenantController::class, 'storeMenu']);
    Route::put('/menu/{id}', [TenantController::class, 'updateMenu']);
    Route::delete('/menu/{id}', [TenantController::class, 'destroyMenu']);

    Route::get('/order', [TenantOrderController::class, 'index']);
    Route::put('/order/{id}', [TenantOrderController::class, 'update']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
