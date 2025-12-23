<!DOCTYPE html>
<html>
<head>
    <title>Monitoring Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Monitoring Guru</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a>
                <a class="nav-link" href="{{ route('guru.dashboard') }}">Guru</a>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>