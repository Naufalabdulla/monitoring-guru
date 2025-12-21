@extends('layouts.master')

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
@endsection