@extends('layouts.master')
@section('title', 'Jadwal')
@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Jadwal Guru</h2>
        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary px-4 shadow-sm">
            <i class="bi bi-plus-circle me-2"></i>Tambah Jadwal
        </a>
    </div>

    {{-- Form Filter --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.jadwal.index') }}" method="GET" class="row g-2">
                <div class="col-md-3">
                    <select name="hari" class="form-select">
                        <option value="">-- Semua Hari --</option>
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $h)
                            <option value="{{ $h }}" {{ request('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="kelas_id" class="form-select">
                        <option value="">-- Semua Kelas --</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="guru_id" class="form-select">
                        <option value="">-- Semua Guru --</option>
                        @foreach($guruList as $guru)
                            <option value="{{ $guru->id }}" {{ request('guru_id') == $guru->id ? 'selected' : '' }}>
                                {{ $guru->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-info text-white w-100">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-light border w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Hari & Jam</th>
                            <th>Pelajaran</th>
                            <th>Kelas</th>
                            <th>Guru</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $item)
                        <tr>
                            <td class="text-muted">{{ ($jadwals->currentPage() - 1) * $jadwals->perPage() + $loop->iteration }}</td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 mb-1">
                                    {{ $item->hari }}
                                </span> <br>
                                <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</small>
                            </td>
                            <td class="fw-bold text-dark">{{ $item->mapel->nama ?? 'N/A' }}</td>
                            <td><span class="text-secondary">{{ $item->kelas->nama ?? 'N/A' }}</span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-person text-primary"></i>
                                    </div>
                                    <span>{{ $item->guru->nama ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group shadow-sm">
                                    <a href="{{ route('admin.jadwal.edit', $item->id) }}" class="btn btn-sm btn-warning text-white" title="Edit Jadwal">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.jadwal.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus Jadwal ini?')" title="Hapus Jadwal">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                                Tidak ditemukan data jadwal yang sesuai filter.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{-- Pastikan query string tetap ada saat pindah halaman --}}
                {{ $jadwals->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
    
@endsection