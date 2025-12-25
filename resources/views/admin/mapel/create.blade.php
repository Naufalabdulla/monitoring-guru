@extends('layouts.master')
@section('content')
<div class="card shadow-sm border-0 col-md-6 mx-auto p-4">
    <h4 class="fw-bold mb-4">Tambah Mata Pelajaran</h4>
    <form action="{{ route('admin.mapel.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Mata Pelajaran</label>
            <input type="text" name="nama" class="form-control" placeholder="Contoh: Matematika Wajib" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tentukan Tingkat (Pilih Kelas)</label>
            <select name="kelas_id" class="form-select" required>
                <option value="" disabled selected>-- Pilih Kelas untuk Menentukan Tingkat --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }} (Kelas {{ $k->tingkat }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label">Guru Pengampu</label>
            <select name="guru_id" class="form-select" required>
                <option value="" disabled selected>-- Pilih Guru --</option>
                @foreach($gurus as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Simpan Mata Pelajaran</button>
    </form>
</div>
@endsection