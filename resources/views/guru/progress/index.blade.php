@extends('layouts.master')

@section('content')
<div class="container">
    <h3 class="mb-4">Progress Pembelajaran</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($progresses->isEmpty())
        <div class="alert alert-info">
            Belum ada progress pembelajaran.
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kelas</th>
                            <th>Mapel</th>
                            <th>Materi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($progresses as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ $p->jadwal->kelas->nama ?? '-' }}</td>
                                <td>{{ $p->jadwal->mapel->nama ?? '-' }}</td>
                                <td>{{ $p->materi }}</td>
                                <td>
                                    <span class="badge 
                                        @if($p->status === 'selesai') bg-success
                                        @elseif($p->status === 'proses') bg-warning
                                        @else bg-secondary
                                        @endif">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('guru.progress.edit', $p->id) }}" 
                                       class="btn btn-sm btn-warning">
                                        Update
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
