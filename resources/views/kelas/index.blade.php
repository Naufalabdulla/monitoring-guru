<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kelas</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background: #f4f4f4; }
        .btn { padding: 8px 12px; border: 1px solid #000; text-decoration: none; }
    </style>
</head>
<body>

<h2>Data Kelas</h2>

<a href="{{ route('kelas.create') }}" class="btn">+ Tambah Kelas</a>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kelas</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kelas as $i => $k)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $k['namaKelas'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2">Belum ada data kelas</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
