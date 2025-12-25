@extends('layouts.master')
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <h4 class="fw-bold mb-4">Daftar Guru</h4>
        
        <form action="{{ url()->current() }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-4">
                <select name="sort" class="form-select form-select-sm">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Pendaftaran Terbaru</option>
                    <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Nama (A-Z)</option>
                    <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Nama (Z-A)</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary btn-sm w-100">Urutkan</button>
            </div>
        </form>

        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th width="50">No</th>
                    <th>Nama Guru</th>
                    <th>Email</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gurus as $index => $g)
                <tr>
                    <td>{{ $gurus->firstItem() + $index }}</td>
                    <td class="fw-bold">{{ $g->nama }}</td>
                    <td>{{ $g->email }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.guru.edit', $g->id) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 d-flex justify-content-center">{{ $gurus->appends(request()->input())->links() }}</div>
    </div>
</div>
@endsection