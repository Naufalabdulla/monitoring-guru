<?php
<<<<<<< HEAD
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
=======

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
>>>>>>> origin/main
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MateriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Guru\MapelGuruController;
use App\Http\Controllers\Guru\ProgressGuruController;

// Halaman Utama (Langsung lempar ke Admin Dashboard)
Route::get('/', function () {
<<<<<<< HEAD
    return redirect()->route('admin.dashboard');
=======
    return redirect()->route('login');
});

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('mapel', MapelController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('kelas', KelasController::class);
});


// Group Guru
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'index'])->name('dashboard');
    Route::resource('/materi', MateriController::class);
    Route::get('/mapel', [MapelGuruController::class, 'index'])->name('mapel.index');
    Route::get('/progress', [ProgressGuruController::class, 'index'])
        ->name('progress.index');

    Route::get('/progress/{progress}/edit', [ProgressGuruController::class, 'edit'])
        ->name('progress.edit');

    Route::put('/progress/{progress}', [ProgressGuruController::class, 'update'])
        ->name('progress.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
>>>>>>> origin/main
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