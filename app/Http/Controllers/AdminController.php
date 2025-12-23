<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Hash, Auth};


class AdminController extends Controller
{
    public function index(Request $request)
{
    // Gunakan Admin:: (class konkrit) alih-alih User:: (class abstract)
    $admin = Admin::find(Auth::id());
    
    // Perbaikan Baris 20: Ganti User:: menjadi Admin:: atau Guru::
    $totalGuru = Admin::where('role', 'guru')->count(); 
    $totalKelas = Kelas::count();
    $totalMapelUnique = Mapel::distinct('nama')->count('nama');
    $totalMapelTerdaftar = Mapel::count();

    $listGuru = $admin->daftar_guru; 
    $listKelas = Kelas::orderBy('tingkat')->get();

    $query = Mapel::with(['kelas', 'guru', 'progress']);
    
    // ... sisa kode filter tetap sama ...
    $mapels = $query->latest()->paginate(25);

    return view('admin.dashboard', compact(
        'totalGuru', 'totalKelas', 'mapels', 'listGuru', 
        'listKelas', 'totalMapelUnique', 'totalMapelTerdaftar'
    ));
}

 public function storeGuru(Request $request) {
        // Karena login menggunakan Proxy, kita ambil ID-nya dan cari sebagai Admin
        $admin = Admin::find(Auth::id());
        
        // JANGAN new User() karena itu abstract!
        // GUNAKAN new Guru() sesuai diagram
        $guru = new Guru([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);
        
        // Admin mengelola objek Guru (Inheritance)
        $admin->kelolaGuru($guru); 
        
        return back()->with('success', 'Guru berhasil ditambah (Sesuai OOP Abstract)');
    }

    public function storeMapel(Request $request) {
        $admin = Admin::find(Auth::id());
        $mapel = new Mapel([
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
            'user_id' => $request->guru_id,
        ]);
        
        $admin->kelolaMapel($mapel); 
        return back()->with('success', 'Mapel berhasil dibuat');
    }
}