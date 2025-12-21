<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MateriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Guru\MapelGuruController;
use App\Http\Controllers\Guru\ProgressGuruController;

// Halaman Utama (Langsung lempar ke Admin Dashboard)
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Grup Admin
// Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('mapel', MapelController::class); // Menangani Index, Create, Edit, Update, Delete
});

// Guru
// Bagian Guru di web.php
Route::name('guru.')->prefix('guru')->group(function () {
    // Nama route ini akan menjadi guru.dashboard
    Route::get('/dashboard', [GuruController::class, 'index'])->name('dashboard');
    
    // Nama route resource ini akan menjadi guru.materi.index, guru.materi.update, dll
    Route::resource('materi', MateriController::class); 
});