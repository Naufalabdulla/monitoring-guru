@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h4>Edit Materi</h4>
    <form action="{{ route('guru.materi.update', $materi->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Mata Pelajaran</label>
            <select name="mapel_id" class="form-select" disabled> @foreach($mapels as $m)
                    <option value="{{ $m->id }}" {{ $materi->mapel_id == $m->id ? 'selected' : '' }}>
                        {{ $m->nama }} </option>
                @endforeach
            </select>
            <input type="hidden" name="mapel_id" value="{{ $materi->mapel_id }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Materi</label>
            <input type="text" name="nama" value="{{ $materi->nama }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('guru.dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection