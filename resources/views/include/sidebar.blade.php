<aside class="main-sidebar elevation-4" style="background: linear-gradient(180deg, #2d3d56, #1c2636);">
    <!-- Logo -->
    <a href="{{ url('dashboard-admin') }}" class="brand-link d-flex justify-content-center align-items-center" style="background: linear-gradient(180deg, #2d3d56, #1c2636);">
        <img src="{{ asset('image/logo1.png') }}" alt="Logo Resep" class="brand-image" style="max-width: 180px; max-height: 120px; object-fit: contain;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('dashboard-admin') }}" class="nav-link {{ request()->is('dashboard') ? 'active-custom' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ request()->is('dashboard') ? 'active-custom' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Homepage</p>
                    </a>
                </li>

                <!-- Manajemen Menu (Dropdown) -->
                <li class="nav-item has-treeview {{ request()->is('menu*') || request()->is('kategori*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('menu*') || request()->is('kategori*') ? 'active-custom' : '' }}">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>
                            Manajemen Menu
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('menu') }}" class="nav-link {{ request()->is('menu*') ? 'active-custom-sub' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Kelola Menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kategori') }}" class="nav-link {{ request()->is('kategori*') ? 'active-custom-sub' : '' }}">
                                <i class="fas fa-th-large nav-icon"></i>
                                <p>Kategori Menu</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Homepage Setting -->
                <li class="nav-item has-treeview {{ request()->is('hero') || request()->is('about_contact') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('hero') || request()->is('about_contact') ? 'active-custom' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Homepage Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('hero') }}" class="nav-link {{ request()->is('hero') ? 'active-custom-sub' : '' }}">
                                <i class="fas fa-image nav-icon"></i>
                                <p>Landing Pict</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('about_contact') }}" class="nav-link {{ request()->is('about_contact') ? 'active-custom-sub' : '' }}">
                                <i class="fas fa-info-circle nav-icon"></i>
                                <p>About</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Sponsor -->
                <li class="nav-item">
                    <a href="{{ url('sponsor') }}" class="nav-link {{ request()->is('sponsor') ? 'active-custom' : '' }}">
                        <i class="fas fa-handshake nav-icon"></i>
                        <p>Sponsor</p>
                    </a>
                </li>

                <!-- Promo -->
                <li class="nav-item">
                    <a href="{{ url('promo') }}" class="nav-link {{ request()->is('promo') ? 'active-custom' : '' }}">
                        <i class="fas fa-gift nav-icon"></i>
                        <p>Promo</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<style>
    .nav-sidebar .nav-item:hover {
    background-color: #3f4f6b;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.nav-sidebar .nav-link .nav-icon {
    font-size: 18px;
    color: #e0e0e0;
    transition: color 0.3s ease;
}

.nav-sidebar .nav-link:hover .nav-icon {
    color: #a3ffac;
}

.nav-sidebar .nav-link {
    padding: 12px 15px;
    font-size: 16px;
    color: #f8f9fa;
}

.nav-treeview .nav-link {
    font-size: 15px;
    padding-left: 30px;
}

/* Aktif menu */
.active-custom {
    color: #28d07a !important;
    background-color: rgba(40, 208, 122, 0.15) !important;
    border-left: 4px solid #28d07a;
    font-weight: 600;
}

/* Aktif submenu */
.active-custom-sub {
    color: #28d07a !important;
    background-color: rgba(40, 208, 122, 0.1) !important;
    font-weight: 600;
    border-left: 3px solid #28d07a;
}

/* Ikon */
.nav-link.active-custom .nav-icon,
.nav-link.active-custom-sub .nav-icon {
    color: #28d07a !important;
}

</style>