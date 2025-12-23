<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
   public function index(Request $request) 
{
    // Statistik Total Kelas
    $totalKelas = Kelas::count();

    // Query Dasar
    $query = Kelas::query();

    // Filter 1: Cari Nama Kelas
    if ($request->filled('search')) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    // Filter 2: Tingkat (ENUM 10, 11, 12)
    if ($request->filled('tingkat')) {
        $query->where('tingkat', $request->tingkat);
    }

    // Paginate maksimal 20 data per halaman
    $kelas = $query->orderBy('tingkat', 'asc')
                  ->orderBy('nama', 'asc')
                  ->paginate(20);

    return view('admin.kelas.index', compact('kelas', 'totalKelas'));
}
    public function create() {
        return view('admin.kelas.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|unique:kelas,nama',
            'tingkat' => 'required'
        ]);

        Kelas::create($request->all());
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambah');
    }

    public function edit(Kelas $kela) { // Laravel otomatis menjadikannya $kela (singular)
        return view('admin.kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela) {
        $request->validate([
            'nama' => 'required|unique:kelas,nama,' . $kela->id,
            'tingkat' => 'required'
        ]);

        $kela->update($request->all());
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diupdate');
    }

    public function destroy(Kelas $kela) {
        $kela->delete();
        return back()->with('success', 'Kelas berhasil dihapus');
    }
}
