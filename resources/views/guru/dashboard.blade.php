@extends('layouts.master')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold mb-0">Dashboard Guru</h2>
            <p class="text-muted">Halo, {{ Auth::user()->nama }}! Berikut ringkasan kegiatan mengajar Anda.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <span class="badge bg-primary px-3 py-2 shadow-sm">
                <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </span>
        </div>
    </div>

    @if($jadwalHariIni->count() > 0)
        <div class="alert alert-primary border-0 shadow-sm d-flex align-items-center mb-4">
            <div class="bg-primary text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                style="width: 40px; height: 40px;">
                <i class="bi bi- megaphone-fill"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-0 text-primary">Ada Jadwal Hari Ini!</h6>
                <small>Anda memiliki {{ $jadwalHariIni->count() }} sesi mengajar di hari <strong>{{ $hariIni }}</strong>. Segera
                    siapkan materi Anda.</small>
            </div>
        </div>
    @else
        <div class="alert alert-light border-0 shadow-sm d-flex align-items-center mb-4">
            <i class="bi bi-emoji-smile-fill fs-4 me-3 text-success"></i>
            <div>
                <strong>Santai Sejenak:</strong> Tidak ada jadwal mengajar untuk hari ini ({{ $hariIni }}).
            </div>
        </div>
    @endif
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card p-3 border-0 shadow-sm bg-primary text-white">
                <small class="opacity-75">Mapel Diampu</small>
                <h3 class="fw-bold mb-0">{{ $totalMapel }}</h3>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-3 border-0 shadow-sm bg-success text-white">
                <small class="opacity-75">Total Kelas Diajar</small>
                <h3 class="fw-bold mb-0">{{ $totalKelas }}</h3>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-3 border-0 shadow-sm bg-info text-white">
                <small class="opacity-75">Materi Terunggah</small>
                <h3 class="fw-bold mb-0">{{ $totalMateri }}</h3>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 fw-bold">
                    <i class="bi bi-table me-2 text-primary"></i> Jadwal Mengajar Mingguan
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-5 g-3">
                        @php $hariKerja = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']; @endphp
                        @foreach($hariKerja as $hari)
                            <div class="col">
                                <div
                                    class="p-3 rounded h-100 {{ $hari == $hariIni ? 'bg-primary-subtle border border-primary' : 'bg-light border' }}">
                                    <h6 class="fw-bold {{ $hari == $hariIni ? 'text-primary' : '' }} mb-3">{{ $hari }}</h6>
                                    @if(isset($jadwalMingguan[$hari]))
                                        @foreach($jadwalMingguan[$hari] as $j)
                                            <div class="bg-white p-2 rounded shadow-sm mb-2 border-start border-3 border-primary"
                                                style="font-size: 0.75rem;">
                                                <strong>{{ $j->mapel?->nama ?? '-' }}</strong><br>
                                                <span class="badge bg-secondary">Kelas {{ $j->kelas?->nama ?? '-' }}</span>
                                                <br>
                                                {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted small italic">Kosong</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <h4 class="fw-bold mb-3">Progress Pembelajaran Mapel</h4>
            <div class="row">
                @foreach($myMapels as $mapel)
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="fw-bold text-primary mb-0">{{ $mapel->nama }}</h5>
                                    <a href="{{ route('guru.progress.index', ['mapel_id' => $mapel->id]) }}"
                                        class="btn btn-sm btn-outline-primary">Kelola</a>
                                </div>
                                <p class="text-muted small">Tingkat {{ $mapel->kelas->tingkat }} - {{ $mapel->kelas->nama }}</p>

                                @php
                                    $selesai = $mapel->progress->where('status', 1)->count();
                                    $persen = ($selesai / 19) * 100;
                                @endphp
                                <div class="progress mb-2" style="height: 15px; border-radius: 10px;">
                                    <div class="progress-bar {{ $persen == 100 ? 'bg-success' : 'bg-primary' }}"
                                        role="progressbar" style="width: {{ $persen }}%;">
                                        {{ round($persen) }}%
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between small text-muted">
                                    <span>Indikator Tercapai</span>
                                    <span>{{ $selesai }} / 19 Pertemuan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection