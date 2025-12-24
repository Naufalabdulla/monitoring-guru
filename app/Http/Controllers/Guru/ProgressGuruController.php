<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\{Guru, Mapel};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressGuruController extends Controller
{
    public function index($mapel_id)
    {
        $guru = Guru::findOrFail(Auth::id());

        // === UML METHOD ===
        $mapel = $guru->lihatMapel($mapel_id);
        $progressItems = $guru->lihatProgressMapel($mapel_id);

        return view('guru.progress.index', compact('mapel', 'progressItems'));
    }

    public function update(Request $request, $progress_id)
    {
        $guru = Guru::findOrFail(Auth::id());

        // === UML METHOD ===
        $guru->updateProgress($progress_id, [
            'status' => $request->has('status') ? 1 : 0,
            'materi' => $request->materi,
        ]);

        return back()->with('success', 'Progress berhasil diperbarui');
    }

    public function show($mapel_id)
    {
        $guru = Guru::findOrFail(Auth::id());

        $progress = $guru->lihatProgressMapel($mapel_id);

        return view('guru.progress.show', compact('progress'));
    }
}
