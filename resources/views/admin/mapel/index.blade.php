@extends('layouts.master')
@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4">Daftar Mata Pelajaran</h4>

            {{-- Form Filter & Sort --}}
            <form action="{{ url()->current() }}" method="GET" class="row g-2 mb-4">
                <div class="col-md-3">
                    <select name="tingkat" class="form-select form-select-sm">
                        <option value="">-- Semua Tingkat --</option>
                        <option value="10" {{ request('tingkat') == '10' ? 'selected' : '' }}>Kelas 10</option>
                        <option value="11" {{ request('tingkat') == '11' ? 'selected' : '' }}>Kelas 11</option>
                        <option value="12" {{ request('tingkat') == '12' ? 'selected' : '' }}>Kelas 12</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="sort" class="form-select form-select-sm">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Abjad (A-Z)</option>
                        <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Abjad (Z-A)</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary btn-sm w-100">Terapkan</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Tingkat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mapels as $index => $m)
                            <tr>
                                <td>{{ $mapels->firstItem() + $index }}</td>
                                <td class="fw-bold">{{ $m->nama }}</td> {{-- Atribut -namaMapel --}}
                                <td>
                                    <span class="badge bg-info text-dark">SMA Kelas {{ $m->kelas->tingkat ?? '-' }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.mapel.edit', $m->id) }}"
                                        class="btn btn-sm btn-outline-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $mapels->appends(request()->input())->links() }} {{-- Pagination tetap terjaga saat filter aktif --}}
            </div>
        </div>
    </div>
@endsection