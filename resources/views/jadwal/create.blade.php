@extends('layouts.master')
@section('content')

    <h2 class="mb-5">Tambah Jadwal</h2>

    <form action="{{ route('admin.jadwal.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <select class="form-select" name="hari" id="hari" aria-label="Default select example">
                <option selected>Masukkan Hari</option>
                <option value="senin">Senin</option>
                <option value="selasa">Selasa</option>
                <option value="rabu">Rabu</option>
                <option value="kamis">Kamis</option>
                <option value="jumat">Jumat</option>
            </select>
        </div>

        <div class="row">
            <div class="col-6">
                <label for="jam_mulai" class="form-label">jam mulai</label>
                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" placeholder="HH-MM">
            </div>
            <div class="col-6">
                <label for="jam_selesai" class="form-label">jam selesai</label>
                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" placeholder="HH-MM">
            </div>
            <div class="col-6"><label for="kelas_id">Kelas</label>
                {{-- <select name="kelas_id" id="kelas_id" class="form-select">
                    <option selected>-</option>
                    <option value="10">ipa 10</option>
                </select> --}}
            </div>
            <div class="col-6"><label for="mapel_id">Mata Pelajaran</label>
                {{-- <select name="mapel_id" id="mapel_id" class="form-select">
                    <option selected>-</option>
                    <option value="ipa">ipa</option>
                </select> --}}
            </div>
        </div>

        <div class="mb-3">
            <label for="guru_id" class="form-label">Guru</label>
            {{-- <select name="guru_id" id="guru_id" class="form-select">
                <option selected>-</option>
                <option value="hermawan">hermawan</option>
            </select> --}}
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection