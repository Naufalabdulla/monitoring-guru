<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with(['kelas', 'mapel', 'guru']);

        if ($request->filled('hari')) {
            $query->where('hari', $request->hari);
        }
        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }
        if ($request->filled('guru_id')) {
            $query->where('guru_id', $request->guru_id);
        }

        $jadwals = $query->orderBy('hari')
            ->orderBy('jam_mulai')
            ->paginate(10);

        $kelasList = Kelas::orderBy('tingkat')->orderBy('nama')->get();
        $guruList  = Guru::orderBy('nama')->get(); // ✅ pakai Guru konkrit

        return view('jadwal.index', compact('jadwals', 'kelasList', 'guruList'));
    }

    public function create()
    {
        $jadwals   = Jadwal::with(['kelas', 'mapel', 'guru'])->latest()->get();
        $kelasList = Kelas::orderBy('tingkat')->orderBy('nama')->get();
        $mapelList = Mapel::orderBy('nama')->get()->unique('nama');
        $guruList  = Guru::orderBy('nama')->get(); // ✅ pakai Guru konkrit

        return view('jadwal.create', compact('jadwals', 'kelasList', 'mapelList', 'guruList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id'    => 'required|exists:kelas,id',
            'mapel_id'    => 'required|exists:mapels,id',
            'guru_id'     => 'required|exists:users,id', // kalau guru ada di tabel users
            'hari'        => 'required|string',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $admin = Admin::findOrFail(Auth::id());

        $jadwal = new Jadwal([
            'kelas_id'    => $request->kelas_id,
            'mapel_id'    => $request->mapel_id,
            'guru_id'     => $request->guru_id,
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        // ✅ sesuai style kamu: Admin yang “kelola”
        $admin->kelolaJadwal($jadwal);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan (tanpa User abstract)');
    }
}
