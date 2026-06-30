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

Route::get('/migrate', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
        return 'Migration and seeding run successfully! Output: <br><pre>' . \Illuminate\Support\Facades\Artisan::output() . '</pre>';
    } catch (\Throwable $e) {
        return 'Error during migration: ' . $e->getMessage() . '<br><pre>' . $e->getTraceAsString() . '</pre>';
    }
})->withoutMiddleware('web');

Route::get('/debug-home', function () {
    try {
        $controller = new \App\Http\Controllers\JadwalPertandinganController();
        return $controller->index(request());
    } catch (\Throwable $e) {
        return 'Error: ' . $e->getMessage() . '<br><pre>' . $e->getTraceAsString() . '</pre>';
    }
})->withoutMiddleware('web');

Route::get('/test-key', function () {
    try {
        return [
            'app_key' => env('APP_KEY') ? 'exists' : 'missing',
            'key_length' => strlen(env('APP_KEY')),
            'config_key' => config('app.key') ? 'exists' : 'missing',
            'config_key_length' => strlen(config('app.key')),
        ];
    } catch (\Throwable $e) {
        return 'Error: ' . $e->getMessage();
    }
})->withoutMiddleware('web');
