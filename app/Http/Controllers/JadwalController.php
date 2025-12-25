<?php

namespace App\Http\Controllers;

use App\Models\{Jadwal, Kelas, Mapel, Guru, Admin};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with(['kelas', 'mapel', 'guru']);

        // Filter
        if ($request->filled('hari')) {
            $query->where('hari', $request->hari);
        }
        if ($request->filled('guru_id')) {
            $query->where('guru_id', $request->guru_id);
        }

        // Urutan (Sorting)
        switch ($request->sort) {
            case 'hari':
                $query->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')");
                break;
            case 'mapel':
                $query->whereHas('mapel', fn($q) => $q->orderBy('nama', 'asc'));
                break;
            default:
                $query->latest();
                break;
        }

        $jadwals = $query->paginate(20);
        $kelasList = Kelas::all();
        $mapelList = Mapel::all();
        $guruList = Guru::all();

        return view('admin.jadwal.index', compact('jadwals', 'kelasList', 'mapelList', 'guruList'));
    }

    public function create()
{
    $kelasList = Kelas::orderBy('tingkat')->get();
    $guruList = Guru::orderBy('nama')->get();

    /**
     * UNIK: Mengambil daftar Mapel unik berdasarkan nama 
     * agar dropdown tidak penuh dengan nama yang sama
     */
    $mapelList = Mapel::select('id', 'nama', 'kelas_id')
        ->with('kelas')
        ->get()
        ->unique('nama');

    return view('admin.jadwal.create', compact('kelasList', 'mapelList', 'guruList'));
}

    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'guru_id' => 'required|exists:users,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        // 2. Cari Admin yang sedang login (Actor utama dalam diagram)
        $admin = Admin::findOrFail(Auth::id());

        // 3. Inisialisasi objek Jadwal (Encapsulation)
        $jadwal = new Jadwal($validated);

        /**
         * 4. KONSEP DELEGASI PBO:
         * Admin memanggil metode kelolaJadwal() untuk menyimpan objek.
         * Sesuai diagram: + kelolaJadwal(j: Jadwal): Boolean
         */
        $admin->kelolaJadwal($jadwal);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dibuat via Admin.');
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::getJadwalById($id);
        $admin = Admin::findOrFail(Auth::id());
        $jadwal->fill($request->all());
        $admin->kelolaJadwal($jadwal); // Update via Admin

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal diperbarui.');
    }

    public function destroy($id)
    {
        // 1. Cari objek Jadwal yang akan dihapus
        $jadwal = Jadwal::findOrFail($id);

        // 2. Cari aktor Admin yang melakukan aksi
        $admin = Admin::findOrFail(Auth::id());

        /**
         * 3. DELEGASI PBO:
         * Admin memanggil metode hapusJadwal untuk menghapus objek.
         */
        $admin->hapusJadwal($jadwal);

        return back()->with('success', 'Jadwal berhasil dihapus dari sistem.');
    }
}