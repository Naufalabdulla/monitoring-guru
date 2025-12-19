<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kelas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            max-width: 400px;
        }

        label {
            display: block;
            margin-top: 12px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
        }

        button, a {
            margin-top: 14px;
            padding: 8px 12px;
            border: 1px solid #000;
            background: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        .error {
            color: red;
            margin-top: 6px;
            font-size: 13px;
        }
    </style>
</head>
<body>

    <h2>Tambah Kelas</h2>

    <form action="{{ route('kelas.store') }}" method="POST">
        @csrf

        <label>Nama Kelas</label>
        <!-- PENTING: name="namaKelas" -->
        <input 
            type="text" 
            name="namaKelas" 
            value="{{ old('namaKelas') }}"
            placeholder="Contoh: XI RPL 1"
            required
        >

        @error('namaKelas')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Simpan</button>
        <a href="{{ route('kelas.index') }}">Kembali</a>
    </form>

</body>
</html>
