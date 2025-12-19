<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        label {
            display: block;
            margin-top: 12px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
        }

        button, a {
            margin-top: 14px;
            padding: 8px 12px;
            border: 1px solid #000;
            background: #fff;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>Tambah Jadwal</h2>

    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf

        <label>Hari</label>
        <select>
            <option>Senin</option>
            <option>Selasa</option>
            <option>Rabu</option>
            <option>Kamis</option>
            <option>Jumat</option>
        </select>

        <label>Jam</label>
        <input type="text" placeholder="08:00 - 10:00">

        <label>Kelas</label>
        <input type="text" placeholder="10 IPA 1">

        <label>Mata Pelajaran</label>
        <input type="text" placeholder="Biologi">

        <label>Guru</label>
        <input type="text" placeholder="Pak Budi">

        <button type="submit">Simpan</button>
        <a href="{{ route('jadwal.index') }}">Kembali</a>
    </form>

</body>
</html>
