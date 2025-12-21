@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-4">Tambah Kelas</h4>
                <form action="{{ route('admin.kelas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Kelas</label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: 10 IPA 1" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Tingkat</label>
                        <select name="tingkat" class="form-select" required>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary py-2">Simpan Kelas</button>
                        <a href="{{ route('admin.kelas.index') }}" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection