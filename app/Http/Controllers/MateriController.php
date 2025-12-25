<?php

namespace App\Http\Controllers;

use App\Models\{Materi, Mapel, Guru};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
  public function index(Request $request)
{
    $guru = Guru::findOrFail(Auth::id());
    
    // Ambil daftar mapel milik guru untuk dropdown filter
    $mapels = Mapel::where('user_id', $guru->id)->with('kelas')->get();

    $query = Materi::whereHas('mapel', function($q) use ($guru) {
        $q->where('user_id', $guru->id);
    });

    // Filter berdasarkan klik tombol "Lihat Materi" dari halaman Mapel
    if ($request->filled('mapel_id')) {
        $query->where('mapel_id', $request->mapel_id);
    }

    if ($request->filled('search')) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    $materis = $query->latest()->get();

    return view('guru.materi.index', compact('materis', 'mapels'));
}
    public function store(Request $request)
    {
        $guru = Guru::findOrFail(Auth::id());

        $materi = new Materi([
            'nama' => $request->nama, // Mewakili 'judul' di diagram
            'mapel_id' => $request->mapel_id,
            'deskripsi' => $request->deskripsi, // Mewakili 'konten' di diagram
            'file_pendukung' => $request->file_pendukung,
        ]);

        // + createMateri(m: Materi): void
        $materi->createMateri($materi);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dibuat');
    }

    public function update(Request $request, $id)
    {
        // + getMateriById(id: String): Materi
        $materi = Materi::getMateriById($id);

        $materi->nama = $request->nama;
        $materi->mapel_id = $request->mapel_id;
        $materi->deskripsi = $request->deskripsi;

        // + updateMateri(m: Materi): void
        $materi->updateMateri($materi);

        return redirect()->route('guru.materi.index')->with('success', 'Materi diperbarui');
    }

    public function destroy($id)
    {
        // + deleteMateri(id: String): void
        Materi::deleteMateri($id);

        return back()->with('success', 'Materi berhasil dihapus');
    }
}