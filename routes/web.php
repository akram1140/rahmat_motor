<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Rahmat Motor Baebunta (Laravel 9 + MySQL)
|--------------------------------------------------------------------------
*/

// ==================== PUBLIC ROUTES ====================
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/layanan', [PublicController::class, 'layanan'])->name('layanan');
Route::get('/booking', [PublicController::class, 'booking'])->name('booking');
Route::post('/booking', [PublicController::class, 'storeBooking'])->name('booking.store');
Route::get('/cek-booking', [PublicController::class, 'cekBooking'])->name('cek-booking');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');
Route::get('/tentang', [PublicController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PublicController::class, 'storeKontak'])->name('kontak.store');
Route::get('/lokasi', [PublicController::class, 'lokasi'])->name('lokasi');

// Backwards-compatible legacy redirects (.php aliases)
Route::redirect('/index.php', '/');
Route::redirect('/layanan.php', '/layanan');
Route::redirect('/booking.php', '/booking');
Route::redirect('/cek-booking.php', '/cek-booking');
Route::redirect('/galeri.php', '/galeri');
Route::redirect('/tentang.php', '/tentang');
Route::redirect('/kontak.php', '/kontak');
Route::redirect('/lokasi.php', '/lokasi');
Route::redirect('/admin/login.php', '/admin/login');
Route::redirect('/admin/index.php', '/admin/dashboard');
Route::redirect('/admin/booking.php', '/admin/booking');
Route::redirect('/admin/layanan.php', '/admin/layanan');
Route::redirect('/admin/pelanggan.php', '/admin/pelanggan');
Route::redirect('/admin/galeri.php', '/admin/galeri');
Route::redirect('/admin/pesan.php', '/admin/pesan');
Route::redirect('/admin/pengaturan.php', '/admin/pengaturan');

// ==================== ADMIN AUTH ROUTES ====================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::any('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Booking
        Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
        Route::post('/booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.status');
        Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');

        // Pelanggan
        Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
        Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

        // Layanan
        Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
        Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
        Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
        Route::post('/layanan/{id}/toggle', [LayananController::class, 'toggleStatus'])->name('layanan.toggle');
        Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

        // Galeri
        Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
        Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
        Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

        // Pesan Masuk
        Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');
        Route::post('/pesan/{id}/read', [PesanController::class, 'markAsRead'])->name('pesan.read');
        Route::delete('/pesan/{id}', [PesanController::class, 'destroy'])->name('pesan.destroy');

        // Pengaturan
        Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
        Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
    });
});
