<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Kelas;
use App\Http\Controllers\Controller;


class KelasController extends Controller
{
    public function index(Request $request)
    {
        $totalKelas = Kelas::count();

        $query = Kelas::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }

        $kelas = $query->orderBy('tingkat')->orderBy('nama')->paginate(20);

        return view('admin.kelas.index', compact('kelas', 'totalKelas'));
    }

    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|unique:kelas,nama',
            'tingkat' => 'required'
        ]);

        $admin = Admin::findOrFail(Auth::id());

        $kelas = new Kelas([
            'nama' => $request->nama,
            'tingkat' => $request->tingkat,
        ]);

        $admin->kelolaKelas($kelas);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil ditambah (via Admin UML)');
    }

    public function edit(Kelas $kela)
    {
        return view('admin.kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama'    => 'required|unique:kelas,nama,' . $kela->id,
            'tingkat' => 'required'
        ]);

        $admin = Admin::findOrFail(Auth::id());

        // isi object kelas dengan data baru (agar Admin bisa kelola)
        $kela->nama = $request->nama;
        $kela->tingkat = $request->tingkat;

        $admin->kelolaKelas($kela);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil diupdate (via Admin UML)');
    }

    public function destroy(Kelas $kela)
    {
        $admin = Admin::findOrFail(Auth::id());

        $admin->hapusKelas($kela);

        return back()->with('success', 'Kelas berhasil dihapus (via Admin UML)');
    }
}
