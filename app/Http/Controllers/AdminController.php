<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mapel;
<<<<<<< HEAD
=======
use App\Models\Kelas;
>>>>>>> origin/main
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{


    public function index() {
<<<<<<< HEAD
        $totalGuru = User::where('role', 'guru')->count();
        $totalMapel = Mapel::count();
        $mapels = Mapel::with('guru')->get(); // Mengambil mapel beserta gurunya
        return view('admin.dashboard', compact('totalGuru', 'totalMapel', 'mapels'));
    }
=======
    $totalGuru = User::where('role', 'guru')->count();
    $totalMapel = Mapel::count();
    $totalKelas = Kelas::count();
    $mapels = Mapel::with('guru', 'kelas')->get(); 

    // Perbaikan: Tambahkan 'totalKelas' ke dalam compact
    return view('admin.dashboard', compact('totalGuru', 'totalMapel', 'totalKelas', 'mapels'));
}


>>>>>>> origin/main
    public function storeGuru(Request $request) {
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);
        return back()->with('success', 'Guru berhasil ditambah');
    }

<<<<<<< HEAD
    public function storeMapel(Request $request) {
        Mapel::create([
            'nama' => $request->nama,
            'tingkat_kelas' => $request->tingkat,
            'user_id' => $request->guru_id, // Ambil ID Guru dari dropdown
        ]);
        return back()->with('success', 'Mapel berhasil dibuat');
    }
=======
 public function storeMapel(Request $request) {
    // Perbaikan: Sesuaikan dengan kolom baru 'kelas_id'
    Mapel::create([
        'nama' => $request->nama,
        'kelas_id' => $request->kelas_id, // Gunakan kelas_id hasil dropdown
        'user_id' => $request->guru_id,
    ]);
    return back()->with('success', 'Mapel berhasil dibuat');
}
>>>>>>> origin/main
}
