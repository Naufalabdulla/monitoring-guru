@extends('layouts.master')

@section('title', 'Daftar Materi Saya')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Daftar Materi Saya</h3>
                <p class="text-muted small">Kelola materi pembelajaran untuk setiap mata pelajaran Anda.</p>
            </div>
            <a href="{{ route('guru.materi.create') }}" class="btn btn-success px-4 shadow-sm">
                <i class="bi bi-plus-circle me-2"></i>Buat Materi Baru
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th>Mata Pelajaran</th>
                        <th>Judul Materi</th>
                        <th>Deskripsi</th>
                        <th class="text-center">File</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materis as $row)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge bg-light text-primary border border-primary-subtle px-3 py-2">
                                {{ $row->mapel->nama ?? 'Tanpa Mapel' }}
                            </span>
                        </td>
                        <td class="fw-semibold">{{ $row->nama }}</td>
                        <td>
                            <small class="text-muted">
                                {{ Str::limit($row->deskripsi, 50, '...') ?? '-' }}
                            </small>
                        </td>
                        <td class="text-center">
                            @if($row->file_pendukung)
                                <a href="{{ asset('storage/' . $row->file_pendukung) }}" target="_blank" 
                                   class="btn btn-sm btn-outline-info" title="Lihat File">
                                    <i class="bi bi-file-earmark-arrow-down"></i>
                                </a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('guru.materi.edit', $row->id) }}" class="btn btn-sm btn-warning text-white">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('guru.materi.destroy', $row->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Hapus materi ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-folder2-open fs-1 d-block mb-2"></i>
                            Belum ada materi yang Anda buat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection