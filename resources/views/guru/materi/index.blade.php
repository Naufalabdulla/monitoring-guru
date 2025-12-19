<div class="container">
    <h1>Daftar Materi Saya</h1>
    <a href="{{ route('guru.materi.create') }}" class="btn btn-success mb-3">Buat Materi Baru</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Judul Materi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materis as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->mapel->nama_mapel }}</td> <td>{{ $row->judul_materi }}</td>
                <td>
                    <a href="{{ route('guru.materi.edit', $row->id) }}" class="btn btn-info btn-sm">Edit</a>
                    
                    <form action="{{ route('guru.materi.destroy', $row->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus materi ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>