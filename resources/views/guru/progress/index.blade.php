@extends('layouts.master')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-primary mb-0">Progress: {{ $mapel->nama }}</h4>
                    <p class="text-muted small">Kelas: {{ $mapel->kelas->nama }}</p>
                </div>
                <a href="{{ route('guru.dashboard') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="150">Pertemuan</th>
                            <th>Topik / Materi Pembahasan</th>
                            <th class="text-center" width="150">Status Selesai</th>
                            <th class="text-center" width="100">Simpan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($progressItems as $item)
                            <tr>
                                <td class="fw-bold">{{ $item->pertemuan }}</td>
                                <td>
                                    <input type="text" form="form-{{ $item->id }}" name="materi"
                                        class="form-control form-control-sm" value="{{ $item->materi }}"
                                        placeholder="Input topik pembahasan...">
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-inline-block">
                                        <input class="form-check-input" type="checkbox" form="form-{{ $item->id }}"
                                            name="status" value="1" {{ $item->status ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <form id="form-{{ $item->id }}" action="{{ route('guru.progress.update', $item->id) }}"
                                        method="POST">
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection