@extends('layouts.master')
@section('content')

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
@endsection