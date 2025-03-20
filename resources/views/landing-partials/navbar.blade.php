<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="/#beranda" class="{{ request()->url() == url('/') ? 'active' : '' }}">Home</a></li>
        <li><a href="/#tentang" class="{{ request()->url() == url('/#tentang') ? 'active' : '' }}">Tentang</a></li>
        <li><a href="/#layanan" class="{{ request()->url() == url('/#layanan') ? 'active' : '' }}">Layanan</a></li>
        <li><a href="/#testimoni" class="{{ request()->url() == url('/#testimoni') ? 'active' : '' }}">Testimoni</a></li>
 
        {{-- <li><a href="#portfolio">Portfolio</a></li> --}}
        <li><a href="/#tim" class="{{ request()->url() == url('/#tim') ? 'active' : '' }}">Tim</a></li>
        {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li><a href="#">Dropdown 1</a></li>
                <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Deep Dropdown 1</a></li>
                        <li><a href="#">Deep Dropdown 2</a></li>
                        <li><a href="#">Deep Dropdown 3</a></li>
                        <li><a href="#">Deep Dropdown 4</a></li>
                        <li><a href="#">Deep Dropdown 5</a></li>
                    </ul>
                </li>
                <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 3</a></li>
                <li><a href="#">Dropdown 4</a></li>
            </ul>
        </li> --}}
        <li><a href="/#hubungikami" class="{{ request()->url() == url('/#hubungikami') ? 'active' : '' }}">Hubungi Kami</a></li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

<a class="cta-btn" href="/#tentang">Memulai</a>
</div>
</header>