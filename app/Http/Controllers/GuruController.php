<?php

namespace App\Http\Controllers;

use App\Models\{Guru, Jadwal, Materi, Kelas, Mapel};
use Illuminate\Support\Facades\{Auth, App};
use Carbon\Carbon;


class GuruController extends Controller
{
    public function index()
{
    $guruId = Auth::id();
    $hariIni = \Carbon\Carbon::now()->translatedFormat('l');

    // 1. Data Mapel & Progress
    $myMapels = Mapel::where('user_id', $guruId)->with(['kelas', 'progress'])->get();

    // 2. Statistik
    $totalMapel = $myMapels->count();
    $totalKelas = Kelas::whereHas('mapels', fn($q) => $q->where('user_id', $guruId))->count();
    $totalMateri = Materi::whereHas('mapel', fn($q) => $q->where('user_id', $guruId))->count();

    // 3. Jadwal Mingguan
    $jadwalRaw = Jadwal::where('guru_id', $guruId)->with(['mapel', 'kelas'])->get();
    $jadwalMingguan = $jadwalRaw->groupBy('hari');
    $jadwalHariIni = $jadwalRaw->where('hari', $hariIni);

    return view('guru.dashboard', compact(
        'myMapels', 'totalMapel', 'totalKelas', 'totalMateri', 
        'jadwalMingguan', 'jadwalHariIni', 'hariIni'
    ));
}
}