<?php
namespace App\Http\Controllers;

use App\Models\AuthenticatableUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminGuruController extends Controller
{
    public function index(Request $request)
{
    // Ganti User::where menjadi Admin::where (merujuk tabel yang sama)
    $totalGuru = Admin::where('role', 'guru')->count();
    $query = Admin::where('role', 'guru');

    if ($request->filled('search')) {
        $query->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
    }

    $gurus = $query->latest()->paginate(20);
    return view('admin.guru.index', compact('gurus', 'totalGuru'));
}

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Membuat akun baru dengan role guru
        AuthenticatableUser::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'guru',
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Akun Guru berhasil dibuat.');
    }
    public function edit($id)
    {
        // Mengambil data guru berdasarkan ID
        $guru = AuthenticatableUser::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
{
    $guru = AuthenticatableUser::findOrFail($id);
    
    // Validasi data
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password_lama' => 'required', // Wajib diisi untuk verifikasi
        'password' => 'nullable|min:6|confirmed', // Password baru bersifat opsional
    ]);

    // 1. Verifikasi apakah password lama benar
    if (!\Illuminate\Support\Facades\Hash::check($request->password_lama, $guru->password)) {
        return back()->withErrors(['password_lama' => 'Password lama yang Anda masukkan salah.'])->withInput();
    }

    // 2. Update Nama dan Email
    $guru->nama = $request->nama;
    $guru->email = $request->email;

    // 3. Update Password Baru jika diisi
    if ($request->filled('password')) {
        $guru->password = \Illuminate\Support\Facades\Hash::make($request->password);
    }

    $guru->save();

    return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
}
    public function destroy($id)
    {
       AuthenticatableUser::findOrFail($id)->delete();
        return back()->with('success', 'Guru berhasil dihapus');
    }
}