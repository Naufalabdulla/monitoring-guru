@extends('layouts.master')

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
@endsection