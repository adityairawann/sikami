<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


// ================= HALAMAN AWAL =================
Route::get('/', function () {
    return redirect('/login');
});


// ================= AUTH =================
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost']);

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);


// ================= USER =================
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PENILAIAN
    Route::get('/penilaian', [PenilaianController::class, 'pilihDomain'])->name('penilaian');
    Route::get('/penilaian/{id}', [PenilaianController::class, 'index'])->name('penilaian.domain');
    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');

    // HASIL USER
    Route::get('/hasil-evaluasi', [LaporanController::class, 'hasil'])->name('hasil');

    // LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/pdf', [LaporanController::class, 'cetakPdf'])->name('laporan.pdf');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});


// ================= ADMIN =================
Route::middleware(['auth'])->group(function () {

    // DASHBOARD ADMIN
    Route::get('/admin', [AdminController::class, 'dashboard']);

    // ================= KELOLA USER =================
    Route::get('/admin/users', [AdminController::class, 'users']);
    Route::get('/admin/users/edit/{id}', [AdminController::class, 'editUser']);
    Route::post('/admin/users/update/{id}', [AdminController::class, 'updateUser']);
    Route::get('/admin/users/delete/{id}', [AdminController::class, 'deleteUser']);
    
    // ================= DOMAIN =================
    Route::get('/admin/domain', [AdminController::class, 'domain']);

    // ================= PERTANYAAN =================
    Route::get('/admin/pertanyaan', [AdminController::class, 'pertanyaan']);
    Route::get('/admin/pertanyaan/tambah', [AdminController::class, 'tambahPertanyaan']);
    Route::post('/admin/pertanyaan/store', [AdminController::class, 'storePertanyaan']);
    Route::get('/admin/pertanyaan/edit/{id}', [AdminController::class, 'editPertanyaan']);
    Route::post('/admin/pertanyaan/update/{id}', [AdminController::class, 'updatePertanyaan']);
    Route::get('/admin/pertanyaan/delete/{id}', [AdminController::class, 'deletePertanyaan']);

    // DATA PENILAIAN
    Route::get('/admin/penilaian', [AdminController::class, 'penilaian']);

    // HAPUS DATA PENILAIAN
Route::get('/admin/penilaian/delete/{id}', [AdminController::class, 'deletePenilaian']);

    // PILIH USER (SIMPAN SESSION)
    Route::get('/admin/pilih/{id}', [AdminController::class, 'pilih']);

    // HASIL EVALUASI (TANPA ID)
    // ================= HASIL EVALUASI =================
    Route::get('/admin/hasil', [AdminController::class, 'hasil']);
    
    // ================= LAPORAN =================
    Route::get('/admin/laporan', [AdminController::class, 'laporan']);
    Route::get('/admin/laporan/pdf', [AdminController::class, 'cetakPdf']);
});