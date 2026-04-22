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
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// 🔐 INI MIDDLEWARE
Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::resource('barang', BarangController::class);
    Route::resource('users', UserController::class);

});

// 🔐 INI MIDDLEWARE KHUSUS ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

// 🔐 INI MIDDLEWARE USER + ADMIN (SEMUA LOGIN)
Route::middleware(['auth'])->group(function () {
    Route::resource('barang', BarangController::class);
});


/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
Route::resource('users', UserController::class);

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
Route::get('/detail-peminjaman/create', [DetailPeminjamanController::class, 'create']);
Route::post('/detail-peminjaman', [DetailPeminjamanController::class, 'store']);
Route::get('/detail-peminjaman/{id}/edit', [DetailPeminjamanController::class, 'edit']);
Route::put('/detail-peminjaman/{id}', [DetailPeminjamanController::class, 'update']);
Route::delete('/detail-peminjaman/{id}', [DetailPeminjamanController::class, 'destroy']);

// route custom
Route::get('/detail-peminjaman/peminjaman/{id}', [DetailPeminjamanController::class, 'byPeminjaman']);

/*
|--------------------------------------------------------------------------
| SOP BARANG
|--------------------------------------------------------------------------
*/
Route::get('/sop', [SopBarangController::class, 'index']);
Route::get('/sop/create', [SopBarangController::class, 'create']);
Route::post('/sop', [SopBarangController::class, 'store']);
Route::get('/sop/{id}/edit', [SopBarangController::class, 'edit']);
Route::put('/sop/{id}', [SopBarangController::class, 'update']);
Route::delete('/sop/{id}', [SopBarangController::class, 'destroy']);

// detail per barang (custom)
Route::get('/sop/barang/{barang_id}', [SopBarangController::class, 'showByBarang']);