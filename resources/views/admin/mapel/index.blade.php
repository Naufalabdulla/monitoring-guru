<div class="container">
    <h1>Daftar Mata Pelajaran</h1>
    <a href="{{ route('mapel.create') }}" class="btn btn-primary mb-3">Tambah Mapel</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mata Pelajaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mapels as $m)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $m->nama_mapel }}</td>
                <td>
                    <a href="{{ route('mapel.edit', $m->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    
                    <form action="{{ route('mapel.destroy', $m->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>