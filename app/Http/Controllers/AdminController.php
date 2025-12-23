<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mapel;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{


public function index(Request $request)
{
    // 1. Data Statistik Utama
    $totalGuru = User::where('role', 'guru')->count();
    $totalKelas = Kelas::count();
    $totalMapelUnique = Mapel::distinct('nama')->count('nama');
    $totalMapelTerdaftar = Mapel::count();

    // 2. Data untuk pilihan dropdown filter
    $listGuru = User::where('role', 'guru')->orderBy('nama')->get();
    $listKelas = Kelas::orderBy('tingkat')->orderBy('nama')->get();

    // 3. Query Tabel dengan Eager Loading (PENTING: Tambahkan 'progress')
    // Ini memperbaiki error "Call to a member function where() on null"
    $query = Mapel::with(['kelas', 'guru', 'progress']);
    
    // --- Logika Filter ---
    if ($request->filled('search')) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('tingkat')) {
        $query->whereHas('kelas', function($q) use ($request) {
            $q->where('tingkat', $request->tingkat);
        });
    }

    if ($request->filled('guru_id')) {
        $query->where('user_id', $request->guru_id);
    }

    if ($request->filled('kelas_id')) {
        $query->where('kelas_id', $request->kelas_id);
    }
    // ---------------------

    $mapels = $query->latest()->paginate(25);

    return view('admin.dashboard', compact(
        'totalGuru', 'totalKelas', 'mapels', 'listGuru', 
        'listKelas', 'totalMapelUnique', 'totalMapelTerdaftar'
    ));
}
    public function storeGuru(Request $request) {
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);
        return back()->with('success', 'Guru berhasil ditambah');
    }

 public function storeMapel(Request $request) {
    // Perbaikan: Sesuaikan dengan kolom baru 'kelas_id'
    Mapel::create([
        'nama' => $request->nama,
        'kelas_id' => $request->kelas_id, // Gunakan kelas_id hasil dropdown
        'user_id' => $request->guru_id,
    ]);
    return back()->with('success', 'Mapel berhasil dibuat');
}
}