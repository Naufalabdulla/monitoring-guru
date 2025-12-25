@extends('layouts.master')
@section('content')
<div class="card shadow-sm border-0 col-md-6 mx-auto p-4">
    <h4 class="fw-bold mb-4">Edit Mata Pelajaran</h4>
    <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Mata Pelajaran</label>
            <input type="text" name="nama" class="form-control" value="{{ $mapel->nama }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tingkat (Kelas)</label>
            <select name="kelas_id" class="form-select" required>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ $mapel->kelas_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama }} (Kelas {{ $k->tingkat }})
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-warning text-white w-100">Perbarui Mapel</button>
    </form>
</div>
@endsection