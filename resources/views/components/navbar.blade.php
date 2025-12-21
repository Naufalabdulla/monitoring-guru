<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <i class="bi bi-person-check-fill me-2"></i>Monitoring Guru
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        @auth
          @if(Auth::user()->role == 'admin')
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.mapel.*') ? 'active' : '' }}"
                href="{{ route('admin.mapel.index') }}">Data Mapel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}"
                href="{{ route('admin.kelas.index') }}">Data Kelas</a>
            </li>
          
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.jadwal.index') }}">Jadwal</a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}"
                href="{{ route('guru.dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('guru.materi.*') ? 'active' : '' }}"
                href="{{ route('guru.materi.index') }}">Materi Saya</a>
            </li>
          @endif
        @endauth
      </ul>

      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
              data-bs-toggle="dropdown">
              <div
                class="bg-light text-primary rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                style="width: 30px; height: 30px; font-size: 12px; fw-bold: 700;">
                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
              </div>
              {{ Auth::user()->nama }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
              <li>
                <div class="dropdown-header">
                  <strong>Role: {{ ucfirst(Auth::user()->role) }}</strong>
                </div>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
                  href="{{ route('profile.edit') }}">
                  <i class="bi bi-person me-2"></i>Profil Saya
              </li>
              <li>
                <a class="dropdown-item text-danger" href="#"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="bi bi-box-arrow-right me-2"></i>Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>