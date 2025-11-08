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

use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Dokter\RekamMedisDocController;

use App\Http\Controllers\Perawat\DashboardPerawatController;
use App\Http\Controllers\Perawat\RekamMedisController;

use App\Http\Controllers\Pemilik\DashboardPemilikController;

use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Resepsionis\RegistrasiPemilikController;
use App\Http\Controllers\Resepsionis\RegistrasiPetController;
use App\Http\Controllers\Resepsionis\TemuDokterController;


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
Route::get('/force-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/')->with('success', 'Logout berhasil');
});

Route::get('/check-auth', function () {
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

        // ✅ TAMBAHKAN ROUTE INI - Reset Password
        Route::post('user/{id}/reset-password', [UserController::class, 'resetPassword'])
            ->name('admin.user.reset-password');


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

Route::middleware(['web', 'isResepsionis'])->group(function () {
    // Dashboard
    Route::get('/resepsionis/dashboard', [DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard');

    // Registrasi Pemilik
    Route::get('/resepsionis/registrasi/pemilik', [RegistrasiPemilikController::class, 'create'])->name('resepsionis.registrasi.pemilik');
    Route::post('/resepsionis/registrasi/pemilik', [RegistrasiPemilikController::class, 'store'])->name('resepsionis.registrasi.pemilik.store');

    // Registrasi Pet
    Route::get('/resepsionis/registrasi/pet', [RegistrasiPetController::class, 'create'])->name('resepsionis.registrasi.pet');
    Route::post('/resepsionis/registrasi/pet', [RegistrasiPetController::class, 'store'])->name('resepsionis.registrasi.pet.store');

    // Temu Dokter (ini sudah berfungsi sebagai manajemen antrian)
    Route::get('/resepsionis/temu-dokter', [TemuDokterController::class, 'index'])->name('resepsionis.temu-dokter');
    Route::post('/resepsionis/temu-dokter', [TemuDokterController::class, 'store'])->name('resepsionis.temu-dokter.store');
    Route::post('/resepsionis/temu-dokter/update-status', [TemuDokterController::class, 'updateStatus'])->name('resepsionis.temu-dokter.update-status');
});
/*
|--------------------------------------------------------------------------
| Dokter Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['isDokter'])->prefix('dokter')->name('dokter.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardDokterController::class, 'index'])->name('dashboard');

    // Rekam Medis
    Route::get('/rekam-medis', [RekamMedisDocController::class, 'list'])->name('rekam-medis.list');
    Route::get('/rekam-medis/{id}', [RekamMedisDocController::class, 'detail'])->name('rekam-medis.detail');
    Route::get('/rekam-medis/create/{id}', [RekamMedisDocController::class, 'create'])->name('rekam-medis.create');

    // Jadwal Praktek - TAMBAHKAN INI
    Route::get('/jadwal-praktek', [DashboardDokterController::class, 'jadwalPraktek'])->name('jadwal-praktek');

    // Pasien Hari Ini - TAMBAHKAN INI
    Route::get('/pasien-hari-ini', [DashboardDokterController::class, 'pasienHariIni'])->name('pasien-hari-ini');
});

/*
|--------------------------------------------------------------------------
| Perawat Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['isPerawat'])->prefix('perawat')->name('perawat.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardPerawatController::class, 'index'])->name('dashboard');

    // Rekam Medis
    Route::get('/rekam-medis', [DashboardPerawatController::class, 'rekamMedis'])->name('rekam-medis');

    // Pasien Hari Ini
    Route::get('/pasien-hari-ini', [DashboardPerawatController::class, 'pasienHariIni'])->name('pasien-hari-ini');

    // Tindakan
    Route::get('/tindakan', [DashboardPerawatController::class, 'tindakan'])->name('tindakan');
    Route::get('/tindakan/create/{id}', [DashboardPerawatController::class, 'tindakanCreate'])->name('tindakan.create');
});

/*
|--------------------------------------------------------------------------
| Pemilik Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['web', 'isPemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
        // Dashboard & Home
        Route::get('/dashboard', [DashboardPemilikController::class, 'index'])->name('dashboard');
        Route::get('/home', [DashboardPemilikController::class, 'index'])->name('home'); // ✅ TAMBAHKAN INI
        
        // Pet
        Route::get('/pet', [DashboardPemilikController::class, 'petList'])->name('pet.list');
        
        // Rekam Medis
        Route::get('/rekammedis', [DashboardPemilikController::class, 'rekamMedis'])->name('rekammedis.list');
        
        // Reservasi
        Route::get('/reservasi', [DashboardPemilikController::class, 'reservasi'])->name('reservasi.list');
        
        // Riwayat
        Route::get('/riwayat', [DashboardPemilikController::class, 'riwayat'])->name('riwayat.list');
    });