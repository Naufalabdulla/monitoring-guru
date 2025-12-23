@extends('layouts.master')

@section('content')
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
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0 fw-bold">Manajemen Mata Pelajaran</h4>
                <a href="{{ route('admin.mapel.create') }}" class="btn btn-primary px-4">+ Tambah Mapel Baru</a>
            </div>

            <form action="{{ route('admin.mapel.index') }}" method="GET" class="row g-2 mb-4">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama Mapel..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="tingkat" class="form-select">
                        <option value="">-- Semua Tingkat --</option>
                        <option value="10" {{ request('tingkat') == '10' ? 'selected' : '' }}>Kelas 10</option>
                        <option value="11" {{ request('tingkat') == '11' ? 'selected' : '' }}>Kelas 11</option>
                        <option value="12" {{ request('tingkat') == '12' ? 'selected' : '' }}>Kelas 12</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.mapel.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Tingkat</th>
                            <th>Guru Pengampu</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mapels as $index => $m)
                            <tr>
                                <td>{{ $mapels->firstItem() + $index }}</td>
                                <td class="fw-bold">{{ $m->nama }}</td>
                                <td>
                                    <span class="badge bg-secondary">SMA Kelas {{ $m->kelas->tingkat ?? '-' }}</span>
                                </td>
                                <td>{{ $m->guru->nama ?? 'Belum Ditentukan' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.mapel.edit', $m->id) }}"
                                        class="btn btn-sm btn-outline-warning">Edit</a>
                                    <form action="{{ route('admin.mapel.destroy', $m->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Data tidak ditemukan.</td>
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