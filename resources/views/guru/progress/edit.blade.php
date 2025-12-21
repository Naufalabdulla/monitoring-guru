<h3>Update Progress</h3>

<p>
<b>Kelas:</b> {{ $progress->jadwal->kelas->nama ?? '-' }} <br>
<b>Mapel:</b> {{ $progress->jadwal->mapel->nama ?? '-' }}
</p>

<form method="POST" action="{{ route('guru.progress.update', $progress->id) }}">
    @csrf
    @method('PUT')

    <label>Tanggal</label><br>
    <input type="date" name="tanggal" value="{{ $progress->tanggal }}"><br><br>

    <label>Materi</label><br>
    <input type="text" name="materi" value="{{ $progress->materi }}"><br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="belum" {{ $progress->status=='belum'?'selected':'' }}>Belum</option>
        <option value="proses" {{ $progress->status=='proses'?'selected':'' }}>Proses</option>
        <option value="selesai" {{ $progress->status=='selesai'?'selected':'' }}>Selesai</option>
    </select><br><br>

    <label>Catatan</label><br>
    <textarea name="catatan">{{ $progress->catatan }}</textarea><br><br>

    <button type="submit">Simpan</button>
</form>
