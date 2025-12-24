<?php

namespace App\Http\Controllers;

use App\Models\{Materi, Mapel, Admin, Guru};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
public function index(Request $request)
{
    $guruId = Auth::id();

    // Query Materi dengan Eager Loading relasi Mapel dan Kelas
    $query = Materi::with(['mapel.kelas'])
        ->whereHas('mapel', function($q) use ($guruId) {
            $q->where('user_id', $guruId);
        });

    // Logika Filter Pencarian
    if ($request->filled('search')) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    // Logika Filter Mata Pelajaran
    if ($request->filled('mapel_id')) {
        $query->where('mapel_id', $request->mapel_id);
    }

    $materis = $query->latest()->get();

    // Ambil daftar Mapel - Kelas untuk dropdown filter
    $mapels = Mapel::where('user_id', $guruId)->with('kelas')->get();

    return view('guru.materi.index', compact('materis', 'mapels'));
}

    public function create(Request $request)
    {
        $mapel_id = $request->query('mapel_id');

        if ($mapel_id) {
            $mapel = Mapel::findOrFail($mapel_id);
            return view('guru.materi.create', compact('mapel'));
        } else {
            // PERBAIKAN: Ambil semua Mapel milik guru dan sertakan data Kelas
            // Kita hapus .unique('nama') agar semua kelas muncul
            $mapels = Mapel::where('user_id', Auth::id())
                ->with('kelas')
                ->orderBy('nama')
                ->get();

            return view('guru.materi.create', compact('mapels'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'mapel_id' => 'required|exists:mapels,id',
            'deskripsi' => 'nullable|string',
            'file_pendukung' => 'nullable|string',
        ]);

        $guru = Guru::findOrFail(Auth::id());

        $materi = new Materi([
            'nama' => $request->nama,
            'mapel_id' => $request->mapel_id,
            'deskripsi' => $request->deskripsi,
            'file_pendukung' => $request->file_pendukung,
        ]);

        // Tetap menggunakan metode UML Anda
        $guru->buatMateri($materi);

        return redirect()->route('guru.materi.index')
            ->with('success', 'Materi berhasil dibuat');
    }

    public function edit($id)
    {
        $materi = Materi::getMateriById($id);

        // Ambil daftar Mapel - Kelas untuk pilihan saat edit
        $mapels = Mapel::where('user_id', Auth::id())->with('kelas')->get();

        return view('guru.materi.edit', compact('materi', 'mapels'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'mapel_id' => 'required|exists:mapels,id',
            'deskripsi' => 'nullable|string',
            'file_pendukung' => 'nullable|string',
        ]);

        $guru = Guru::findOrFail(Auth::id());

        // Update via metode UML
        $guru->updateMateri($materi, $request->only('nama', 'mapel_id', 'deskripsi', 'file_pendukung'));

        return redirect()->route('guru.materi.index')
            ->with('success', 'Materi berhasil diupdate');
    }

    public function destroy(Materi $materi)
    {
        $guru = Guru::findOrFail(Auth::id());
        $guru->hapusMateri($materi);

        return back()->with('success', 'Materi berhasil dihapus');
    }
}