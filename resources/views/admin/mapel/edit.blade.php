<<<<<<< HEAD
<form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
=======
@extends('layouts.master')
@section('content')
<form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">
>>>>>>> origin/main
    @csrf
    @method('PUT') <div class="mb-3">
        <label>Nama Mata Pelajaran</label>
        <input type="text" name="nama_mapel" class="form-control" value="{{ $mapel->nama_mapel }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Mapel</button>
<<<<<<< HEAD
</form>
=======
</form>
@endsection
>>>>>>> origin/main
