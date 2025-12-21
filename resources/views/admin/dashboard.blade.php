@extends('layouts.master')

@section('content')
    <div class="row mb-4 text-center">
        <div class="col-md-6">
            <div class="card p-3 bg-primary text-white">
                <h4>Total Guru: {{ $totalGuru }}</h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 bg-success text-white">
                <h4>Total Mapel: {{ $totalMapel }}</h4>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>Daftar Mapel</h4>
            <a href="{{ route('mapel.create') }}" class="btn btn-primary">+ Mapel</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Mapel</th>
                    <th>Tingkat</th>
                    <th>Guru</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mapels as $m)
                    @foreach($mapels as $m)
                        <tr>
                            <td>{{ $m->nama }}</td>
                            <td>{{ $m->tingkat_kelas }}</td>
                            <td>{{ $m->guru->nama ?? 'Belum Ada' }}</td>
                            <td>
                                <a href="{{ route('mapel.edit', $m->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('mapel.destroy', $m->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus mapel ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection