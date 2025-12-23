@extends('layouts.master')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card p-4 bg-info text-white border-0 shadow-sm">
            <small class="opacity-75">Total Kelas Terdaftar</small>
            <h2 class="fw-bold mb-0">{{ $totalKelas }} Kelas</h2>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Manajemen Kelas</h4>
            <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary px-4">+ Tambah Kelas</a>
        </div>

        <form action="{{ route('admin.kelas.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama Kelas (ex: 10 IPA 1)..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="tingkat" class="form-select">
                    <option value="">-- Semua Tingkat --</option>
                    <option value="10" {{ request('tingkat') == '10' ? 'selected' : '' }}>Kelas 10</option>
                    <option value="11" {{ request('tingkat') == '11' ? 'selected' : '' }}>Kelas 11</option>
                    <option value="12" {{ request('tingkat') == '12' ? 'selected' : '' }}>Kelas 12</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
                <a href="{{ route('admin.kelas.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Kelas</th>
                        <th>Tingkat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelas as $index => $k)
                    <tr>
                        {{-- Nomor urut yang tetap sinkron dengan pagination --}}
                        <td>{{ $kelas->firstItem() + $index }}</td>
                        <td class="fw-bold">{{ $k->nama }}</td>
                        <td>
                            {{-- Menampilkan nilai ENUM 10, 11, 12 --}}
                            <span class="badge bg-secondary">Kelas {{ $k->tingkat }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.kelas.edit', $k->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                            <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus kelas?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Data kelas tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $kelas->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection