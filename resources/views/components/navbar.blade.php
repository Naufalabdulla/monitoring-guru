<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-black">
  <div class="container-fluid">
    <a class="navbar-brand" href="/admin/dashboard">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        {{-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Guru</a>
        </li> --}}
        <li class="nav-item">
          <a class="nav-link" href="/admin/mapel">Mapel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/admin/kelas">Kelas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/admin/jadwal">Jadwal</a>
        </li>
      </ul>
    </div>
    <div class="dropdown ms-auto">
      <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="profileDropdown"
        role="button" data-bs-toggle="dropdown" aria-expanded="true">
        <span class="me-2 fw-medium text-dark">John Doe</span>
        <img src="../../../public/img/profile.jpg" alt="Profile" class="rounded-circle" width="40" height="40">
      </a>

      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="profileDropdown">
        <li>
          <form action="{{ route('logout') }}" method="post">
            <button class="dropdown-item text-danger" type="submit">
              Logout
          </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>