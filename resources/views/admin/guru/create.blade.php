@extends('layouts.master')
@section('content')
<div class="card shadow-sm border-0 col-md-6 mx-auto">
    <div class="card-body p-4">
        <h4 class="fw-bold mb-4">Tambah Guru Baru</h4>
        <form action="{{ route('admin.guru.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan Akun Guru</button>
        </form>
    </div>
</div>
@endsection