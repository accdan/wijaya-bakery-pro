<aside class="main-sidebar elevation-4 sidebar-dark">
    <!-- Logo -->
    <a href="{{ url('dashboard-admin') }}" class="brand-link">
        <img loading="lazy" src="{{ asset('storage/image/logo1.png') }}" alt="Logo" class="brand-image">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('dashboard-admin') }}"
                        class="nav-link {{ request()->is('dashboard-admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Homepage -->
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Homepage</p>
                    </a>
                </li>

                <!-- Manajemen Menu (Dropdown) -->
                <li
                    class="nav-item {{ request()->is('mng-menu*') || request()->is('mng-kategori*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->is('mng-menu*') || request()->is('mng-kategori*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>
                            Manajemen Menu
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('mng-menu') }}"
                                class="nav-link {{ request()->is('mng-menu') || request()->is('mng-menu/*') ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Kelola Menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('mng-kategori') }}"
                                class="nav-link {{ request()->is('mng-kategori') || request()->is('mng-kategori/*') ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Kategori Menu</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Homepage Setting -->
                <li class="nav-item {{ request()->is('mng-hero*') || request()->is('mng-about*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->is('mng-hero*') || request()->is('mng-about*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Homepage Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('mng-hero') }}"
                                class="nav-link {{ request()->is('mng-hero') || request()->is('mng-hero/*') ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Landing Pict</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('mng-about') }}"
                                class="nav-link {{ request()->is('mng-about') || request()->is('mng-about/*') ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>About</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Sponsor -->
                <li class="nav-item">
                    <a href="{{ url('mng-sponsor') }}"
                        class="nav-link {{ request()->is('mng-sponsor*') ? 'active' : '' }}">
                        <i class="fas fa-handshake nav-icon"></i>
                        <p>Sponsor</p>
                    </a>
                </li>

                <!-- Pesanan -->
                <li class="nav-item">
                    <a href="{{ url('mng-pesanan') }}"
                        class="nav-link {{ request()->is('mng-pesanan*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart nav-icon"></i>
                        <p>Pesanan</p>
                    </a>
                </li>

                <!-- Grafik -->
                <li class="nav-item">
                    <a href="{{ url('mng-graph') }}" class="nav-link {{ request()->is('mng-graph*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Grafik</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<style>
    /* Variabel CSS untuk mudah kustomisasi */
    :root {
        --sidebar-bg-start: #2d3d56;
        --sidebar-bg-end: #1c2636;
        --sidebar-text: #f8f9fa;
        --sidebar-hover-bg: #3f4f6b;
        --sidebar-active-color: #28d07a;
        --sidebar-active-bg: rgba(40, 208, 122, 0.15);
        --sidebar-icon-color: #e0e0e0;
        --sidebar-icon-hover: #a3ffac;
    }

    /* Background sidebar */
    .main-sidebar.sidebar-dark {
        background: linear-gradient(180deg, var(--sidebar-bg-start), var(--sidebar-bg-end)) !important;
    }

    /* Brand link */
    .brand-link {
        background: linear-gradient(180deg, var(--sidebar-bg-start), var(--sidebar-bg-end)) !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        padding: 1rem !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .brand-image {
        max-width: 180px;
        max-height: 120px;
        object-fit: contain;
        opacity: 1 !important;
        float: none !important;
    }

    /* Nav link styling */
    .nav-sidebar .nav-link {
        padding: 12px 15px;
        font-size: 16px;
        color: var(--sidebar-text) !important;
        border-radius: 5px;
        margin: 2px 8px;
        transition: all 0.3s ease;
    }

    .nav-sidebar .nav-item:hover>.nav-link {
        background-color: var(--sidebar-hover-bg) !important;
    }

    /* Nav icon */
    .nav-sidebar .nav-link .nav-icon {
        font-size: 18px;
        color: var(--sidebar-icon-color);
        transition: color 0.3s ease;
        margin-right: 10px;
    }

    .nav-sidebar .nav-link:hover .nav-icon {
        color: var(--sidebar-icon-hover);
    }

    /* Active state - Main menu */
    .nav-sidebar .nav-link.active {
        color: var(--sidebar-active-color) !important;
        background-color: var(--sidebar-active-bg) !important;
        border-left: 4px solid var(--sidebar-active-color);
        font-weight: 600;
    }

    .nav-sidebar .nav-link.active .nav-icon {
        color: var(--sidebar-active-color) !important;
    }

    /* Submenu styling */
    .nav-treeview {
        padding-left: 0 !important;
    }

    .nav-treeview .nav-link {
        font-size: 15px;
        padding-left: 50px !important;
    }

    .nav-treeview .nav-icon {
        font-size: 10px !important;
    }

    /* Active state - Submenu */
    .nav-treeview .nav-link.active {
        background-color: rgba(40, 208, 122, 0.1) !important;
        border-left: 3px solid var(--sidebar-active-color);
        font-weight: 600;
    }

    /* Menu open state */
    .menu-open>.nav-link {
        background-color: rgba(255, 255, 255, 0.05) !important;
    }

    /* Dropdown arrow animation */
    .nav-link .right {
        transition: transform 0.3s ease;
    }

    .menu-open>.nav-link .right {
        transform: rotate(-90deg);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .brand-image {
            max-width: 140px;
            max-height: 90px;
        }

        .nav-sidebar .nav-link {
            font-size: 14px;
            padding: 10px 12px;
        }

        .nav-treeview .nav-link {
            font-size: 13px;
            padding-left: 40px !important;
        }
    }

    /* Scrollbar styling */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }
</style>
