<form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
    @csrf
    @method('PUT') <div class="mb-3">
        <label>Nama Mata Pelajaran</label>
        <input type="text" name="nama_mapel" class="form-control" value="{{ $mapel->nama_mapel }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Mapel</button>
</form>