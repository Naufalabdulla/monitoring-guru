@extends('layouts.master')
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <h4 class="fw-bold mb-4">Daftar Kelas</h4>
        
        <form action="{{ url()->current() }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-3">
                <select name="tingkat" class="form-select form-select-sm">
                    <option value="">-- Semua Tingkat --</option>
                    <option value="10" {{ request('tingkat') == '10' ? 'selected' : '' }}>Tingkat 10</option>
                    <option value="11" {{ request('tingkat') == '11' ? 'selected' : '' }}>Tingkat 11</option>
                    <option value="12" {{ request('tingkat') == '12' ? 'selected' : '' }}>Tingkat 12</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="sort" class="form-select form-select-sm">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Nama (A-Z)</option>
                    <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Nama (Z-A)</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary btn-sm w-100">Filter</button>
            </div>
        </form>

        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th width="50">No</th>
                    <th>Nama Kelas</th>
                    <th>Tingkat</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelas as $index => $k)
                <tr>
                    <td>{{ $kelas->firstItem() + $index }}</td>
                    <td class="fw-bold">{{ $k->nama }}</td> {{-- Atribut -namaKelas --}}
                    <td><span class="badge bg-secondary">Tingkat {{ $k->tingkat }}</span></td>
                    <td class="text-center">
                        <a href="{{ route('admin.kelas.edit', $k->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 d-flex justify-content-center">{{ $kelas->appends(request()->input())->links() }}</div>
    </div>
</div>
@endsection