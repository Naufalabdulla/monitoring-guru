<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Kelas;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::with('guru')->get();
        // SESUAIKAN: Path view harus ke admin.mapel.index
        return view('admin.mapel.index', compact('mapels'));
    }

    public function create()
    {
        $gurus = User::where('role', 'guru')->get();
        $kelas = Kelas::all(); // Ambil semua data dari tabel kelas
        return view('admin.mapel.create', compact('gurus', 'kelas'));
    }

    public function edit(Mapel $mapel)
    {
        $gurus = User::where('role', 'guru')->get();
        $kelas = Kelas::all();
        return view('admin.mapel.edit', compact('mapel', 'gurus', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kelas_id' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        Mapel::create([
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
            'user_id' => $request->user_id
        ]);

        // SESUAIKAN: Tambahkan 'admin.' pada nama route
        return redirect()->route('admin.dashboard')->with('success', 'Mapel berhasil ditambah');
    }


    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'nama' => 'required',
            'tingkat_kelas' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        $mapel->update($request->all());

        // SESUAIKAN: Tambahkan 'admin.' pada nama route
        return redirect()->route('admin.dashboard')->with('success', 'Mapel berhasil diupdate');
    }

    // Gunakan Model Binding agar lebih aman dan ringkas
    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return back()->with('success', 'Mapel dihapus');
    }
}