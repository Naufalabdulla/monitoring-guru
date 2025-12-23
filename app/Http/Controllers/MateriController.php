<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class MateriController extends Controller
{


    public function index()
    {
        // Mengambil semua materi milik guru yang sedang login (jika ada relasi user)
        // Atau ambil semua materi beserta data mapelnya
        $materis = Materi::with('mapel')->get();

        return view('guru.materi.index', compact('materis'));
    }

    public function create(Request $request)
    {
        $mapel_id = $request->query('mapel_id');

        if ($mapel_id) {
            // Jika datang dari Dashboard (ada parameter mapel_id)
            $mapel = Mapel::findOrFail($mapel_id);
            return view('guru.materi.create', compact('mapel'));
        } else {
            // Jika datang dari menu "Materi Saya" (tidak ada parameter mapel_id)
            // Ambil semua mapel agar guru bisa memilih di dalam form create
            $mapels = Mapel::all();
            return view('guru.materi.create', compact('mapels'));
        }
    }
    public function store(Request $request)
    {
        $request->validate(['nama' => 'required', 'mapel_id' => 'required']);

        $materi = new Materi([
            'nama' => $request->nama,
            'mapel_id' => $request->mapel_id,
            'konten' => $request->deskripsi,
        ]);

        if (Auth::user()->role === 'admin') {
            $admin = Admin::find(Auth::id());
            $admin->kelolaMateri($materi); // Admin mengelola materi
        } else {
            $materi->save();
        }

        return redirect()->route(Auth::user()->role . '.dashboard')->with('success', 'Materi dikelola sesuai diagram');
    }

    public function edit($id)
    {
        $materi = Materi::getMateriById($id); // Metode statis dari diagram
        $mapels = Mapel::all();
        return view('guru.materi.edit', compact('materi', 'mapels'));
    }
  public function update(Request $request, Materi $materi)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'mapel_id' => 'required|exists:mapels,id',
        'deskripsi' => 'nullable|string',
    ]);

    // Update menggunakan nama kolom 'deskripsi' agar tidak SQL Error
    $materi->update([
        'nama' => $request->nama,
        'mapel_id' => $request->mapel_id,
        'deskripsi' => $request->deskripsi, 
        'file_pendukung' => $request->file_pendukung
    ]);

    return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diperbarui');
}
    public function destroy(Materi $materi)
    {
        $materi->delete();
        return back()->with('success', 'Materi dihapus');
    }
}
