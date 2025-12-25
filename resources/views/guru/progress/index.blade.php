@extends('layouts.master')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-primary mb-0">Progress: {{ $mapel->nama }}</h4>
                    <p class="text-muted small">Kelas: {{ $mapel->kelas->nama ?? 'N/A' }}</p>
                </div>
                <a href="{{ route('guru.dashboard') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="100">Pertemuan</th>
                            <th>Pilih Materi Pembelajaran</th>
                            <th class="text-center" width="120">Status</th>
                            <th>Catatan Pertemuan</th> {{-- Judul Kolom Baru --}}
                            <th class="text-center" width="80">Simpan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($progressItems as $item)
                            <tr>
                                <td class="fw-bold text-center">
                                    @if($item->pertemuan == 50) UTS
                                    @elseif($item->pertemuan == 99) UAS / Ujian Akhir
                                    @else Minggu {{ $item->pertemuan }}
                                    @endif
                                </td>
                                <td>
                                    <select name="materi_id" form="form-{{ $item->id }}" class="form-select form-select-sm">
                                        <option value="">-- Pilih Materi --</option>
                                        @foreach($materis as $materi)
                                            <option value="{{ $materi->id }}" {{ $item->materi_id == $materi->id ? 'selected' : '' }}>
                                                {{ $materi->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-inline-block">
                                        <input type="hidden" name="status" value="0" form="form-{{ $item->id }}">
                                        <input class="form-check-input" type="checkbox" form="form-{{ $item->id }}"
                                            name="status" value="1" {{ $item->status ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    {{-- Input Catatan Terhubung ke Form --}}
                                    <textarea name="catatan" form="form-{{ $item->id }}" 
                                              class="form-control form-control-sm" 
                                              rows="1" placeholder="Tambahkan catatan...">{{ $item->catatan }}</textarea>
                                </td>
                                <td class="text-center">
                                    <form id="form-{{ $item->id }}" action="{{ route('guru.progress.update', $item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-primary px-3 shadow-sm">
                                            <i class="bi bi-save"></i>
                                        </button>
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