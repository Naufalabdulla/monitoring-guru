<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mapel;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{


    public function index() {
        $totalGuru = User::where('role', 'guru')->count();
        $totalMapel = Mapel::count();
        $mapels = Mapel::with('guru')->get(); // Mengambil mapel beserta gurunya
        return view('admin.dashboard', compact('totalGuru', 'totalMapel', 'mapels'));
    }
    public function storeGuru(Request $request) {
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);
        return back()->with('success', 'Guru berhasil ditambah');
    }

    public function storeMapel(Request $request) {
        Mapel::create([
            'nama' => $request->nama,
            'tingkat_kelas' => $request->tingkat,
            'user_id' => $request->guru_id, // Ambil ID Guru dari dropdown
        ]);
        return back()->with('success', 'Mapel berhasil dibuat');
    }
}
