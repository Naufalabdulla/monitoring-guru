<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Jadwal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>

    <h2>Jadwal Guru</h2>
    <a href="{{ route('jadwal.create') }}"
        style="display:inline-block;margin-bottom:12px;
          padding:8px 12px;border:1px solid #000;text-decoration:none;">
        + Tambah Jadwal
    </a>
    <table>
        <thead>
            <tr>
                <th>Hari</th>
                <th>Jam</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
            </tr>
        </thead>
        <tbody>
            <!-- tabel masih kosong -->
        </tbody>
    </table>

</body>

</html>