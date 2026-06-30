<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalPertandinganController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JadwalPertandinganController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/jadwal', [JadwalPertandinganController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/jadwal/create', [JadwalPertandinganController::class, 'create'])->name('admin.create');
    Route::post('/admin/jadwal/store', [JadwalPertandinganController::class, 'store'])->name('admin.store');
    Route::get('/admin/jadwal/{id}/edit', [JadwalPertandinganController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/jadwal/{id}/update', [JadwalPertandinganController::class, 'update'])->name('admin.update');
    Route::post('/admin/jadwal/{id}/destroy', [JadwalPertandinganController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/jadwal/export', [JadwalPertandinganController::class, 'exportPdf'])->name('admin.export');
});
