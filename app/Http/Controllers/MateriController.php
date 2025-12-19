<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Mapel;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function create(Request $request)
    {
        // Ambil mapel_id dari URL
        $mapel_id = $request->query('mapel_id');
        $mapel = Mapel::findOrFail($mapel_id);

        return view('guru.materi.create', compact('mapel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'mapel_id' => 'required|exists:mapels,id'
        ]);

        Materi::create([
            'nama' => $request->nama,
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

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
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
        return back()->with('success', 'Materi dihapus');
    }
}