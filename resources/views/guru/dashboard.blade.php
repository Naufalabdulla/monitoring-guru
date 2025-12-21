<<<<<<< HEAD
@extends('layouts.app')

@section('content')
    <h2>Dashboard Guru</h2>
    <div class="row">
        @foreach($myMapels as $mapel)
            <div class="col-md-6 mb-3">
                <div class="card p-3">
                    <h5>{{ $mapel->nama }}</h5>
                    <hr>

                    <a href="{{ route('guru.materi.create', ['mapel_id' => $mapel->id]) }}"
                        class="btn btn-sm btn-outline-primary mb-3">
                        + Tambah Materi Baru
                    </a>

                    <h6>Daftar Materi:</h6>
                    <ul class="list-group">
                        @foreach($mapel->materis as $mt)
                            <li class="list-group-item d-flex justify-content-between">
                                {{ $mt->nama }}
                                <div class="btn-group">
                                    <a href="{{ route('guru.materi.edit', $mt->id) }}" class="btn btn-sm text-warning">Edit</a>

                                    <form action="{{ route('guru.materi.destroy', $mt->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm text-danger" onclick="return confirm('Hapus?')">X</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
=======
@extends('layouts.master')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Dashboard Guru</h2>
            <p class="text-muted">Selamat datang kembali, {{ Auth::user()->nama }}!</p>
        </div>
        <span class="badge bg-primary px-3 py-2 shadow-sm">
            <i class="bi bi-person-badge me-1"></i> {{ ucfirst(Auth::user()->role) }}
        </span>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($myMapels as $mapel)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                        <div>
                            <h5 class="mb-0 fw-bold text-primary">{{ $mapel->nama }}</h5>
                            <small class="text-muted">Kelas {{ $mapel->tingkat_kelas }}</small>
                        </div>
                        <a href="{{ route('guru.materi.create', ['mapel_id' => $mapel->id]) }}" 
                           class="btn btn-sm btn-primary shadow-sm">
                           <i class="bi bi-plus-lg"></i> Materi
                        </a>
                    </div>
                    <div class="card-body">
                        <h6 class="text-muted mb-3 small fw-bold text-uppercase">Materi Terunggah:</h6>
                        <ul class="list-group list-group-flush">
                            @forelse($mapel->materis as $mt)
                                <li class="list-group-item px-0 py-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="me-auto">
                                            <div class="fw-bold text-dark">{{ $mt->nama }}</div>
                                            
                                            {{-- Menampilkan Preview Deskripsi Singkat --}}
                                            @if($mt->deskripsi)
                                                <p class="text-muted small mb-1" style="font-size: 0.8rem;">
                                                    {{ Str::limit($mt->deskripsi, 45) }}
                                                </p>
                                            @endif

                                            {{-- Indikator File --}}
                                            @if($mt->file_pendukung)
                                                <a href="{{ asset('storage/' . $mt->file_pendukung) }}" target="_blank" class="badge bg-light text-info text-decoration-none border border-info-subtle">
                                                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> Lihat File
                                                </a>
                                            @endif
                                        </div>

                                        <div class="btn-group ms-2">
                                            <a href="{{ route('guru.materi.edit', $mt->id) }}" class="btn btn-sm btn-outline-warning border-0">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('guru.materi.destroy', $mt->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Hapus materi ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item text-muted small px-0 text-center py-4">
                                    <i class="bi bi-clipboard-x d-block fs-2 mb-2"></i>
                                    Belum ada materi untuk mata pelajaran ini.
                                </li>
                            @endforelse
                        </ul>
                    </div>
>>>>>>> origin/main
                </div>
            </div>
        @endforeach
    </div>
@endsection