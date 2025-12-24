@extends('layouts.master')
@section('title', 'Tambah Jadwal')
@section('content')

    <div class="container-fluid">
        <h2 class="mb-4">Manajemen Jadwal Guru</h2>

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Form Tambah Jadwal</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.jadwal.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Hari</label>
                            <select name="hari" class="form-select" required>
                                <option value="">Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kelas</label>
                            <select name="kelas_id" class="form-select" required>
                                @foreach($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mata Pelajaran</label>
                            <select name="mapel_id" class="form-select" required>
                                <option value="">-- Pilih Mapel --</option>
                                @foreach($mapelList as $mapel)
                                    {{-- Menampilkan nama unik, namun tetap mengirim ID sebagai referensi --}}
                                    <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Daftar ini sudah disaring agar tidak duplikat.</small>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Guru Pengajar</label>
                            <select name="guru_id" class="form-select" required>
                                <option value="">-- Pilih Guru --</option>
                                @foreach($guruList as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->nama }} ({{ $guru->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Simpan Jadwal</button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-4">Daftar Jadwal Tersimpan</h4>
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Hari / Jam</th>
                            <th>Pelajaran</th>
                            <th>Kelas</th>
                            <th>Guru</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwals as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $item->hari }}</strong><br>
                                    <small class="text-muted">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</small>
                                </td>
                                <td>{{ $item->mapel->nama ?? '-' }}</td>
                                <td>{{ $item->kelas->nama ?? '-' }}</td>
                                <td>{{ $item->guru->nama ?? '-' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.jadwal.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning text-white">Edit</a>
                                    <form action="{{ route('admin.jadwal.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus Jadwal?')">Hapus</button>
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