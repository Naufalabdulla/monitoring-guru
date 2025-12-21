<?php

namespace App\Http\Controllers;
use App\Models\{Mapel, Materi};
use Illuminate\Http\Request;

class GuruController extends Controller {
    // Lihat Mapel yang ditugaskan ke saya
   public function index() {
        // Kita asumsikan Guru yang buka adalah ID 2 (sesuai seeder)
        $myMapels = Mapel::where('user_id', 2)->with('materis')->get();
        return view('guru.dashboard', compact('myMapels'));
    }

    // Tambah Materi ke Mapel saya
    public function storeMateri(Request $request) {
        Materi::create([
            'nama' => $request->nama_materi,
            'mapel_id' => $request->mapel_id,
        ]);
        return back()->with('success', 'Materi berhasil ditambah');
    }
}