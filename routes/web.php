<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    AuthController,
    AdminController,
    GuruController,
    JadwalController,
    KelasController,
    MapelController,
    MateriController,
    ProfileController,
    AdminGuruController
};
use App\Http\Controllers\Guru\{MapelGuruController, ProgressGuruController};

/*
|--------------------------------------------------------------------------
| Logic Root Route (Mencegah Loop Redirect)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (Auth::check()) {
        // Jika sudah login, arahkan ke dashboard sesuai role
        return Auth::user()->role === 'admin' 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('guru.dashboard');
    }
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Guest Middleware)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout harus bisa diakses semua user yang login
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Resource untuk manajemen data (Admin mengatur semuanya)
    Route::resource('mapel', MapelController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('guru', AdminGuruController::class);
});

/*
|--------------------------------------------------------------------------
| Group Guru (Role: Guru)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'index'])->name('dashboard');
    
    // Fitur khusus Guru: Progress & Materi
    Route::get('/mapel', [MapelGuruController::class, 'index'])->name('mapel.index');
    Route::get('/progress/{mapel_id}', [ProgressGuruController::class, 'index'])->name('progress.index');
    Route::put('/progress/{id}', [ProgressGuruController::class, 'update'])->name('progress.update');
    
    Route::resource('materi', MateriController::class);
    Route::resource('jadwal', JadwalController::class)->only(['index']); // Guru hanya bisa melihat jadwal
});

/*
|--------------------------------------------------------------------------
| Profile & Shared Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
