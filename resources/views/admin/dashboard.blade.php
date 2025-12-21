@extends('layouts.master')

@section('content')
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card p-4 bg-primary text-white">
                <small class="opacity-75">Total Guru Terdaftar</small>
                <h2 class="fw-bold mb-0">{{ $totalGuru }}</h2>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card p-4 bg-success text-white">
                <small class="opacity-75">Total Mata Pelajaran</small>
                <h2 class="fw-bold mb-0">{{ $totalMapel }}</h2>
            </div>
        </div>
         <div class="col-md-6 mb-3">
            <div class="card p-4 bg-success text-white">
                <small class="opacity-75">Total Kelas</small>
                <h2 class="fw-bold mb-0">{{ $totalKelas }}</h2>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0 fw-bold">Daftar Mata Pelajaran</h4>
                <a href="{{ route('admin.mapel.create') }}" class="btn btn-primary px-4">+ Tambah Mapel</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Mapel</th>
                            <th>Tingkat</th>
                            <th>Guru Pengampu</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mapels as $m)
                        <tr>
                            <td class="fw-semibold">{{ $m->nama }}</td>
                            <td><span class="badge bg-secondary">Kelas {{ $m->tingkat_kelas }}</span></td>
                            <td>{{ $m->guru->nama ?? 'Belum Ada Guru' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.mapel.edit', $m->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                <form action="{{ route('admin.mapel.destroy', $m->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection