@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white p-3">
                <h5 class="mb-0 fw-bold">Update Detail Pertemuan {{ $progress->pertemuan }}</h5>
            </div>
            <div class="card-body p-4">
                <p class="mb-4">
                    <span class="badge bg-light text-dark border">Kelas: {{ $progress->mapel->kelas->nama }}</span>
                    <span class="badge bg-light text-dark border">Mapel: {{ $progress->mapel->nama }}</span>
                </p>

                <form method="POST" action="{{ route('guru.progress.update', $progress->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Materi</label>
                        <select name="materi_id" class="form-select">
                            <option value="">-- Belum Ada Materi --</option>
                            @foreach($materis as $materi)
                                <option value="{{ $materi->id }}" {{ $progress->materi_id == $materi->id ? 'selected' : '' }}>
                                    {{ $materi->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status Pembelajaran</label>
                        <select name="status" class="form-select">
                            <option value="0" {{ $progress->status == 0 ? 'selected' : '' }}>Belum Selesai</option>
                            <option value="1" {{ $progress->status == 1 ? 'selected' : '' }}>Selesai (Tercapai)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Catatan Guru (Opsional)</label>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Contoh: Siswa aktif berdiskusi...">{{ $progress->catatan }}</textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('guru.progress.index', ['mapel_id' => $progress->mapel_id]) }}" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection