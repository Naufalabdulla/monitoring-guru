<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Kelas;

class MapelController extends Controller
{
   public function index(Request $request)
{
    // Kita gunakan selectRaw untuk mengambil ID (agar tombol aksi tidak error) 
    // dan mengambil created_at maksimal di tiap grup
    $query = Mapel::with(['kelas', 'guru'])
        ->selectRaw('MAX(id) as id, nama, kelas_id, MAX(created_at) as latest_created')
        ->groupBy('nama', 'kelas_id');

    if ($request->filled('tingkat')) {
        $query->whereHas('kelas', fn($q) => $q->where('tingkat', $request->tingkat));
    }

    // Urutkan berdasarkan kolom hasil agregasi atau kolom yang ada di GROUP BY
    switch ($request->sort) {
        case 'az': $query->orderBy('nama', 'asc'); break;
        case 'za': $query->orderBy('nama', 'desc'); break;
        default: $query->orderBy('latest_created', 'desc'); break; // Pengganti latest()
    }

    $mapels = $query->paginate(20);
    return view('admin.mapel.index', compact('mapels'));
}

    public function store(Request $request)
    {
        // Validasi PBO: Mencegah duplikasi Mapel yang sama di Kelas yang sama
        $request->validate([
            'nama' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
            'guru_id' => 'required|exists:users,id',
        ]);

        // Cek apakah Mapel dengan nama dan kelas tersebut sudah ada
        $exists = Mapel::where('nama', $request->nama)
            ->where('kelas_id', $request->kelas_id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['nama' => 'Mata pelajaran ini sudah terdaftar di kelas tersebut!']);
        }

        $admin = Admin::findOrFail(Auth::id());
        $mapel = new Mapel($request->all());
        $admin->kelolaMapel($mapel);

        return redirect()->route('admin.mapel.index')->with('success', 'Mapel berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        // + getMapelById(id: String): Mapel
        $mapel = Mapel::getMapelById($id);
        $admin = Admin::findOrFail(Auth::id());

        $mapel->nama = $request->nama;
        $mapel->kelas_id = $request->kelas_id;
        $mapel->user_id = $request->guru_id;

        // + updateMapel(m: Mapel): void
        $mapel->updateMapel($mapel);

        return redirect()->route('admin.mapel.index')->with('success', 'Mapel diperbarui');
    }

    public function destroy($id)
    {
        // + deleteMapel(id: String): void
        Mapel::deleteMapel($id);

        return back()->with('success', 'Mapel dihapus (Komposisi: Materi otomatis hilang)');
    }
    public function edit(Mapel $mapel)
    {
        $gurus = Guru::orderBy('nama')->get();
        $kelas = Kelas::orderBy('tingkat')->orderBy('nama')->get();

        return view('admin.mapel.edit', compact('mapel', 'gurus', 'kelas'));
    }

}
