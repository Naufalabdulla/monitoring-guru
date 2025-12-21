<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;

class MapelGuruController extends Controller
{
    public function index()
    {
        $guruId = Auth::id();

        $jadwals = Jadwal::with('mapel')
            ->where('guru_id', $guruId)
            ->get();

        // mapel unik yang benar-benar dia ajar (berdasarkan jadwal)
        $mapels = $jadwals->pluck('mapel')->filter()->unique('id')->values();

        return view('guru.mapel.index', compact('mapels'));
    }
}
