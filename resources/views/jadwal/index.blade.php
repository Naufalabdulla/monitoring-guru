@extends('layouts.master')
@section('title', 'Jadwal')
@section('content')

<h2>Jadwal Guru</h2>
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Manajemen Jadwal</h4>
            <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
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
                    <td>{{ ($jadwals->currentPage() - 1) * $jadwals->perPage() + $loop->iteration }}</td>
                    <td>
                        <span class="badge bg-info text-dark">{{ $item->hari }}</span> <br>
                        <small>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</small>
                    </td>
                    <td class="fw-bold">{{ $item->mapel->nama ?? 'N/A' }}</td>
                    <td>{{ $item->kelas->nama ?? 'N/A' }}</td>
                    <td>{{ $item->guru->nama ?? 'N/A' }}</td>
                    <td class="text-end pe-4">
                        <a href="{{ route('admin.jadwal.edit', $item->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                        <form action="{{ route('admin.jadwal.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus Jadwal?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data jadwal.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $jadwals->links() }}
        </div>
    </div>
</div>
    
@endsection