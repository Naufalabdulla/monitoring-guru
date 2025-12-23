<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\ProgressPembelajaran;

class ProgressGuruController extends Controller{
    public function show($mapel_id) {
    // Menampilkan 19 baris progress untuk mapel ini
    $progress = ProgressPembelajaran::where('mapel_id', $mapel_id)->get();
    return view('guru.progress.show', compact('progress'));
}

public function update(Request $request, $id) {
    $item = ProgressPembelajaran::findOrFail($id);
    $item->update([
        'status' => $request->has('status') ? 1 : 0,
        'materi' => $request->materi, // Bisa diisi materi atau dikosongkan dulu
    ]);
    return back()->with('success', 'Progress diperbarui!');
}
}