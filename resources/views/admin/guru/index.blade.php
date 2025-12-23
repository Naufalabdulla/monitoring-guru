@extends('layouts.master')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card p-4 bg-primary text-white border-0 shadow-sm">
            <small class="opacity-75">Total Guru Terdaftar</small>
            <h2 class="fw-bold mb-0">{{ $totalGuru }} Orang</h2>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Daftar Guru</h4>
            <a href="{{ route('admin.guru.create') }}" class="btn btn-primary px-4">+ Tambah Guru</a>
        </div>

        <form action="{{ route('admin.guru.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama atau Email..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-secondary w-100">Cari</button>
                <a href="{{ route('admin.guru.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Guru</th>
                        <th>Email</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gurus as $index => $g)
                    <tr>
                        <td>{{ $gurus->firstItem() + $index }}</td>
                        <td class="fw-bold">{{ $g->nama }}</td>
                        <td>{{ $g->email }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.guru.edit', $g->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                            <form action="{{ route('admin.guru.destroy', $g->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus guru ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">Data guru tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $gurus->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection