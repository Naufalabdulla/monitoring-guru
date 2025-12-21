<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index() {
        $kelas = Kelas::all();
        return view('admin.kelas.index', compact('kelas'));
    }

    public function create() {
        return view('admin.kelas.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|unique:kelas,nama',
            'tingkat' => 'required'
        ]);

        Kelas::create($request->all());
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambah');
    }

    public function edit(Kelas $kela) { // Laravel otomatis menjadikannya $kela (singular)
        return view('admin.kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela) {
        $request->validate([
            'nama' => 'required|unique:kelas,nama,' . $kela->id,
            'tingkat' => 'required'
        ]);

        $kela->update($request->all());
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diupdate');
    }

    public function destroy(Kelas $kela) {
        $kela->delete();
        return back()->with('success', 'Kelas berhasil dihapus');
    }
}