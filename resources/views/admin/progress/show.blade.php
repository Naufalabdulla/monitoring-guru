@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-0">Detail Progress Pembelajaran</h2>
                <p class="text-muted">
                    {{ $mapel->nama }} -
                    {{ $mapel->kelas->nama ?? 'Kelas Tidak Ditemukan' }}
                    ({{ $mapel->guru->nama ?? 'Guru Belum Diatur' }})
                </p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Dashboard
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="100">Pertemuan</th>
                                <th>Materi Pembelajaran</th>
                                <th>Deskripsi/Konten</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($progressItems as $p)
                                <tr>
                                    <td class="fw-bold text-center">{{ $p->pertemuan }}</td>
                                    <td>
                                        @if($p->materi instanceof \App\Models\Materi) {{-- Memastikan ini adalah objek, bukan
                                            string --}}
                                            <span class="fw-semibold text-primary">{{ $p->materi->nama }}</span>
                                        @else
                                            <span class="text-muted italic">Materi belum diinput</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $p->catatan ?? 'Tidak ada catatan tambahan' }}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        @if($p->status == 1)
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Selesai</span>
                                        @else
                                            <span class="badge bg-warning text-dark"><i class="bi bi-clock me-1"></i>Belum</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection