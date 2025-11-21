<!-- User Navbar Component -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <i class="fas fa-utensils text-primary me-2"></i>
            Wijaya Bakery
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard-user') ? 'active' : '' }}" href="{{ url('dashboard-user') }}">
                        <i class="fas fa-th-large me-1"></i> Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('kategori-list') ? 'active' : '' }}" href="{{ url('kategori-list') }}">
                        <i class="fas fa-tags me-1"></i> Kategori
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="btn btn-outline-primary me-2" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart me-1"></i> Keranjang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-success me-2" href="{{ route('user.profile') }}">
                            <i class="fas fa-user me-1"></i> Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-outline-primary me-2" href="{{ route('user.login.form') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
