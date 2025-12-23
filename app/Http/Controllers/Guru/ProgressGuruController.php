<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\{Mapel, ProgressPembelajaran, Guru};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressGuruController extends Controller
{
    public function index($mapel_id)
    {
        $mapel = Mapel::getMapelById($mapel_id); // Metode statis dari diagram
        
        $progressItems = ProgressPembelajaran::where('mapel_id', $mapel_id)
            ->orderBy('id', 'asc')->get();

        if ($progressItems->isEmpty()) {
            // Logika generate otomatis tetap dipertahankan
            $list = array_merge(array_map(fn($i) => "Minggu $i", range(1, 16)), ['UTS', 'UAS', 'Ujian Akhir']);
            foreach ($list as $p) {
                ProgressPembelajaran::create(['mapel_id' => $mapel_id, 'pertemuan' => $p, 'status' => 0]);
            }
            $progressItems = ProgressPembelajaran::where('mapel_id', $mapel_id)->get();
        }

        return view('guru.progress.index', compact('mapel', 'progressItems'));
    }

    public function update(Request $request, $id) 
    {
        $guru = Guru::find(Auth::id());
        
        // Menggunakan metode updateProgress dari GuruInterface
        $guru->updateProgress($id, [
            'status' => $request->has('status') ? 1 : 0,
            'materi' => $request->materi,
        ]);

        return back()->with('success', 'Progress berhasil diperbarui melalui Guru Interface!');
    }
     public function show($mapel_id) {
    // Menampilkan 19 baris progress untuk mapel ini
    $progress = ProgressPembelajaran::where('mapel_id', $mapel_id)->get();
    return view('guru.progress.show', compact('progress'));
}

    
}
  