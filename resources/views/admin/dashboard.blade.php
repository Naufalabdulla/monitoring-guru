@extends('layouts.master')

@section('content')
    {{-- Statistik Ringkas --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card p-4 bg-primary text-white border-0 shadow-sm">
                <small class="opacity-75">Total Guru</small>
                <h2 class="fw-bold mb-0">{{ $totalGuru }}</h2>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4 bg-success text-white border-0 shadow-sm">
                <small class="opacity-75">Mata Pelajaran</small>
                <h2 class="fw-bold mb-0">{{ $totalMapelUnique }}</h2>
                <hr class="my-2 opacity-25">
                <small class="opacity-75">{{ $totalMapelTerdaftar }} Record Monitoring</small>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4 bg-info text-white border-0 shadow-sm">
                <small class="opacity-75">Total Kelas</small>
                <h2 class="fw-bold mb-0">{{ $totalKelas }}</h2>
            </div>
        </div>
    </div>

    {{-- Tabel Monitoring --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0 fw-bold">Monitoring Pembelajaran</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.mapel.create') }}" class="btn btn-primary btn-sm">+ Mapel</a>
                    <a href="{{ route('admin.kelas.create') }}" class="btn btn-outline-primary btn-sm">+ Kelas</a>
                </div>
            </div>

            {{-- Form Filter --}}
            <form action="{{ url()->current() }}" method="GET" class="row g-2 mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari Mapel..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="guru_id" class="form-select form-select-sm">
                        <option value="">Semua Guru</option>
                        @foreach($listGuru as $guru)
                            <option value="{{ $guru->id }}" {{ request('guru_id') == $guru->id ? 'selected' : '' }}>
                                {{ $guru->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-secondary btn-sm w-100">Cari</button>
                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Guru Pengampu</th>
                            <th width="200">Progress</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mapels as $index => $m)
                            <tr>
                                <td>{{ $mapels->firstItem() + $index }}</td>
                                {{-- Kolom Mapel: Nama & Tingkat --}}
                                <td>
                                    <div class="fw-bold">{{ $m->nama }}</div>
                                    <small class="text-muted">Tingkat {{ $m->kelas->tingkat ?? '-' }}</small>
                                </td>
                                {{-- Kolom Kelas: Nama & Tingkat --}}
                                <td>
                                    <div>{{ $m->kelas->nama ?? 'N/A' }}</div>
                                    <small class="badge bg-light text-dark border">Tingkat
                                        {{ $m->kelas->tingkat ?? '-' }}</small>
                                </td>
                                {{-- Kolom Guru: Nama & Email --}}
                                <td>
                                    <div class="fw-semibold">{{ $m->guru->nama ?? 'Belum Diatur' }}</div>
                                    <small class="text-muted" style="font-size: 11px;">{{ $m->guru->email ?? '-' }}</small>
                                </td>
                                {{-- Progress Tetap Dipertahankan untuk Monitoring --}}
                                <td>
                                    @php
                                        $selesai = $m->progress->where('status', 1)->count();
                                        $persen = (19 > 0) ? ($selesai / 19) * 100 : 0;
                                    @endphp
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar {{ $persen == 100 ? 'bg-success' : 'bg-primary' }}"
                                            style="width: {{ $persen }}%"></div>
                                    </div>
                                    <small class="text-muted" style="font-size: 10px;">{{ round($persen) }}% ({{ $selesai }}/19
                                        Pertemuan)</small>
                                </td>
                                <td class="text-center">
                                    {{-- Aksi diubah dari Edit menjadi Lihat Progress --}}
                                    <a href="{{ route('admin.progress.show', $m->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye me-1"></i>Lihat Progress
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">Data monitoring tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $mapels->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection