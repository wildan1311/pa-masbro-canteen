<?php

use App\Http\Controllers\Masbro\PesananController;
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

Route::prefix('masbro')->middleware(['auth:sanctum', 'role:masbro'])->name('api.masbro.')->group(function(){
    Route::get('/', [PesananController::class, 'index']);
    Route::put('/{transaksiId}', [PesananController::class, 'update']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
