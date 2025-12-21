@extends('layouts.master')

@section('content')
<div class="container">
    <h3>Mapel yang Saya Ajar</h3>

    <div class="card mt-3">
        <div class="card-body">
            @if($mapels->count() == 0)
                <p class="text-muted">Belum ada mapel yang terhubung ke jadwal mengajar.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mapel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mapels as $i => $m)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $m->nama }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
