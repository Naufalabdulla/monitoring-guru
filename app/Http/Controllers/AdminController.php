<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Admin, Guru, Mapel, Kelas};
use Illuminate\Support\Facades\{Hash, Auth};
use App\Models\ProgressPembelajaran;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admin = Admin::find(Auth::id());
        
        if (!$admin) { return redirect()->route('login'); }

        $totalGuru = Guru::where('role', 'guru')->count(); 
        $totalKelas = Kelas::count();
        $totalMapelUnique = Mapel::distinct('nama')->count('nama');
        $totalMapelTerdaftar = Mapel::count();

        // Mengambil daftar guru menggunakan model konkrit
        $listGuru = Guru::where('role', 'guru')->orderBy('nama')->get(); 
        $listKelas = Kelas::orderBy('tingkat')->get();

        $query = Mapel::with(['kelas', 'guru', 'progress']);
        
        if ($request->filled('guru_id')) { $query->where('user_id', $request->guru_id); }
        if ($request->filled('kelas_id')) { $query->where('kelas_id', $request->kelas_id); }

        $mapels = $query->latest()->paginate(25);

        return view('admin.dashboard', compact(
            'totalGuru', 'totalKelas', 'mapels', 'listGuru', 
            'listKelas', 'totalMapelUnique', 'totalMapelTerdaftar'
        ));
    }

    public function storeGuru(Request $request) {
        $admin = Admin::find(Auth::id());
        
        $guru = new Guru([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);
        
        // DELEGASI: Admin mengelola objek Guru
        $admin->kelolaGuru($guru); 
        
        return back()->with('success', 'Guru berhasil ditambah');
    }

    public function storeMapel(Request $request) {
        $admin = Admin::find(Auth::id());
        $mapel = new Mapel([
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
            'user_id' => $request->guru_id,
        ]);
        
        // DELEGASI: Admin mengelola objek Mapel
        $admin->kelolaMapel($mapel); 
        return back()->with('success', 'Mapel berhasil dibuat');
    }
    public function showProgress($mapel_id)
{
    // Gunakan with() untuk memuat relasi kelas dan guru sekaligus
    $mapel = Mapel::with(['kelas', 'guru'])->findOrFail($mapel_id);

    $progressItems = ProgressPembelajaran::where('mapel_id', $mapel_id)
        ->with('materi')
        ->orderBy('pertemuan')
        ->get();

    return view('admin.progress.show', compact('mapel', 'progressItems'));
}
}