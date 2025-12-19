@extends('layouts.app')

@section('content')
    <h2>Dashboard Guru</h2>
    <div class="row">
        @foreach($myMapels as $mapel)
            <div class="col-md-6 mb-3">
                <div class="card p-3">
                    <h5>{{ $mapel->nama }}</h5>
                    <hr>

                    <a href="{{ route('guru.materi.create', ['mapel_id' => $mapel->id]) }}"
                        class="btn btn-sm btn-outline-primary mb-3">
                        + Tambah Materi Baru
                    </a>

                    <h6>Daftar Materi:</h6>
                    <ul class="list-group">
                        @foreach($mapel->materis as $mt)
                            <li class="list-group-item d-flex justify-content-between">
                                {{ $mt->nama }}
                                <div class="btn-group">
                                    <a href="{{ route('guru.materi.edit', $mt->id) }}" class="btn btn-sm text-warning">Edit</a>

                                    <form action="{{ route('guru.materi.destroy', $mt->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm text-danger" onclick="return confirm('Hapus?')">X</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection