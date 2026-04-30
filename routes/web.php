<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DetailPeminjamanController;
use App\Http\Controllers\SopBarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| SEMUA USER (LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    // Barang (user hanya lihat)
    Route::resource('barang', BarangController::class)->only([
        'index', 'show'
    ]);
     // Barang (user hanya lihat)
    Route::resource('sop', SopBarangController::class)->only([
        'index'
    ]);
    

    // Peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create']);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);
    Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show']);
});

/*
|--------------------------------------------------------------------------
| KHUSUS ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin') ->group(function () {

    // User
    Route::resource('users', UserController::class);
    

    // Barang (full akses)
    Route::resource('barang', BarangController::class)->except([
        'index', 'show'
    ]);

         // SOP (admin full akses kecuali show)
    Route::resource('sop', SopBarangController::class)->except(['show']);

    // Lihat SOP berdasarkan barang
    Route::get('/sop/barang/{barang_id}', [SopBarangController::class, 'showByBarang']);
    
    // Aksi peminjaman
    Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve']);
    Route::post('/peminjaman/{id}/pinjam', [PeminjamanController::class, 'pinjam']);
    Route::post('/peminjaman/{id}/kembali', [PeminjamanController::class, 'pengembalian']);

    // Detail peminjaman
    Route::resource('detail-peminjaman', DetailPeminjamanController::class);
    Route::get('/detail-peminjaman/peminjaman/{id}', [DetailPeminjamanController::class, 'byPeminjaman']);


});