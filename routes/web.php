<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\WaliKelasController;

/*
|--------------------------------------------------------------------------
| HALAMAN KELULUSAN
|--------------------------------------------------------------------------
*/

Route::get('/', [KelulusanController::class, 'index']);

Route::post('/cek', [KelulusanController::class, 'cek'])
    ->name('cek.kelulusan');

// Route::get('/hasil', function () {

//     if (!session()->has('siswa')) {
//         return redirect('/');
//     }

//     return view('kelulusan.hasil', [
//         'siswa' => session('siswa')
//     ]);

// })->name('hasil.kelulusan');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthController::class, 'login'])
    ->name('admin.login');

Route::post('/admin/login', [AuthController::class, 'authenticate'])
    ->name('admin.login.post');

Route::post('/admin/logout', [AuthController::class, 'logout'])
    ->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | SISWA
    |--------------------------------------------------------------------------
    */

    Route::resource('siswa', SiswaController::class);

    /*
    |--------------------------------------------------------------------------
    | WALI KELAS
    |--------------------------------------------------------------------------
    */

    Route::resource('wali-kelas', WaliKelasController::class);

});