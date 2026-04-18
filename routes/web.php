<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DetailPeminjamanController;
use App\Http\Controllers\SopBarangController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| BARANG
|--------------------------------------------------------------------------
*/
Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barang/create', [BarangController::class, 'create']);
Route::post('/barang', [BarangController::class, 'store']);
Route::get('/barang/{id}', [BarangController::class, 'show']);
Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
Route::put('/barang/{id}', [BarangController::class, 'update']);
Route::delete('/barang/{id}', [BarangController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| PEMINJAMAN
|--------------------------------------------------------------------------
*/
Route::get('/peminjaman', [PeminjamanController::class, 'index']);
Route::get('/peminjaman/create', [PeminjamanController::class, 'create']);
Route::post('/peminjaman', [PeminjamanController::class, 'store']);
Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show']);

/*
 STATUS PEMINJAMAN (ADMIN ACTION)
*/
Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve']);
Route::post('/peminjaman/{id}/pinjam', [PeminjamanController::class, 'pinjam']);
Route::post('/peminjaman/{id}/kembali', [PeminjamanController::class, 'pengembalian']);

/*
|--------------------------------------------------------------------------
| DETAIL PEMINJAMAN
|--------------------------------------------------------------------------
*/
Route::get('/detail-peminjaman', [DetailPeminjamanController::class, 'index']);
Route::get('/detail-peminjaman/{id}', [DetailPeminjamanController::class, 'show']);

/*
|--------------------------------------------------------------------------
| SOP BARANG
|--------------------------------------------------------------------------
*/
Route::get('/sop', [SopBarangController::class, 'index']);
Route::get('/sop/{id}', [SopBarangController::class, 'showByBarang']);