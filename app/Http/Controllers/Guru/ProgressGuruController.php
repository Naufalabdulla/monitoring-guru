<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressGuruController extends Controller
{
    // Lihat progress
    public function index()
    {
        $guruId = Auth::id();

        $progresses = Progress::with(['jadwal.mapel', 'jadwal.kelas'])
            ->whereHas('jadwal', function ($q) use ($guruId) {
                $q->where('guru_id', $guruId);
            })
            ->orderByDesc('tanggal')
            ->get();

        return view('guru.progress.index', [
            'progresses' => $progresses
        ]);
    }

    // Form update
    public function edit(Progress $progress)
    {
        // security: pastikan progress milik guru login
        if ($progress->jadwal->guru_id !== Auth::id()) {
            abort(403);
        }

        return view('guru.progress.edit', [
            'progress' => $progress
        ]);
    }

    // Update progress
    public function update(Request $request, Progress $progress)
    {
        if ($progress->jadwal->guru_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'tanggal' => 'required|date',
            'materi' => 'required',
            'status' => 'required|in:belum,proses,selesai',
            'catatan' => 'nullable',
        ]);

        $progress->update($request->all());

        return redirect()
            ->route('guru.progress.index')
            ->with('success', 'Progress berhasil diupdate');
    }
}
