<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\SiswaController;

Route::get('/', [LandingController::class, 'index']);
Route::get('/v-layanan/{slug}', [LandingController::class, 'detillayanan']);

Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

Route::resource('kategori', KategoriController::class);
Route::resource('layanan', LayananController::class);
Route::resource('testimoni', TestimoniController::class);
Route::resource('kontak', KontakController::class)->middleware('auth');
Route::resource('useraccount', UserAccountController::class)->middleware('auth');

Route::post('/kirim-whatsapp', [LandingController::class, 'sendWhatsApp'])->name('send.whatsapp');
Route::post('/kirim-whatsapp2', [LandingController::class, 'sendWhatsAppDaftar'])->name('send.whatsappDaftar');

//LOGIN
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('masterdata.dashboard');
})->name('dashboard')->middleware('auth');
