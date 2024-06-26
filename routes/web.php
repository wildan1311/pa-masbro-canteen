<?php

use App\Http\Controllers\Admin\RuanganController;
use App\Http\Controllers\Kelola\TenantController as KelolaTenantController;
use App\Http\Controllers\MenuKategori;
use App\Http\Controllers\Web\DataController;
use App\Http\Controllers\Web\GedungController;
use App\Http\Controllers\Web\KatalogController;
use App\Http\Controllers\Web\KeuanganController;
use App\Http\Controllers\Web\Konfigurasi\MenuController;
use App\Http\Controllers\Web\Konfigurasi\PengaturanController;
use App\Http\Controllers\Web\Konfigurasi\PermissionController;
use App\Http\Controllers\Web\Konfigurasi\RoleController;
use App\Http\Controllers\Web\PembayaranController;
use App\Http\Controllers\Web\PesananController;
use App\Http\Controllers\Web\RuanganController as WebRuanganController;
use App\Http\Controllers\Web\TenantController;
use App\Http\Controllers\Web\UserController;
use App\Models\Gedung;
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
    return redirect()->route('login');
});


Route::middleware(['shared', 'auth', 'role:tenant|kdh|admin'])->group(function () {

    Route::get('/welcome', function () {
        return view('pages.welcome.index');
    })->name('welcome');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('menu', MenuController::class);
    Route::resource('role', RoleController::class);
    Route::get('role/{id}/permission', [RoleController::class, 'removePermission'])->name('role.destroy.permission');
    Route::resource('permission', PermissionController::class);
    Route::resource('tenant', TenantController::class);
    Route::resource('user', UserController::class);
    Route::resource('menu-kategori', MenuKategori::class);
    Route::resource('ruangan', WebRuanganController::class);
    Route::resource('gedung', GedungController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('pengaturan', PengaturanController::class);

    Route::post('/pembayaran/transfer', [PembayaranController::class, 'transfer'])->name('pembayaran.transfer');

    Route::get('/data', [DataController::class, 'index']);
    Route::get('/pesanan', [PesananController::class, 'index']);
    Route::get('/keuangan', [KeuanganController::class, 'index']);
    Route::get('/katalog', [KatalogController::class, 'index']);

    // Route::group(['prefix' => 'konfigurasi', 'as' => 'konfigurasi.'], function(){
    //     Route::resource('menu', MenuController::class);
    // });
    Route::post('menu/{id}', [KelolaTenantController::class, 'updateMenuWeb']);
});

require __DIR__ . '/auth.php';
