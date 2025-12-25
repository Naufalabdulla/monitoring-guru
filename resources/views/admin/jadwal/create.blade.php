@extends('layouts.master')
@section('title', 'Tambah Jadwal')
@section('content')

    <div class="container-fluid">
        <div class="card shadow-sm border-0 col-md-8 mx-auto">
            <div class="card-header bg-primary text-white p-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-plus-circle me-2"></i>Tambah Jadwal Baru</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.jadwal.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Pilih Hari</label>
                            <select name="hari" class="form-select @error('hari') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Pilih Hari --</option>
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $h)
                                    <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                                @endforeach
                            </select>
                            @error('hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Jam Mulai</label>
                            <input type="time" name="jam_mulai"
                                class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai') }}"
                                required>
                            @error('jam_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Jam Selesai</label>
                            <input type="time" name="jam_selesai"
                                class="form-control @error('jam_selesai') is-invalid @enderror"
                                value="{{ old('jam_selesai') }}" required>
                            @error('jam_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Mata Pelajaran</label>
                        <select name="mapel_id" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Mapel (Daftar Unik) --</option>
                            @foreach($mapelList as $mapel)
                                <option value="{{ $mapel->id }}">
                                    {{ $mapel->nama }} (Tersedia untuk Tingkat {{ $mapel->kelas->tingkat ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Nama mapel otomatis disaring agar tidak duplikat.</small>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Kelas</label>
                            <select name="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Pilih Kelas --</option>
                                @foreach($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Guru Pengajar</label>
                            <select name="guru_id" class="form-select @error('guru_id') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Pilih Guru --</option>
                                @foreach($guruList as $guru)
                                    <option value="{{ $guru->id }}" {{ old('guru_id') == $guru->id ? 'selected' : '' }}>
                                        {{ $guru->nama }}</option>
                                @endforeach
                            </select>
                            @error('guru_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary py-2 fw-bold shadow-sm">
                            <i class="bi bi-save me-2"></i>Simpan Jadwal Baru
                        </button>
                        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-light border">Kembali ke Daftar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection