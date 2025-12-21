@extends('layouts.master')



@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Daftar Mata Pelajaran</h3>
                <p class="text-muted small">Kelola data mata pelajaran sekolah Anda di sini.</p>
            </div>
            <a href="{{ route('admin.mapel.create') }}" class="btn btn-primary px-4 shadow-sm">
                <i class="bi bi-plus-lg me-2"></i>Tambah Mapel
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Tingkat Kelas</th>
                        <th>Guru Pengampu</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mapels as $m)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $m->nama }}</td> {{-- Perhatikan: Pakai 'nama' sesuai migration --}}
                       <td>{{ $m->kelas->nama ?? 'Belum Ada Kelas' }}</td>
                        <td>
                            <span class="text-muted">
                                <i class="bi bi-person-badge me-1"></i> {{ $m->guru->nama ?? 'Belum Ditentukan' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group shadow-sm" role="group">
                                <a href="{{ route('admin.mapel.edit', $m->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                <form action="{{ route('admin.mapel.destroy', $m->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus mapel ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada data mata pelajaran.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
