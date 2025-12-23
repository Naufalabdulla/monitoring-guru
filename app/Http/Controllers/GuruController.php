<?php

namespace App\Http\Controllers;
use App\Models\{Mapel, Materi};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Jadwal;
use Illuminate\Support\Facades\App;

class GuruController extends Controller {
    // Lihat Mapel yang ditugaskan ke saya
  public function index()
    {
        // Paksa locale ke Indonesia agar hari terbaca 'Selasa'
        App::setLocale('id'); 
        
        $user = Auth::user();
        $hariIni = Carbon::now()->translatedFormat('l'); // Hasilnya sekarang pasti 'Selasa'

        $myMapels = Mapel::where('user_id', $user->id)->with(['progress', 'kelas'])->get();
        $mapelIds = $myMapels->pluck('id');

        // Mengambil jadwal hari ini untuk notifikasi
        $jadwalHariIni = Jadwal::whereIn('mapel_id', $mapelIds)
            ->where('hari', $hariIni)
            ->with(['mapel', 'kelas'])
            ->get();

        // Mengambil jadwal mingguan
        $jadwalMingguan = Jadwal::whereIn('mapel_id', $mapelIds)
            ->with(['mapel', 'kelas'])
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy('hari');

        // Statistik
        $totalMapel = $myMapels->count();
        $totalKelas = $myMapels->pluck('kelas_id')->unique()->count();
        $totalMateri = \App\Models\Materi::whereIn('mapel_id', $mapelIds)->count();

        return view('guru.dashboard', compact(
            'myMapels', 'totalMapel', 'totalKelas', 'totalMateri', 
            'jadwalHariIni', 'jadwalMingguan', 'hariIni'
        ));
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