<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DetailPeminjamanController;
use App\Http\Controllers\SopBarangController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

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
| USER AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        if(auth()->user()->role != 'admin'){
            abort(403);
        }

        return view('admin.dashboard');

    })->name('dashboard');

    Route::get('/home', function () {

        if(auth()->user()->role != 'user'){
            abort(403);
        }

        return view('user.home');

    })->name('home');


    /*
    |--------------------------------------------------------------------------
    | BARANG (USER VIEW ONLY)
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

    Route::get('/sop/{id}', [SopBarangController::class, 'show'])
        ->name('sop.show');


    /*
    |--------------------------------------------------------------------------
    | PEMINJAMAN USER
    |--------------------------------------------------------------------------
    */

    Route::prefix('peminjaman')
        ->name('peminjaman.')
        ->group(function () {

        Route::get('/', [PeminjamanController::class, 'index'])
            ->name('index');

        Route::get('/create', [PeminjamanController::class, 'create'])
            ->name('create');

        Route::post('/', [PeminjamanController::class, 'store'])
            ->name('store');

        Route::get('/{id}', [PeminjamanController::class, 'show'])
            ->name('show');

        Route::get('/{id}/edit', [PeminjamanController::class, 'edit'])
            ->name('edit');

        Route::put('/{id}', [PeminjamanController::class, 'update'])
            ->name('update');

        Route::post('/{id}/ajukan-pengembalian',
            [PeminjamanController::class, 'ajukanPengembalian'])
            ->name('ajukanPengembalian');

    });

     Route::get('/profile', [UserController::class, 'profile'])
        ->name('profile');

    Route::get('/profile/edit', [UserController::class, 'editProfile'])
        ->name('profile.edit');

    Route::put('/profile/update', [UserController::class, 'updateProfile'])
        ->name('profile.update');

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
    | BARANG ADMIN
    |--------------------------------------------------------------------------
    */

    Route::resource('barang', BarangController::class);

      /*
    |--------------------------------------------------------------------------
    | SOP ADMIN
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | SOP (ADMIN CRUD)
    |--------------------------------------------------------------------------
    */

    Route::get('/sop', [SopBarangController::class, 'index'])
        ->name('sop.index');

    Route::get('/sop/create', [SopBarangController::class, 'create'])
        ->name('sop.create');

    Route::post('/sop', [SopBarangController::class, 'store'])
        ->name('sop.store');

    // Route::get('/sop/{id}', [SopBarangController::class, 'show'])
    //     ->name('sop.show');

    Route::get('/sop/{id}/edit', [SopBarangController::class, 'edit'])
        ->name('sop.edit');

    Route::put('/sop/{id}', [SopBarangController::class, 'update'])
        ->name('sop.update');

    Route::delete('/sop/{id}', [SopBarangController::class, 'destroy'])
        ->name('sop.destroy');

    Route::get('/sop/barang/{barang_id}', [SopBarangController::class, 'showByBarang'])
        ->name('sop.byBarang');

    /*
    |--------------------------------------------------------------------------
    | PEMINJAMAN ADMIN
    |--------------------------------------------------------------------------
    */

    Route::resource('peminjaman', PeminjamanController::class)
        ->only(['index', 'destroy']);

    Route::post('peminjaman/{id}/approve',
        [PeminjamanController::class, 'approve'])
        ->name('peminjaman.approve');

    Route::post('peminjaman/{id}/kembali',
        [PeminjamanController::class, 'pengembalian'])
        ->name('peminjaman.kembali');


    /*
    |--------------------------------------------------------------------------
    | DETAIL PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    Route::resource('detail-peminjaman',
        DetailPeminjamanController::class);

    Route::get('detail-peminjaman/peminjaman/{id}',
        [DetailPeminjamanController::class, 'byPeminjaman'])
        ->name('detail-peminjaman.byPeminjaman');


    /*
    |--------------------------------------------------------------------------
    | USER MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::resource('users', UserController::class);

});