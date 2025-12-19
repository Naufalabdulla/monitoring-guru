<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Menampilkan daftar jadwal
     */
    public function index(Request $request)
    {
        $jadwals = Jadwal::with(['kelas', 'mapel', 'guru'])
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->paginate(10);

        return view('jadwal.index', compact('jadwals'));
    }

    /**
     * Menampilkan form tambah jadwal
     */
    // public function create()
    // {
    //     return view('jadwal.create', [
    //         'kelasList' => Kelas::orderBy('namaKelas')->get(),
    //         'mapelList' => Mapel::orderBy('namaMapel')->get(),
    //         'guruList'  => Guru::orderBy('nama')->get(),
    //     ]);
    // }

    /**
     * Menyimpan jadwal ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id'    => 'required|exists:kelas,id',
            'mapel_id'    => 'required|exists:mapels,id',
            'guru_id'     => 'required|exists:gurus,id',
            'hari'        => 'required|string',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        Jadwal::create($validated);

        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan');
    }
}
