@extends('layouts.master')
@section('title', 'jadwal')
@section('content')

    <h2>Jadwal Guru</h2>
    <div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Manajemen Jadwal</h4>
            <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary">+ Tambah jadwal</a>
        </div>

        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>jam</th>
                    <th>Pelajaran</th>
                    <th>kelas</th>
                    <th>guru</th>
                    <th class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwals as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="fw-bold">{{ $item->nama }}</td>
                    <td><span class="">jadwal {{ $item->tingkat }}</span></td>
                    <td class="text-end pe-4">
                        <a href="{{ route('admin.jadwal.edit', $item->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                        <form action="{{ route('admin.jadwal.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus Jadwal?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    
@endsection