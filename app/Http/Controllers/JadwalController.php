<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;

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
        // 1. Ambil semua data jadwal untuk ditampilkan di tabel bawah form
        $jadwals = Jadwal::with(['kelas', 'mapel', 'guru'])->orderBy('created_at', 'desc')->get();

        // 2. Ambil data untuk dropdown/pilihan di form
        $kelasList = Kelas::orderBy('nama')->get();
        $mapelList = Mapel::orderBy('nama')->get();
        $guruList = AuthenticatableUser::where('role', 'guru')->orderBy('nama')->get(); // Sesuaikan query guru Anda

        return view('jadwal.create', compact('jadwals', 'kelasList', 'mapelList', 'guruList'));
    }

    /**
     * Menyimpan jadwal ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => '',
            'mapel_id' => '',
            'guru_id' => '',
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        Jadwal::create($validated);

        return redirect()
            ->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan');
    }
}