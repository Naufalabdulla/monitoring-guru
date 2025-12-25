@extends('layouts.master')

@section('content')
    {{-- Header & Welcome --}}
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold mb-0">Dashboard Guru</h2>
            <p class="text-muted">Halo, {{ Auth::user()->nama }}! Selamat datang kembali.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <span class="badge bg-white text-dark border px-3 py-2 shadow-sm">
                <i class="bi bi-calendar3 me-1 text-primary"></i> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </span>
        </div>
    </div>

    {{-- Alert Jadwal Hari Ini --}}
    @if($jadwalHariIni->count() > 0)
        <div class="alert alert-primary border-0 shadow-sm d-flex align-items-center mb-4">
            <div class="bg-primary text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                style="width: 40px; height: 40px;">
                <i class="bi bi-megaphone"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-0">Ada Jadwal Mengajar Hari Ini!</h6>
                <small>Anda memiliki {{ $jadwalHariIni->count() }} sesi mengajar. Pastikan materi sudah siap.</small>
            </div>
        </div>
    @endif

    {{-- Statistik Ringkas (Encapsulation Data) --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card p-3 border-0 shadow-sm bg-primary text-white">
                <small class="opacity-75">Mapel Diampu</small>
                <h3 class="fw-bold mb-0">{{ $totalMapel }}</h3>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-3 border-0 shadow-sm bg-success text-white">
                <small class="opacity-75">Total Kelas</small>
                <h3 class="fw-bold mb-0">{{ $totalKelas }}</h3>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-3 border-0 shadow-sm bg-info text-white">
                <small class="opacity-75">Materi Terupload</small>
                <h3 class="fw-bold mb-0">{{ $totalMateri }}</h3>
            </div>
        </div>
    </div>

    {{-- Jadwal Mingguan (Agregasi dari Jadwal) --}}
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-header bg-white py-3 fw-bold">
            <i class="bi bi-calendar-week me-2 text-primary"></i> Jadwal Mengajar Mingguan
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-5 g-3">
                @php $hariKerja = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']; @endphp
                @foreach($hariKerja as $hari)
                    <div class="col">
                        <div
                            class="p-3 rounded h-100 {{ $hari == $hariIni ? 'bg-primary-subtle border border-primary' : 'bg-light border' }}">
                            <h6 class="fw-bold mb-3 {{ $hari == $hariIni ? 'text-primary' : '' }}">{{ $hari }}</h6>
                            @if(isset($jadwalMingguan[$hari]))
                                @foreach($jadwalMingguan[$hari] as $j)
                                    <div class="bg-white p-2 rounded shadow-sm mb-2 border-start border-3 border-primary"
                                        style="font-size: 0.75rem;">
                                        {{-- Menggunakan ?-> agar jika mapel null tidak error --}}
                                        <strong>{{ $j->mapel?->nama ?? 'Mapel Tidak Ditemukan' }}</strong><br>

                                        {{-- Hal yang sama untuk relasi kelas --}}
                                        <span class="text-muted">Kelas {{ $j->kelas?->nama ?? 'N/A' }}</span><br>

                                        {{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }}
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted small italic">Tidak ada jadwal</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Monitoring Progress Mapel (Komposisi Progress) --}}
    <h4 class="fw-bold mb-3">Progress Pembelajaran Saya</h4>
    <div class="row">
        @foreach($myMapels as $mapel)
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="fw-bold text-primary mb-0">{{ $mapel->nama }}</h5>
                                <small class="text-muted">Kelas {{ $mapel->kelas->nama }}</small>
                            </div>
                            <a href="{{ route('guru.progress.index', ['mapel_id' => $mapel->id]) }}"
                                class="btn btn-sm btn-primary px-3">
                                Kelola Pertemuan
                            </a>
                        </div>

                        @php
                            $selesai = $mapel->progress->where('status', 1)->count();
                            $persen = (19 > 0) ? ($selesai / 19) * 100 : 0;
                        @endphp

                        <div class="progress mb-2" style="height: 12px; border-radius: 10px;">
                            <div class="progress-bar {{ $persen == 100 ? 'bg-success' : 'bg-primary' }}" role="progressbar"
                                style="width: {{ $persen }}%;">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between small text-muted">
                            <span>Target Kurikulum</span>
                            <span>{{ $selesai }} / 19 Pertemuan Terlaksana</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection