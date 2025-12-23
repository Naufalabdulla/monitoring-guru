<?php

namespace App\Http\Controllers;

use App\Models\{Guru, Mapel, Materi, Jadwal};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, App};
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class GuruController extends Controller {
    
    public function index()
    {
        App::setLocale('id'); 
        $guru = Guru::find(Auth::id()); // Cast ke model Guru
        $hariIni = Carbon::now()->translatedFormat('l');

        // Menggunakan metode dari Class Diagram
        $myMapels = $guru->lihatDaftarMapel(); 
        $mapelIds = $myMapels->pluck('id');

        $jadwalHariIni = Jadwal::getJadwalHariIni($guru->id, $hariIni); // Metode statis sesuai diagram

        $jadwalMingguan = Jadwal::whereIn('mapel_id', $mapelIds)
            ->with(['mapel', 'kelas'])
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
            ->get()
            ->groupBy('hari');

        $totalMapel = $myMapels->count();
        $totalKelas = $myMapels->pluck('kelas_id')->unique()->count();
        $totalMateri = Materi::whereIn('mapel_id', $mapelIds)->count();

        return view('guru.dashboard', compact(
            'myMapels', 'totalMapel', 'totalKelas', 'totalMateri', 
            'jadwalHariIni', 'jadwalMingguan', 'hariIni'
        ));
    }
}