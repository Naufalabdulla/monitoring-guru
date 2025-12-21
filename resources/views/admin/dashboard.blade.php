<<<<<<< HEAD
@extends('layouts.app')

@section('content')
    <div class="row mb-4 text-center">
        <div class="col-md-6">
            <div class="card p-3 bg-primary text-white">
                <h4>Total Guru: {{ $totalGuru }}</h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 bg-success text-white">
                <h4>Total Mapel: {{ $totalMapel }}</h4>
=======
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
>>>>>>> origin/main
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <div class="card p-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>Daftar Mapel</h4>
            <a href="{{ route('mapel.create') }}" class="btn btn-primary">+ Mapel</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Mapel</th>
                    <th>Tingkat</th>
                    <th>Guru</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mapels as $m)
                    @foreach($mapels as $m)
                        <tr>
                            <td>{{ $m->nama }}</td>
                            <td>{{ $m->tingkat_kelas }}</td>
                            <td>{{ $m->guru->nama ?? 'Belum Ada' }}</td>
                            <td>
                                <a href="{{ route('mapel.edit', $m->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('mapel.destroy', $m->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus mapel ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
=======
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
>>>>>>> origin/main
    </div>
@endsection