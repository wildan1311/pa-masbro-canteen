<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RuanganController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tenants', [TenantController::class, 'getAll']);
    Route::get('/tenants/{TenantId}', [TenantController::class, 'getSpecificTenant']);
    Route::post('/order', [TransaksiController::class, 'store']);
    Route::post('/order/detail', [TransaksiController::class, 'store'])->name('');
    Route::get('/ruangan', [RuanganController::class, 'index']);
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::resource('user', UserController::class);

// Midtrans
Route::post('/getSnapToken', function () {
    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = 'SB-Mid-server-VVST_NSHtMMRxUO6Wm768Ejv';
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = false;

    $params = array(
        'transaction_details' => array(
            'order_id' => rand(),
            'gross_amount' => 10000,
        ),
        'customer_details' => array(
            'first_name' => 'budi',
            'last_name' => 'pratama',
            'email' => 'budi.pra@example.com',
            'phone' => '08111222333',
        ),
    );

    $response = \Midtrans\Snap::createTransaction($params);

    return response()->json($response);
});
