<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\User;
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
    public function create()
    {
        return view('jadwal.create', [
            'kelasList' => Kelas::orderBy('nama')->get(),
            'mapelList' => Mapel::orderBy('nama')->get(),
            // 'guruList'  => User::orderBy('nama')->get(),
        ]);
    }

    /**
     * Menyimpan jadwal ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id'    => '',
            'mapel_id'    => '',
            'guru_id'     => '',
            'hari'        => 'required|string',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        Jadwal::create($validated);

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan');
    }
}
