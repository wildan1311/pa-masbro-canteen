<?php

use App\Http\Controllers\Web\Konfigurasi\MenuController;
use App\Http\Controllers\Web\Konfigurasi\PermissionController;
use App\Http\Controllers\Web\Konfigurasi\RoleController;
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


Route::middleware(['shared','auth'])->group(function(){

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('menu', MenuController::class);
    Route::resource('role', RoleController::class);
    Route::get('role/{id}/permission', [RoleController::class, 'removePermission'])->name('role.destroy.permission');
    Route::resource('permission', PermissionController::class);

    // Route::group(['prefix' => 'konfigurasi', 'as' => 'konfigurasi.'], function(){
    //     Route::resource('menu', MenuController::class);
    // });
});

require __DIR__.'/auth.php';
