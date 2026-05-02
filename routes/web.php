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
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| USER (LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    // Barang (USER hanya lihat)
    Route::resource('barang', BarangController::class)->only([
        'index', 'show'
    ]);

    // SOP (USER)
    Route::resource('sop', SopBarangController::class)->only([
        'index'
    ]);

    // Peminjaman USER
    Route::prefix('peminjaman')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index']);
        Route::get('/create', [PeminjamanController::class, 'create']);
        Route::post('/', [PeminjamanController::class, 'store']);
        Route::get('/{id}', [PeminjamanController::class, 'show']);
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    /*
    |---------------------------------
    | FIX PENTING: INDEX ADMIN BARANG
    |---------------------------------
    */
    Route::get('barang', [BarangController::class, 'index'])
        ->name('barang.index');

    // CRUD barang admin
    Route::resource('barang', BarangController::class)
        ->except(['index', 'show']);

    // SOP admin
    Route::resource('sop', SopBarangController::class)
        ->except(['show']);

    Route::get('sop/barang/{barang_id}', [SopBarangController::class, 'showByBarang'])
        ->name('sop.byBarang');

    // Peminjaman admin
    Route::post('peminjaman/{id}/approve', [PeminjamanController::class, 'approve']);
    Route::post('peminjaman/{id}/pinjam', [PeminjamanController::class, 'pinjam']);
    Route::post('peminjaman/{id}/kembali', [PeminjamanController::class, 'pengembalian']);

    // Detail peminjaman
    Route::resource('detail-peminjaman', DetailPeminjamanController::class);

    Route::get('detail-peminjaman/peminjaman/{id}', [DetailPeminjamanController::class, 'byPeminjaman']);

    // User management
    Route::resource('users', UserController::class);
});