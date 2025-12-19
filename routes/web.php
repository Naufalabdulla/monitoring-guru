<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/kelas', function (Request $request) {
    $kelas = $request->session()->get('kelas', []); // ambil data dari session
    return view('kelas.index', compact('kelas'));
})->name('kelas.index');

Route::get('/kelas/create', function () {
    return view('kelas.create');
})->name('kelas.create');

Route::post('/kelas', function (Request $request) {
    $request->validate([
        'namaKelas' => 'required|string|max:100',
    ]);

    $kelas = $request->session()->get('kelas', []);

    // tambah data baru ke array
    $kelas[] = [
        'namaKelas' => $request->namaKelas,
    ];

    // simpan balik ke session
    $request->session()->put('kelas', $kelas);

    return redirect()->route('kelas.index');
})->name('kelas.store');
