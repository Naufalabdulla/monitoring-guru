<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\{Guru, ProgressPembelajaran, Materi, Mapel};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressGuruController extends Controller
{
    public function index($mapel_id)
    {
        $guru_id = Auth::id();
        $mapel = Mapel::with('kelas')->where('id', $mapel_id)->where('user_id', $guru_id)->firstOrFail();

        // UBAH DI SINI: Logika Solusi 2
        $progressItems = ProgressPembelajaran::where('mapel_id', $mapel_id)
            ->orderBy('pertemuan', 'asc') // Otomatis urut: 1, 2, 3... 10, 11
            ->get();

        $materis = Materi::where('mapel_id', $mapel_id)->get();

        return view('guru.progress.index', compact('mapel', 'progressItems', 'materis'));
    }
    public function update(Request $request, $id)
    {
        // 1. Cari data progress berdasarkan ID
        $progress = ProgressPembelajaran::findOrFail($id);

        // 2. Validasi input (Opsional tapi disarankan)
        $request->validate([
            'materi_id' => 'nullable|exists:materis,id',
            'status' => 'required|in:0,1',
        ]);

        /** * 3. Update data
         * Pastikan materi_id ikut disimpan ke database
         */
        $progress->update([
            'materi_id' => $request->materi_id, // Ini yang sering terlewat
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return back()->with('success', 'Progress pertemuan ' . $progress->pertemuan . ' berhasil diperbarui.');
    }
}