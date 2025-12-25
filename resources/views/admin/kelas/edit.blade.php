@extends('layouts.master')
@section('content')
<div class="card shadow-sm border-0 col-md-6 mx-auto p-4">
    <h4 class="fw-bold mb-4">Edit Kelas</h4>
    <form action="{{ route('admin.kelas.update', $kela->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Kelas</label>
            <input type="text" name="nama" class="form-control" value="{{ $kela->nama }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tingkat</label>
            <select name="tingkat" class="form-select">
                <option value="10" {{ $kela->tingkat == '10' ? 'selected' : '' }}>10</option>
                <option value="11" {{ $kela->tingkat == '11' ? 'selected' : '' }}>11</option>
                <option value="12" {{ $kela->tingkat == '12' ? 'selected' : '' }}>12</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning text-white w-100">Update Kelas</button>
    </form>
</div>
@endsection