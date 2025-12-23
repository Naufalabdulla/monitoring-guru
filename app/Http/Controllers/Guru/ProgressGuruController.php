<?php

namespace App\Http\Controllers\Guru; // Pastikan namespace menggunakan \Guru

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\ProgressPembelajaran;
use Illuminate\Http\Request;

class ProgressGuruController extends Controller
{
    // Menampilkan daftar 19 indikator untuk satu Mapel
   public function index($mapel_id)
{
    $mapel = Mapel::with('kelas')->findOrFail($mapel_id);
    
    // Cek apakah data progress sudah ada
    $progressItems = ProgressPembelajaran::where('mapel_id', $mapel_id)
        ->orderBy('id', 'asc')
        ->get();

    // JIKA KOSONG, MAKA GENERATE OTOMATIS 19 BARIS
    if ($progressItems->isEmpty()) {
        $list = [];
        for ($i = 1; $i <= 16; $i++) { $list[] = "Minggu $i"; }
        $list = array_merge($list, ['UTS', 'UAS', 'Ujian Akhir']);

        foreach ($list as $p) {
            ProgressPembelajaran::create([
                'mapel_id' => $mapel_id,
                'pertemuan' => $p,
                'status' => 0
            ]);
        }
        
        // Ambil ulang data setelah di-generate
        $progressItems = ProgressPembelajaran::where('mapel_id', $mapel_id)->get();
    }

    return view('guru.progress.index', compact('mapel', 'progressItems'));
}

    // Mengupdate status dan materi tiap pertemuan
  public function update(Request $request, $id) 
{
    $item = ProgressPembelajaran::findOrFail($id);
    
    // Update data berdasarkan input guru
    $item->update([
        'status' => $request->has('status') ? 1 : 0,
        'materi' => $request->materi,
    ]);

    return back()->with('success', 'Progress ' . $item->pertemuan . ' berhasil diperbarui!');
}
   public function show($mapel_id) {
    // Menampilkan 19 baris progress untuk mapel ini
    $progress = ProgressPembelajaran::where('mapel_id', $mapel_id)->get();
    return view('guru.progress.show', compact('progress'));
}

    
}