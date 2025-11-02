<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\rshp\rshpController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Perawat\DashboardPerawatController;
use App\Http\Controllers\Pemilik\DashboardPemilikController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Cek koneksi database
Route::get('/cek-koneksi', [rshpController::class, 'cekKoneksi'])->name('site.cek-koneksi');

// Halaman utama
Route::get('/', [rshpController::class, 'index'])->name('home');
Route::get('/struktur', [rshpController::class, 'struktur'])->name('struktur');
Route::get('/layanan', [rshpController::class, 'layanan'])->name('layanan');
Route::get('/visi-misi', [rshpController::class, 'visiMisi'])->name('visi-misi');

// Authentication Routes (Laravel default)
Auth::routes();

// Temporary routes untuk debugging
Route::get('/force-logout', function() {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/')->with('success', 'Logout berhasil');
});

Route::get('/check-auth', function() {
    if (Auth::check()) {
        return 'User sedang login: ' . Auth::user()->email;
    }
    return 'User belum login';
});

/*
|--------------------------------------------------------------------------
| Administrator Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['isAdministrator'])->prefix('admin')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    // Data Master Routes
    Route::prefix('datamaster')->group(function () {
        
        // User
        Route::resource('user', UserController::class)->names([
            'index' => 'admin.user.index',
            'create' => 'admin.user.create',
            'store' => 'admin.user.store',
            'edit' => 'admin.user.edit',
            'update' => 'admin.user.update',
            'destroy' => 'admin.user.destroy',
        ]);

        // Pemilik
        Route::resource('pemilik', PemilikController::class)->names([
            'index' => 'admin.pemilik.index',
            'create' => 'admin.pemilik.create',
            'store' => 'admin.pemilik.store',
            'edit' => 'admin.pemilik.edit',
            'update' => 'admin.pemilik.update',
            'destroy' => 'admin.pemilik.destroy',
        ]);

        // Pet
        Route::resource('pet', PetController::class)->names([
            'index' => 'admin.pet.index',
            'create' => 'admin.pet.create',
            'store' => 'admin.pet.store',
            'edit' => 'admin.pet.edit',
            'update' => 'admin.pet.update',
            'destroy' => 'admin.pet.destroy',
        ]);

        // Jenis Hewan
        Route::resource('jenis-hewan', JenisHewanController::class)->names([
            'index' => 'admin.jenis-hewan.index',
            'create' => 'admin.jenis-hewan.create',
            'store' => 'admin.jenis-hewan.store',
            'edit' => 'admin.jenis-hewan.edit',
            'update' => 'admin.jenis-hewan.update',
            'destroy' => 'admin.jenis-hewan.destroy',
        ]);

        // Ras Hewan
        Route::resource('ras-hewan', RasHewanController::class)->names([
            'index' => 'admin.ras-hewan.index',
            'create' => 'admin.ras-hewan.create',
            'store' => 'admin.ras-hewan.store',
            'edit' => 'admin.ras-hewan.edit',
            'update' => 'admin.ras-hewan.update',
            'destroy' => 'admin.ras-hewan.destroy',
        ]);

        // Role
        Route::resource('role', RoleController::class)->names([
            'index' => 'admin.role.index',
            'create' => 'admin.role.create',
            'store' => 'admin.role.store',
            'edit' => 'admin.role.edit',
            'update' => 'admin.role.update',
            'destroy' => 'admin.role.destroy',
        ]);

        // Kategori
        Route::resource('kategori', KategoriController::class)->names([
            'index' => 'admin.kategori.index',
            'create' => 'admin.kategori.create',
            'store' => 'admin.kategori.store',
            'edit' => 'admin.kategori.edit',
            'update' => 'admin.kategori.update',
            'destroy' => 'admin.kategori.destroy',
        ]);

        // Kategori Klinis (pakai alias kk di URL)
        Route::resource('kk', KategoriKlinisController::class)->names([
            'index' => 'admin.kategori-klinis.index',
            'create' => 'admin.kategori-klinis.create',
            'store' => 'admin.kategori-klinis.store',
            'edit' => 'admin.kategori-klinis.edit',
            'update' => 'admin.kategori-klinis.update',
            'destroy' => 'admin.kategori-klinis.destroy',
        ]);

        // Kode Tindakan Terapi (pakai alias ktt di URL)
        Route::resource('ktt', KodeTindakanTerapiController::class)->names([
            'index' => 'admin.kode-tindakan-terapi.index',
            'create' => 'admin.kode-tindakan-terapi.create',
            'store' => 'admin.kode-tindakan-terapi.store',
            'edit' => 'admin.kode-tindakan-terapi.edit',
            'update' => 'admin.kode-tindakan-terapi.update',
            'destroy' => 'admin.kode-tindakan-terapi.destroy',
        ]);
    });
});

/*
|--------------------------------------------------------------------------
| Resepsionis Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['isResepsionis'])->prefix('resepsionis')->group(function () {
    Route::get('/dashboard', [DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard');
});

/*
|--------------------------------------------------------------------------
| Dokter Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['isDokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', [DashboardDokterController::class, 'index'])->name('dokter.dashboard');
});

/*
|--------------------------------------------------------------------------
| Perawat Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['isPerawat'])->prefix('perawat')->group(function () {
    Route::get('/dashboard', [DashboardPerawatController::class, 'index'])->name('perawat.dashboard');
});

/*
|--------------------------------------------------------------------------
| Pemilik Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['isPemilik'])->prefix('pemilik')->group(function () {
    Route::get('/dashboard', [DashboardPemilikController::class, 'index'])->name('pemilik.dashboard'); // ✅ Perbaiki typo 'oemilik' -> 'pemilik'
});