@extends('layouts.master')

@section('content')
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card p-4 bg-primary text-white border-0 shadow-sm">
                <small class="opacity-75">Total Guru Terdaftar</small>
                <h2 class="fw-bold mb-0">{{ $totalGuru }}</h2>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4 bg-success text-white border-0 shadow-sm">
                <small class="opacity-75">Mata Pelajaran Unik</small>
                {{-- Menampilkan jumlah mapel yang namanya berbeda --}}
                <h2 class="fw-bold mb-0">{{ $totalMapelUnique }}</h2>

                <hr class="my-2 opacity-25">

                {{-- Menampilkan TOTAL record asli dari database secara otomatis --}}
                <small class="opacity-75">Total {{ $totalMapelTerdaftar }} Record Terplot</small>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-4 bg-info text-white border-0 shadow-sm">
                <small class="opacity-75">Total Kelas</small>
                <h2 class="fw-bold mb-0">{{ $totalKelas }}</h2>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0 fw-bold">Monitoring Pembelajaran</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.mapel.create') }}" class="btn btn-primary btn-sm">+ Mapel</a>
                    <a href="{{ route('admin.kelas.create') }}" class="btn btn-outline-primary btn-sm">+ Kelas</a>
                </div>
            </div>
            <form action="{{ url()->current() }}" method="GET" class="row g-2 mb-4">
                <div class="col-md-3">
                    <label class="small text-muted">Cari Pelajaran</label>
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Nama Mapel..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <label class="small text-muted">Tingkat</label>
                    <select name="tingkat" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        <option value="10" {{ request('tingkat') == '10' ? 'selected' : '' }}>Kelas 10</option>
                        <option value="11" {{ request('tingkat') == '11' ? 'selected' : '' }}>Kelas 11</option>
                        <option value="12" {{ request('tingkat') == '12' ? 'selected' : '' }}>Kelas 12</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="small text-muted">Filter Guru</label>
                    <select name="guru_id" class="form-select form-select-sm">
                        <option value="">Semua Guru</option>
                        @foreach($listGuru as $guru)
                            <option value="{{ $guru->id }}" {{ request('guru_id') == $guru->id ? 'selected' : '' }}>
                                {{ $guru->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="small text-muted">Filter Kelas</label>
                    <select name="kelas_id" class="form-select form-select-sm">
                        <option value="">Semua Kelas</option>
                        @foreach($listKelas as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-1">
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
                            <th>Tingkat</th>
                            <th>Kelas Spesifik</th>
                            <th>Guru Pengampu</th>
                            <th>Progress</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mapels as $index => $m)
                            <tr>
                                <td>{{ $mapels->firstItem() + $index }}</td>
                                <td class="fw-semibold">{{ $m->nama }}</td>
                                <td>
                                    <span class="badge bg-dark">SMA Kelas {{ $m->kelas->tingkat ?? '-' }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $m->kelas->nama ?? 'Tanpa Kelas' }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm-text me-2">{{ substr($m->guru->nama ?? 'G', 0, 1) }}</div>
                                        {{ $m->guru->nama ?? 'Belum Diatur' }}
                                    </div>
                                </td>

                                <td style="min-width: 150px;">
                                    @php
                                        // Menghitung jumlah pertemuan yang sudah berstatus '1' (Selesai)
                                        $selesai = $m->progress->where('status', 1)->count();
                                        $persen = ($selesai / 19) * 100;
                                    @endphp
                                    <div class="progress" style="height: 12px; border-radius: 10px;">
                                        <div class="progress-bar {{ $persen == 100 ? 'bg-success' : 'bg-primary' }}"
                                            role="progressbar" style="width: {{ $persen }}%;" aria-valuenow="{{ $persen }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-1">
                                        <small class="text-muted" style="font-size: 10px;">{{ round($persen) }}% Selesai</small>
                                        <small class="text-muted" style="font-size: 10px;">{{ $selesai }}/19</small>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('admin.mapel.edit', $m->id) }}"
                                        class="btn btn-sm btn-light border">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">Data monitoring tidak ditemukan.</td>
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

    <style>
        .avatar-sm-text {
            width: 25px;
            height: 25px;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 12px;
            font-weight: bold;
            color: #495057;
        }
    </style>
@endsection