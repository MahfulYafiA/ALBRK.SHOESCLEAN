<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Models\Layanan;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pelanggan\ReservasiController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AntreanController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\SuperAdminUserController;
use App\Http\Controllers\SuperAdmin\SuperAdminLayananController;
use App\Http\Controllers\SuperAdmin\SuperAdminLaporanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\MidtransCallbackController;

// ==========================================
// 1. RUTE LANDING PAGE (Publik)
// ==========================================
Route::get('/', function () {
    $layanans = Schema::hasTable('ms_layanan') ? Layanan::all() : [];
    return view('beranda.landing', compact('layanans'));
})->name('landing');

Route::get('/media/{path}', function (string $path) {
    abort_unless(\Illuminate\Support\Facades\Storage::disk('public')->exists($path), 404);

    return \Illuminate\Support\Facades\Storage::disk('public')->response($path);
})->where('path', '.*')->name('media.public');

// ==========================================
// 2. RUTE WEBHOOK MIDTRANS (Wajib di luar auth)
// ==========================================
Route::post('/midtrans/callback', [MidtransCallbackController::class, 'callback'])->name('midtrans.callback');

// ==========================================
// 3. RUTE AUTENTIKASI
// ==========================================
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

    // Register
    Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);

    // Password Reset
    Route::get('/forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'requestForm'])->name('password.request');
    Route::post('/forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'sendEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [\App\Http\Controllers\PasswordResetController::class, 'resetForm'])->name('password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\PasswordResetController::class, 'updatePassword'])->name('password.update');
});

// ==========================================
// 4. RUTE TERPROTEKSI
// ==========================================
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Settings (Universal Banner Update)
    Route::post('/update-hero-banner', [LayananController::class, 'updateHero'])->name('update.hero.universal');
    Route::post('/update-tentang-kami', [LayananController::class, 'updateTentang'])->name('update.tentang.universal');

    // Profil Management
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
        Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('updatePassword');
        Route::patch('/foto', [ProfileController::class, 'updateFoto'])->name('updateFoto');
        Route::delete('/foto', [ProfileController::class, 'hapusFoto'])->name('hapusFoto');
    });

    // Dashboard Redirect
    Route::get('/dashboard', function () {
        $role = auth()->user()->id_role;

        if ($role == 1) {
            return redirect()->route('superadmin.dashboard');
        } elseif ($role == 2) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('pelanggan.dashboard');
    })->name('dashboard');

    // ==========================================
    // AREA PELANGGAN
    // ==========================================
    Route::prefix('reservasi')->name('reservasi.')->group(function () {
        Route::get('/baru', [ReservasiController::class, 'create'])->name('create');
        Route::post('/baru', [ReservasiController::class, 'store'])->name('store');
        Route::get('/riwayat', [ReservasiController::class, 'riwayat'])->name('riwayat');
        Route::get('/pembayaran/{id}', [ReservasiController::class, 'pembayaran'])->name('pembayaran');
        Route::post('/pilih-pengembalian/{id}', [ReservasiController::class, 'pilihPengembalian'])->name('pilih-pengembalian');
        Route::post('/cancel/{id}', [ReservasiController::class, 'cancel'])->name('cancel');
    });

    // Pelanggan Dashboard
    Route::get('/pelanggan/dashboard', [ReservasiController::class, 'dashboard'])->name('pelanggan.dashboard');

    // ==========================================
    // AREA ADMIN
    // ==========================================
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

        // User Management
        Route::get('/users', [UserManagementController::class, 'index'])->name('users');
        Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
        Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');

        // Antrean Management
        Route::get('/antrean', [AntreanController::class, 'index'])->name('antrean');
        Route::post('/reservasi/update/{id}', [AntreanController::class, 'updateStatus'])->name('reservasi.update');
        Route::delete('/reservasi/delete/{id}', [AntreanController::class, 'destroy'])->name('reservasi.destroy');

        // Layanan Management
        Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
        Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
        Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
        Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

        // Laporan
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

        // Transaksi Offline
        Route::get('/kasir-offline', [TransaksiController::class, 'createOffline'])->name('transaksi.offline');
        Route::post('/kasir-offline', [TransaksiController::class, 'storeOffline'])->name('transaksi.store-offline');
    });

    // ==========================================
    // AREA SUPERADMIN
    // ==========================================
    Route::prefix('superadmin')->name('superadmin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [SuperAdminDashboardController::class, 'dashboard'])->name('dashboard');

        // User Management
        Route::get('/users', [SuperAdminUserController::class, 'index'])->name('users');
        Route::post('/users', [SuperAdminUserController::class, 'store'])->name('users.store');
        Route::delete('/users/{id}', [SuperAdminUserController::class, 'destroy'])->name('users.destroy');

        // Layanan Management
        Route::get('/layanan', [SuperAdminLayananController::class, 'index'])->name('layanan.index');
        Route::post('/layanan', [SuperAdminLayananController::class, 'store'])->name('layanan.store');
        Route::put('/layanan/{id}', [SuperAdminLayananController::class, 'update'])->name('layanan.update');
        Route::delete('/layanan/{id}', [SuperAdminLayananController::class, 'destroy'])->name('layanan.destroy');

        // Laporan
        Route::get('/laporan', [SuperAdminLaporanController::class, 'index'])->name('laporan');
    });
});
