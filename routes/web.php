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

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing');
});

/*
|--------------------------------------------------------------------------
| USER AREA (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | BARANG (USER)
    |--------------------------------------------------------------------------
    */
    Route::resource('barang', BarangController::class)
        ->only(['index', 'show']);

    /*
    |--------------------------------------------------------------------------
    | SOP (USER VIEW ONLY)
    |--------------------------------------------------------------------------
    */
    Route::get('/sop', [SopBarangController::class, 'index'])
        ->name('sop.index');

    /*
    |--------------------------------------------------------------------------
    | PEMINJAMAN (USER)
    |--------------------------------------------------------------------------
    */
    Route::prefix('peminjaman')->name('peminjaman.')->group(function () {

        Route::get('/', [PeminjamanController::class, 'index'])->name('index');
        Route::get('/create', [PeminjamanController::class, 'create'])->name('create');
        Route::post('/', [PeminjamanController::class, 'store'])->name('store');

        Route::get('/{id}', [PeminjamanController::class, 'show'])->name('show');

        Route::post('/{id}/ajukan-pengembalian', [PeminjamanController::class, 'ajukanPengembalian'])
            ->name('ajukanPengembalian');
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | BARANG (ADMIN CRUD FULL)
        |--------------------------------------------------------------------------
        */
        Route::resource('barang', BarangController::class);

        /*
        |--------------------------------------------------------------------------
        | SOP (ADMIN CRUD)
        |--------------------------------------------------------------------------
        */
        Route::resource('sop', SopBarangController::class)->except(['show']);

        Route::get('sop/barang/{barang_id}', [SopBarangController::class, 'showByBarang'])
            ->name('sop.byBarang');

        /*
        |--------------------------------------------------------------------------
        | PEMINJAMAN (ADMIN)
        |--------------------------------------------------------------------------
        */
        Route::resource('peminjaman', PeminjamanController::class)
            ->only(['index', 'destroy']);

        Route::post('peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])
            ->name('peminjaman.approve');

        Route::post('peminjaman/{id}/kembali', [PeminjamanController::class, 'pengembalian'])
            ->name('peminjaman.kembali');

        /*
        |--------------------------------------------------------------------------
        | DETAIL PEMINJAMAN
        |--------------------------------------------------------------------------
        */
        Route::resource('detail-peminjaman', DetailPeminjamanController::class);

        Route::get('detail-peminjaman/peminjaman/{id}', [DetailPeminjamanController::class, 'byPeminjaman'])
            ->name('detail-peminjaman.byPeminjaman');

        /*
        |--------------------------------------------------------------------------
        | USER MANAGEMENT
        |--------------------------------------------------------------------------
        */
        Route::resource('users', UserController::class);
    });