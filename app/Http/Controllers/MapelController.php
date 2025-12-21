<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index() {
        $mapels = Mapel::with('guru')->get();
        return view('admin.mapel.index', compact('mapels'));
    }

    public function create() {
        $gurus = User::where('role', 'guru')->get();
        return view('admin.mapel.create', compact('gurus'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'tingkat_kelas' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        Mapel::create([
            'nama' => $request->nama,
            'tingkat_kelas' => $request->tingkat_kelas,
            'user_id' => $request->user_id
        ]);
        
        return redirect()->route('admin.dashboard')->with('success', 'Mapel berhasil ditambah');
    }

    public function edit(Mapel $mapel)
    {
        // Butuh daftar guru untuk dropdown saat edit
        $gurus = User::where('role', 'guru')->get();
        return view('admin.mapel.edit', compact('mapel', 'gurus'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'nama' => 'required',
            'tingkat_kelas' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        $mapel->update($request->all());
        
        return redirect()->route('admin.dashboard')->with('success', 'Mapel berhasil diupdate');
    }

    public function destroy($id) {
        Mapel::destroy($id);
        return back()->with('success', 'Mapel dihapus');
    }
}