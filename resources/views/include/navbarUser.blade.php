    <nav class="navbar navbar-expand-lg floating-navbar">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-warning" href="#">
                🍳 Dapur <span class="text-danger">Indonesia</span>
            </a>

            <!-- Custom Toggler -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <i class="bi bi-list fs-2 text-dark"></i>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav align-items-lg-center gap-2">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/homepage') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard-user') }}">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/kategori-list') }}">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Resep</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Profil</a></li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




