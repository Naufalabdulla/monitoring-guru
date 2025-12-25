@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h3 class="fw-bold">Mata Pelajaran yang Saya Ajar</h3>
            <p class="text-muted">Daftar kelas dan mata pelajaran yang ditugaskan kepada Anda.</p>
        </div>
    </div>

    <div class="row">
        @forelse($mapels as $m)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="badge bg-primary-subtle text-primary mb-3">SMA Kelas {{ $m->kelas->tingkat }}</div>
                        <h5 class="fw-bold mb-1">{{ $m->nama }}</h5>
                        <p class="text-muted small mb-4"><i class="bi bi-door-open me-1"></i>Ruang: {{ $m->kelas->nama }}</p>
                        
                        <div class="d-grid gap-2">
                            {{-- Tombol Lihat Materi (Filter ke materi index) --}}
                            <a href="{{ route('guru.materi.index', ['mapel_id' => $m->id]) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-book me-1"></i>Lihat Materi
                            </a>
                            {{-- Tombol Kelola Progress (Pertemuan 1-19) --}}
                            <a href="{{ route('guru.progress.index', ['mapel_id' => $m->id]) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-bar-chart-steps me-1"></i>Kelola Progress
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <img src="{{ asset('assets/empty.svg') }}" width="200" class="mb-3 opacity-50">
                <p class="text-muted">Belum ada jadwal mapel yang diberikan Admin untuk Anda.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection