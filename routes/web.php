<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/jadwal', function () {
    return view('jadwal.index');
})->name('jadwal.index');

Route::get('/jadwal/create', function () {
    return view('jadwal.create');
})->name('jadwal.create');

Route::post('/jadwal', function () {
    return redirect()->route('jadwal.index');
})->name('jadwal.store');

Route::get('/kelas', function () {
    return view('kelas.index');
})->name('kelas.index');

Route::get('/kelas/create', function () {
    return view('kelas.create');
})->name('kelas.create');

Route::post('/kelas', function () {
    return redirect()->route('kelas.index');
})->name('kelas.store');
