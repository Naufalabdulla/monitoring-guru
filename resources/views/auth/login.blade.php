<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Monitoring Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0091ffff 0%, #b4c1ffff 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        .login-card h2 {
            font-weight: 700;
            color: #333;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .btn-login {
            background: #0088ffff;
            border: none;
            padding: 0.8rem;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-login:hover {
            background: #5a67d8;
            transform: translateY(-2px);
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #667eea;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Monitoring Guru</h2>
    <p class="text-center text-muted">Silakan masuk ke akun Anda</p>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        
        @if ($errors->any())
            <div class="alert alert-danger py-2">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Alamat Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                   placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" 
                   placeholder="Masukkan password" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-login">Masuk Sekarang</button>
        </div>
    </form>
    
    <div class="text-center mt-4">
        <small class="text-muted">&copy; 2025 Aplikasi Monitoring Guru</small>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>