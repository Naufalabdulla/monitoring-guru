<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// Import Model yang sudah kita buat
use App\Models\Admin;
use App\Models\Guru;

class AdminGuruController extends Controller
{
    public function index(Request $request)
    {
        $totalGuru = Guru::where('role', 'guru')->count();
        $query = Guru::where('role', 'guru');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $gurus = $query->latest()->paginate(20);
        return view('admin.guru.index', compact('gurus', 'totalGuru'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = Admin::find(Auth::id());
        $guru = new Guru([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        // + kelolaGuru(g: Guru): Boolean
        $admin->kelolaGuru($guru);

        return redirect()->route('admin.guru.index')->with('success', 'Akun Guru berhasil dibuat.');
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        $admin = Admin::find(Auth::id());

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password_lama' => 'required',
            'password' => 'nullable|min:6|confirmed',
        ]);

        if (!Hash::check($request->password_lama, $guru->password)) {
            return back()->withErrors(['password_lama' => 'Password lama salah.'])->withInput();
        }

        $guru->nama = $request->nama;
        $guru->email = $request->email;
        if ($request->filled('password')) {
            $guru->password = Hash::make($request->password);
        }

        // Update didelegasikan ke Admin
        $admin->kelolaGuru($guru);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = Admin::find(Auth::id());
        $guru = Guru::findOrFail($id);

        // Pastikan model Admin memiliki hapusGuru sebagai helper delegasi
        $admin->hapusGuru($guru);

        return back()->with('success', 'Guru berhasil dihapus');
    }
}