<?php

namespace App\Http\Controllers;

use App\Models\{Guru, Jadwal, Materi};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class GuruController extends Controller
{
    public function index()
    {
        App::setLocale('id');

        // Ambil Guru KONKRIT
        $guru = Guru::findOrFail(Auth::id());

        $hariIni = Carbon::now()->translatedFormat('l');

        // === UML METHOD ===
        $myMapels = $guru->lihatDaftarMapel();
        $jadwalHariIni = $guru->lihatJadwalHariIni($hariIni);
        $jadwalMingguan = $guru->lihatJadwalMingguan();

        $mapelIds = $myMapels->pluck('id');

        $totalMapel  = $myMapels->count();
        $totalKelas  = $myMapels->pluck('kelas_id')->unique()->count();
        $totalMateri = Materi::whereIn('mapel_id', $mapelIds)->count();

        return view('guru.dashboard', compact(
            'myMapels',
            'jadwalHariIni',
            'jadwalMingguan',
            'totalMapel',
            'totalKelas',
            'totalMateri',
            'hariIni'
        ));
    }
}
