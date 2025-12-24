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
        $totalMapelUnique    = Mapel::distinct('nama')->count('nama');
        $totalMapelTerdaftar = Mapel::count();

        $query = Mapel::with(['kelas', 'guru']);

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('tingkat')) {
            $query->whereHas('kelas', fn($q) => $q->where('tingkat', $request->tingkat));
        }

        $mapels = $query->latest()->paginate(20);

        return view('admin.mapel.index', compact('mapels', 'totalMapelUnique', 'totalMapelTerdaftar'));
    }

    public function create()
    {
        $gurus = Guru::orderBy('nama')->get(); // ✅ pakai Guru konkrit
        $kelas = Kelas::orderBy('tingkat')->orderBy('nama')->get();

        return view('admin.mapel.create', compact('gurus', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'guru_id'  => 'required|exists:users,id', // kalau guru disimpan di users
        ]);

        $admin = Admin::findOrFail(Auth::id());

        $mapel = new Mapel([
            'nama'     => $request->nama,
            'kelas_id' => $request->kelas_id,
            'user_id'  => $request->user_id, // relasi guru biasanya user_id
        ]);

        $admin->kelolaMapel($mapel);

        return redirect()->route('admin.mapel.index')
            ->with('success', 'Mapel berhasil dibuat (tanpa User abstract)');
    }

    public function edit(Mapel $mapel)
    {
        $gurus = Guru::orderBy('nama')->get();
        $kelas = Kelas::orderBy('tingkat')->orderBy('nama')->get();

        return view('admin.mapel.edit', compact('mapel', 'gurus', 'kelas'));
    }

    // app/Http/Controllers/MapelController.php



public function update(Request $request, Mapel $mapel)
{
    $request->validate([
        'nama'     => 'required|string|max:255',
        'kelas_id' => 'required|exists:kelas,id',
        'guru_id'  => 'required|exists:users,id',
    ]);

    $admin = Admin::findOrFail(Auth::id());

    // PERBAIKAN: Gunakan guru_id agar data tersimpan
    $mapel->nama     = $request->nama;
    $mapel->kelas_id = $request->kelas_id;
    $mapel->user_id  = $request->guru_id; 

    $admin->kelolaMapel($mapel);

    return redirect()->route('admin.mapel.index')
        ->with('success', 'Mapel berhasil diupdate');
}

    public function destroy(Mapel $mapel)
    {
        $admin = Admin::findOrFail(Auth::id());
        $admin->hapusMapel($mapel);

        return back()->with('success', 'Mapel dihapus');
    }
}
