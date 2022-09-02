<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ ($active === "dashboard") ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($active === "kriteria") ? 'active' : '' }}" href="/kriteria">
                    <span data-feather="settings"></span>
                    Manage Kriteria
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($active === "warga") ? 'active' : '' }}" href="/warga">
                    <span data-feather="user"></span>
                    Manage Warga
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ ($active === "alternatif") ? 'active' : '' }}" href="/alternatif">
                    <span data-feather="file-text"></span>
                    Manage Alternatif
                </a>
            </li> --}}
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>TOPSIS</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link {{ ($active === "matriks") ? 'active' : '' }}" href="/matriks">
                    <span data-feather="sliders"></span>
                    Matriks Awal
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($active === "normalisasi") ? 'active' : '' }}" href="/normalisasi">
                    <span data-feather="divide-square"></span>
                    Normalisasi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($active === "terbobot") ? 'active' : '' }}" href="/terbobot">
                    <span data-feather="git-merge"></span>
                    Normalisasi Terbobot
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($active === "solusi") ? 'active' : '' }}" href="/solusi">
                    <span data-feather="activity"></span>
                    Solusi Ideal Positif Negatif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($active === "preferensi") ? 'active' : '' }}" href="/preferensi">
                    <span data-feather="award"></span>
                    Preferensi
                </a>
            </li>
        </ul>
    </div>
</nav>
