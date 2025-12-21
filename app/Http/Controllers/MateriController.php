<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Mapel;
use Illuminate\Http\Request;

class MateriController extends Controller
{
<<<<<<< HEAD
    public function create(Request $request)
    {
        // Ambil mapel_id dari URL
        $mapel_id = $request->query('mapel_id');
        $mapel = Mapel::findOrFail($mapel_id);

        return view('guru.materi.create', compact('mapel'));
    }

=======


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
>>>>>>> origin/main
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
<<<<<<< HEAD
            'mapel_id' => 'required|exists:mapels,id'
=======
            'mapel_id' => 'required|exists:mapels,id',
            'deskripsi' => 'nullable|string',
            'file_pendukung' => 'nullable|string',
>>>>>>> origin/main
        ]);

        Materi::create([
            'nama' => $request->nama,
<<<<<<< HEAD
            'mapel_id' => $request->mapel_id
        ]);

        return redirect()->route('guru.dashboard')->with('success', 'Materi berhasil dibuat');
    }

   public function edit(Materi $materi)
{
    // Kita perlu mengambil semua daftar mapel agar dropdown di view tidak error
    $mapels = \App\Models\Mapel::all(); 
    
    // Kirimkan $materi DAN $mapels ke view
    return view('guru.materi.edit', compact('materi', 'mapels'));
}
=======
            'mapel_id' => $request->mapel_id,
            'deskripsi' => $request->deskripsi,
            'file_pendukung' => $request->file_pendukung
        ]);

        // SESUAIKAN: Tambahkan 'guru.' pada nama route
        return redirect()->route('guru.dashboard')->with('success', 'Materi berhasil dibuat');
    }

    public function edit(Materi $materi)
    {
        $mapels = Mapel::all();
        return view('guru.materi.edit', compact('materi', 'mapels'));
    }
>>>>>>> origin/main

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
<<<<<<< HEAD
        ]);

        // Update hanya field nama sesuai ERD
        $materi->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('guru.dashboard')->with('success', 'Materi berhasil diubah');
    }

    public function destroy($id)
    {
        Materi::destroy($id);
=======
            'mapel_id' => 'required|exists:mapels,id',
            'deskripsi' => 'nullable|string',
            'file_pendukung' => 'nullable|string',
        ]);

        $materi->update([
            'nama' => $request->nama,
            'mapel_id' => $request->mapel_id,
            'deskripsi' => $request->deskripsi,
            'file_pendukung' => $request->file_pendukung
        ]);

        // SESUAIKAN: Tambahkan 'guru.' pada nama route
        return redirect()->route('guru.dashboard')->with('success', 'Materi berhasil diubah');
    }

    public function destroy(Materi $materi)
    {
        $materi->delete();
>>>>>>> origin/main
        return back()->with('success', 'Materi dihapus');
    }
}