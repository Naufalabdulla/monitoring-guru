<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kelas</title>
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

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid #000;
            text-decoration: none;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>

    <h2>Data Kelas</h2>

    <a href="{{ route('kelas.create') }}" class="btn">
        + Tambah Kelas
    </a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
            </tr>
        </thead>
        <tbody>
            <!-- tabel masih kosong -->
        </tbody>
    </table>

</body>
</html>
