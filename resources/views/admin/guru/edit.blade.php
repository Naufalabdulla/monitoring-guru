@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-4 text-primary">Kelola Akun Guru</h4>
                <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Guru</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $guru->nama) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $guru->email) }}" required>
                    </div>

                    <div class="p-3 bg-light rounded border mb-4">
                        <label class="form-label fw-bold">Reset Password (Jika Guru Lupa)</label>
                        <div class="input-group">
                            <input type="password" name="password" id="passInput" class="form-control" placeholder="Masukkan password baru di sini...">
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('admin.guru.index') }}" class="btn btn-light">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passInput = document.getElementById('passInput');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passInput.type === "password") {
            passInput.type = "text";
            eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            passInput.type = "password";
            eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
@endsection