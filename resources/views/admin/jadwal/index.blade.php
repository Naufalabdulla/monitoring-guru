@extends('layouts.master')
@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Manajemen Jadwal</h4>
                <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
            </div>

            <form action="{{ url()->current() }}" method="GET" class="row g-2 mb-4">
                <div class="col-md-2">
                    <select name="hari" class="form-select form-select-sm">
                        <option value="">-- Hari --</option>
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $h)
                            <option value="{{ $h }}" @selected(request('hari') == $h)>{{ $h }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="sort" class="form-select form-select-sm">
                        <option value="latest">Terbaru</option>
                        <option value="hari" @selected(request('sort') == 'hari')>Urut Hari</option>
                        <option value="mapel" @selected(request('sort') == 'mapel')>Abjad Mapel</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary btn-sm w-100">Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Waktu</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Guru</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwals as $index => $j)
                            <tr>
                                <td>{{ $jadwals->firstItem() + $index }}</td>
                                <td><strong>{{ $j->hari }}</strong><br><small>{{ $j->jam_mulai }} -
                                        {{ $j->jam_selesai }}</small></td>
                                <td class="fw-bold">{{ $j->mapel->nama ?? '-' }}</td>
                                <td>{{ $j->kelas->nama ?? '-' }}</td>
                                <td>{{ $j->guru->nama ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.jadwal.edit', $j->id) }}"
                                        class="btn btn-sm btn-warning text-white">Edit</a>
                                    {{-- Letakkan di dalam kolom Aksi pada tabel index --}}
                                    <form action="{{ route('admin.jadwal.destroy', $j->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-center">{{ $jadwals->appends(request()->input())->links() }}</div>
        </div>
    </div>
@endsection