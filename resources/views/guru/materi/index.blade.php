@extends('layouts.master')
@section('title', 'Daftar Materi Saya')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Daftar Materi Saya</h3>
                <p class="text-muted small">Kelola materi pembelajaran Anda.</p>
            </div>
            <a href="{{ route('guru.materi.create') }}" class="btn btn-success px-4 shadow-sm">
                <i class="bi bi-plus-circle me-2"></i>Buat Materi Baru
            </a>
        </div>

        <form action="{{ route('guru.materi.index') }}" method="GET" class="row g-2 mb-4 p-3 bg-light rounded border">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Cari judul materi..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="mapel_id" class="form-select">
                    <option value="">-- Semua Mata Pelajaran --</option>
                    @foreach($mapels as $m)
                        <option value="{{ $m->id }}" {{ request('mapel_id') == $m->id ? 'selected' : '' }}>
                            {{ $m->nama }} - ({{ $m->kelas->nama ?? 'Umum' }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                <a href="{{ route('guru.materi.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th>Mata Pelajaran</th>
                        <th>Judul Materi</th>
                        <th>Deskripsi</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materis as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge bg-light text-primary border border-primary-subtle px-3 py-2">
                                {{ $row->mapel->nama ?? 'N/A' }} - ({{ $row->mapel->kelas->nama ?? 'Umum' }})
                            </span>
                        </td>
                        <td class="fw-semibold">{{ $row->nama }}</td>
                        <td><small class="text-muted">{{ Str::limit($row->deskripsi, 50) ?? '-' }}</small></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('guru.materi.edit', $row->id) }}" class="btn btn-sm btn-warning text-white"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('guru.materi.destroy', $row->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4">Data tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection