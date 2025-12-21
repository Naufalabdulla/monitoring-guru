<<<<<<< HEAD
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4">
            <h4>Tambah Mata Pelajaran</h4>
            <hr>
            <form action="{{ route('mapel.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Mata Pelajaran</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukan nama mapel..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tingkat Kelas</label>
                    <input type="text" name="tingkat_kelas" class="form-control" placeholder="Contoh: 10 IPA" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pilih Guru</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
=======
@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h4>Tambah Mata Pelajaran</h4>
                <hr>
                <form action="{{ route('admin.mapel.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Mata Pelajaran</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukan nama mapel..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih Kelas</label>
                        <select name="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror" required>
                            <option value="" selected disabled>-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                        @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Guru</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">-- Pilih Guru --</option>
                            @foreach($gurus as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
>>>>>>> origin/main
@endsection