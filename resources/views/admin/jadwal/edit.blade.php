@extends('layouts.master')
@section('content')
<div class="card shadow-sm border-0 col-md-8 mx-auto p-4">
    <h4 class="fw-bold mb-4">Edit Jadwal</h4>
    <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Hari</label>
                <select name="hari" class="form-select" required>
                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $h)
                        <option value="{{ $h }}" @selected($jadwal->hari == $h)>{{ $h }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" value="{{ substr($jadwal->jam_mulai, 0, 5) }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" value="{{ substr($jadwal->jam_selesai, 0, 5) }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Mata Pelajaran</label>
            <select name="mapel_id" class="form-select">
                @foreach($mapelList as $m)
                    <option value="{{ $m->id }}" @selected($jadwal->mapel_id == $m->id)>{{ $m->nama }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-warning text-white w-100 fw-bold">Update Jadwal</button>
    </form>
</div>
@endsection