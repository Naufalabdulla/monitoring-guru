<<<<<<< HEAD
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4">
            <h4>Tambah Materi untuk: <span class="text-primary">{{ $mapel->nama }}</span></h4>
            <hr>
            <form action="{{ route('materi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">

                <div class="mb-3">
                    <label class="form-label">Nama Materi</label>
                    <input type="text" name="nama" class="form-control" placeholder="Contoh: Pertemuan 1 - Aljabar" required autofocus>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">Simpan Materi</button>
                    <a href="{{ route('guru.dashboard') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
=======
@extends('layouts.master')

@section('title', 'Tambah Materi Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h4 class="fw-bold">Tambah Materi</h4>
                        <p class="text-muted small">Lengkapi data di bawah untuk menambah materi baru.</p>
                    </div>

                    <form action="{{ route('guru.materi.store') }}" method="POST">
                        @csrf

                        @if(isset($mapel))
                            {{-- Jika Mapel sudah ditentukan dari Dashboard --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Mata Pelajaran</label>
                                <input type="text" class="form-control bg-light" value="{{ $mapel->nama }}" readonly>
                                <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                            </div>
                        @else
                            {{-- Jika Guru bebas memilih Mapel (dari Index Materi) --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pilih Mata Pelajaran</label>
                                <select name="mapel_id" class="form-select @error('mapel_id') is-invalid @enderror" required>
                                    <option value="" selected disabled>-- Pilih Mapel --</option>
                                    @foreach($mapels as $m)
                                        <option value="{{ $m->id }}">{{ $m->nama }}</option>
                                    @endforeach
                                </select>
                                @error('mapel_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @endif

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nama Materi</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                placeholder="Contoh: Pertemuan 1 - Pengenalan" value="{{ old('nama') }}" required autofocus>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi Materi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"
                                placeholder="Tambahkan penjelasan singkat..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">File Pendukung (PDF/PNG)</label>
                            <input type="file" name="file_pendukung" class="form-control">
                            <small class="text-muted">Format: PDF, PNG, JPG (Maks. 2MB)</small>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2 fw-bold">
                                <i class="bi bi-save me-1"></i> Simpan Materi
                            </button>
                            <a href="{{ route('guru.dashboard') }}" class="btn btn-light text-muted">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
>>>>>>> origin/main
@endsection