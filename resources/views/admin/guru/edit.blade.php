@extends('layouts.master')
@section('content')
<div class="card shadow-sm border-0 col-md-6 mx-auto p-4">
    <h4 class="fw-bold mb-4 text-primary">Edit Profil Guru</h4>
    <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Lengkap Guru</label>
            <input type="text" name="nama" class="form-control" value="{{ $guru->nama }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat Email</label>
            <input type="email" name="email" class="form-control" value="{{ $guru->email }}" required>
        </div>
        <div class="p-3 bg-light rounded border mb-4">
            <label class="form-label fw-bold">Ganti Password</label>
            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
            <small class="text-muted">Minimal 8 karakter jika ingin diganti.</small>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Simpan Perubahan Akun</button>
            <a href="{{ route('admin.guru.index') }}" class="btn btn-light">Batal</a>
        </div>
    </form>
</div>
@endsection