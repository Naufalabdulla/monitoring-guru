<<<<<<< HEAD
@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h4>Edit Materi</h4>
    <form action="{{ route('guru.materi.update', $materi->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Mata Pelajaran</label>
            <select name="mapel_id" class="form-select" disabled> @foreach($mapels as $m)
                    <option value="{{ $m->id }}" {{ $materi->mapel_id == $m->id ? 'selected' : '' }}>
                        {{ $m->nama }} </option>
                @endforeach
            </select>
            <input type="hidden" name="mapel_id" value="{{ $materi->mapel_id }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Materi</label>
            <input type="text" name="nama" value="{{ $materi->nama }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('guru.dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
=======
@extends('layouts.master')

@section('title', 'Edit Materi')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h4 class="fw-bold">Edit Materi</h4>
                        <p class="text-muted small">Perbarui judul atau nama materi yang sudah ada.</p>
                    </div>

                    <form action="{{ route('guru.materi.update', $materi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted">Mata Pelajaran</label>
                            {{-- Kita pakai disabled select untuk visual, dan hidden input untuk data --}}
                            <select class="form-select bg-light" disabled>
                                @foreach($mapels as $m)
                                    <option value="{{ $m->id }}" {{ $materi->mapel_id == $m->id ? 'selected' : '' }}>
                                        {{ $m->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="mapel_id" value="{{ $materi->mapel_id }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nama Materi</label>
                            <input type="text" name="nama" value="{{ old('nama', $materi->nama) }}"
                                class="form-control @error('nama') is-invalid @enderror" required>
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
                            <button type="submit" class="btn btn-warning text-white py-2 fw-bold shadow-sm">
                                <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
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