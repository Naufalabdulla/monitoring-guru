@extends('layouts.master')

@section('title', 'Edit Kelas')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h4 class="fw-bold">Edit Kelas</h4>
                    <p class="text-muted small">Perbarui informasi nama atau tingkatan kelas.</p>
                </div>

                <form action="{{ route('admin.kelas.update', $kela->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Kelas</label>
                        <input type="text" name="nama" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               value="{{ old('nama', $kela->nama) }}" 
                               placeholder="Contoh: 10 IPA 1" required>
                        @error('nama') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Tingkat</label>
                        <select name="tingkat" class="form-select @error('tingkat') is-invalid @enderror" required>
                            <option value="10" {{ old('tingkat', $kela->tingkat) == '10' ? 'selected' : '' }}>10</option>
                            <option value="11" {{ old('tingkat', $kela->tingkat) == '11' ? 'selected' : '' }}>11</option>
                            <option value="12" {{ old('tingkat', $kela->tingkat) == '12' ? 'selected' : '' }}>12</option>
                        </select>
                        @error('tingkat') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-warning text-white py-2 fw-bold shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.kelas.index') }}" class="btn btn-light text-muted">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection