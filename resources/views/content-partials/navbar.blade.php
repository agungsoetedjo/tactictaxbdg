<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="/dashboard"><img width="45" height="35" src="{{ asset("assets/img/logo.png") }}" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav me-auto">
          @auth
          {{-- @if (Auth::user()->role === 'admin') --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Data
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item {{ Request::is('kategori') ? 'active' : '' }}" href="/kategori">Kategori</a></li>
              <li><a class="dropdown-item {{ Request::is('layanan') ? 'active' : '' }}" href="/layanan">Layanan</a></li>
              <li><a class="dropdown-item {{ Request::is('testimoni') ? 'active' : '' }}" href="/testimoni">Testimoni</a></li>
              <li><a class="dropdown-item {{ Request::is('kontak') ? 'active' : '' }}" href="/kontak">Kontak</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('useraccount') ? 'active' : '' }}" href="/useraccount">User Account</a>
          </li>
          {{-- @endif --}}
          @endauth
          {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown link
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li> --}}
        </ul>
        <ul class="navbar-nav">
          @auth
          <li class="nav-item">
            <a class="nav-link">Selamat datang, <b>{{ auth()->user()->username }}</b> </a>
          </li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
            </form>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
 