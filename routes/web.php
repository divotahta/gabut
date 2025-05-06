<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Owner Controllers
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\MitraController as OwnerMitraController;
use App\Http\Controllers\Owner\PengajuanMitraController as OwnerPengajuanMitraController;
use App\Http\Controllers\Owner\PegawaiController as OwnerPegawaiController;
use App\Http\Controllers\Owner\AkunController as OwnerAkunController;
use App\Http\Controllers\Owner\LaporanController as OwnerLaporanController;

// Petani Controllers
use App\Http\Controllers\Petani\MitraController as PetaniMitraController;
use App\Http\Controllers\Petani\DashboardController as PetaniDashboardController;

// Pegawai Controllers
use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboardController;
use App\Http\Controllers\Pegawai\MitraController as PegawaiMitraController;
use App\Http\Controllers\Pegawai\LaporanController as PegawaiLaporanController;
use App\Http\Controllers\Pegawai\AkunController as PegawaiAkunController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    
    // Owner Routes
    Route::middleware(['role:owner'])->prefix('owner')->name('owner.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboard');
        
        // Laporan Management
        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', [OwnerLaporanController::class, 'index'])->name('index');
            Route::get('/search', [OwnerLaporanController::class, 'search'])->name('search');
            Route::get('/create', [OwnerLaporanController::class, 'create'])->name('create');
            Route::post('/', [OwnerLaporanController::class, 'store'])->name('store');
            Route::get('/{laporan}', [OwnerLaporanController::class, 'show'])->name('show');
            Route::get('/{laporan}/edit', [OwnerLaporanController::class, 'edit'])->name('edit');
            Route::put('/{laporan}', [OwnerLaporanController::class, 'update'])->name('update');
            Route::delete('/{laporan}', [OwnerLaporanController::class, 'destroy'])->name('destroy');
        });

        // Mitra Management
        Route::prefix('mitra')->name('mitra.')->group(function () {
            Route::get('/', [OwnerMitraController::class, 'index'])->name('index');
            Route::get('/create', [OwnerMitraController::class, 'create'])->name('create');
            Route::post('/', [OwnerMitraController::class, 'store'])->name('store');
            Route::get('/pengajuan', [OwnerMitraController::class, 'pengajuan'])->name('pengajuan');
            Route::get('/{mitra}', [OwnerMitraController::class, 'show'])->name('show');
            Route::get('/{mitra}/edit', [OwnerMitraController::class, 'edit'])->name('edit');
            Route::put('/{mitra}', [OwnerMitraController::class, 'update'])->name('update');
            Route::delete('/{mitra}', [OwnerMitraController::class, 'destroy'])->name('destroy');
            Route::put('/{mitra}/approve', [OwnerMitraController::class, 'approve'])->name('approve');
            Route::put('/{mitra}/reject', [OwnerMitraController::class, 'reject'])->name('reject');
            Route::get('/laporan', [OwnerMitraController::class, 'laporan'])->name('laporan');
            Route::get('/search/mitra', [OwnerMitraController::class, 'search'])->name('search');
        });

        // Pegawai Management
        Route::prefix('pegawai')->name('pegawai.')->group(function () {
            Route::get('/', [OwnerPegawaiController::class, 'index'])->name('index');
            Route::get('/create', [OwnerPegawaiController::class, 'create'])->name('create');
            Route::post('/', [OwnerPegawaiController::class, 'store'])->name('store');
            Route::get('/{pegawai}', [OwnerPegawaiController::class, 'show'])->name('show');
            Route::get('/{pegawai}/edit', [OwnerPegawaiController::class, 'edit'])->name('edit');
            Route::put('/{pegawai}', [OwnerPegawaiController::class, 'update'])->name('update');
        });

        // Akun Management
        Route::prefix('akun')->name('akun.')->group(function () {
            Route::get('/', [OwnerAkunController::class, 'index'])->name('index');
            Route::get('/create', [OwnerAkunController::class, 'create'])->name('create');
            Route::post('/', [OwnerAkunController::class, 'store'])->name('store');
            Route::get('/{akun}', [OwnerAkunController::class, 'show'])->name('show');
            Route::get('/{akun}/edit', [OwnerAkunController::class, 'edit'])->name('edit');
            Route::put('/{akun}', [OwnerAkunController::class, 'update'])->name('update');
        });

        // Route untuk profil owner
        Route::get('/akun', [App\Http\Controllers\Owner\AkunController::class, 'index'])->name('akun.index');
        Route::put('/akun', [App\Http\Controllers\Owner\AkunController::class, 'update'])->name('akun.update');
    });

    // Petani Routes
    Route::middleware(['role:petani'])->prefix('petani')->name('petani.')->group(function () {
        Route::get('dashboard', [PetaniDashboardController::class, 'index'])->name('dashboard');
        // Mitra Routes
        Route::prefix('mitra')->name('mitra.')->group(function () {
            Route::get('/', [PetaniMitraController::class, 'index'])->name('index');
            Route::get('/create', [PetaniMitraController::class, 'create'])->name('create');
            Route::post('/', [PetaniMitraController::class, 'store'])->name('store');
            Route::get('/{mitra}', [PetaniMitraController::class, 'show'])->name('show');
        });
    });

    // Pegawai Routes
    Route::middleware(['role:pegawai'])->prefix('pegawai')->name('pegawai.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [PegawaiDashboardController::class, 'index'])->name('dashboard');

        // Mitra Management
        Route::prefix('mitra')->name('mitra.')->group(function () {
            Route::get('/', [PegawaiMitraController::class, 'index'])->name('index');
            Route::get('/{mitra}', [PegawaiMitraController::class, 'show'])->name('show');
            Route::get('/{mitra}/edit', [PegawaiMitraController::class, 'edit'])->name('edit');
            Route::put('/{mitra}', [PegawaiMitraController::class, 'update'])->name('update');
        });

        // Laporan
        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', [PegawaiLaporanController::class, 'index'])->name('index');
            Route::get('/create', [PegawaiLaporanController::class, 'create'])->name('create');
            Route::post('/', [PegawaiLaporanController::class, 'store'])->name('store');
            Route::get('/{laporan}', [PegawaiLaporanController::class, 'show'])->name('show');
        });

        // Akun Management
        Route::prefix('akun')->name('akun.')->group(function () {
            Route::get('/', [PegawaiAkunController::class, 'index'])->name('index');
            Route::get('/create', [PegawaiAkunController::class, 'create'])->name('create');
            Route::post('/', [PegawaiAkunController::class, 'store'])->name('store');
            Route::get('/{akun}', [PegawaiAkunController::class, 'show'])->name('show');
            Route::get('/{akun}/edit', [PegawaiAkunController::class, 'edit'])->name('edit');
            Route::put('/{akun}', [PegawaiAkunController::class, 'update'])->name('update');
            Route::delete('/{akun}', [PegawaiAkunController::class, 'destroy'])->name('destroy');
        });
    });

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
