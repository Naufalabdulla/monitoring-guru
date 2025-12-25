@extends('layouts.master')
@section('content')
<div class="card shadow-sm border-0 col-md-6 mx-auto p-4">
    <h4 class="fw-bold mb-4">Tambah Kelas</h4>
    <form action="{{ route('admin.kelas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Kelas</label>
            <input type="text" name="nama" class="form-control" placeholder="Contoh: 10 IPA 1" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tingkat</label>
            <select name="tingkat" class="form-select" required>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Simpan Kelas</button>
    </form>
</div>
@endsection