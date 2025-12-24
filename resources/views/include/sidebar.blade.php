<aside class="main-sidebar elevation-4 sidebar-dark">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel">
            <div class="user-avatar">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="user-info">
                <div class="user-name">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Section: Main -->
                <li class="nav-header">MAIN</li>

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
                    <a href="{{ url('/') }}" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Lihat Website <i class="fas fa-external-link-alt right" style="font-size: 10px;"></i></p>
                    </a>
                </li>

                <!-- Section: Produk -->
                <li class="nav-header">PRODUK</li>

                <!-- Manajemen Menu (Dropdown) -->
                <li
                    class="nav-item {{ request()->is('mng-menu*') || request()->is('mng-kategori*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->is('mng-menu*') || request()->is('mng-kategori*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bread-slice"></i>
                        <p>
                            Menu Produk
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('mng-menu') }}"
                                class="nav-link {{ request()->is('mng-menu') || request()->is('mng-menu/*') ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Daftar Menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('mng-kategori') }}"
                                class="nav-link {{ request()->is('mng-kategori') || request()->is('mng-kategori/*') ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Pesanan -->
                <li class="nav-item">
                    <a href="{{ url('mng-pesanan') }}"
                        class="nav-link {{ request()->is('mng-pesanan*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-bag nav-icon"></i>
                        <p>Pesanan</p>
                    </a>
                </li>

                <!-- Section: Website -->
                <li class="nav-header">WEBSITE</li>

                <!-- Homepage Setting -->
                <li class="nav-item {{ request()->is('mng-hero*') || request()->is('mng-about*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->is('mng-hero*') || request()->is('mng-about*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-palette"></i>
                        <p>
                            Tampilan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('mng-hero') }}"
                                class="nav-link {{ request()->is('mng-hero') || request()->is('mng-hero/*') ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Hero Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('mng-about') }}"
                                class="nav-link {{ request()->is('mng-about') || request()->is('mng-about/*') ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>About & Contact</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Sponsor -->
                <li class="nav-item">
                    <a href="{{ url('mng-sponsor') }}"
                        class="nav-link {{ request()->is('mng-sponsor*') ? 'active' : '' }}">
                        <i class="fas fa-handshake nav-icon"></i>
                        <p>Partner</p>
                    </a>
                </li>


                <!-- Section: Admin -->
                <li class="nav-header">ADMIN</li>

                <!-- User Management -->
                <li class="nav-item">
                    <a href="{{ url('mng-user') }}" class="nav-link {{ request()->is('mng-user*') ? 'active' : '' }}">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Kelola User</p>
                    </a>
                </li>

                <!-- Role Management -->
                <li class="nav-item">
                    <a href="{{ url('mng-role') }}" class="nav-link {{ request()->is('mng-role*') ? 'active' : '' }}">
                        <i class="fas fa-user-shield nav-icon"></i>
                        <p>Kelola Role</p>
                    </a>
                </li>

                <!-- Section: System -->
                <li class="nav-header">SISTEM</li>

                <!-- System Settings -->
                <li class="nav-item">
                    <a href="{{ url('mng-system') }}"
                        class="nav-link {{ request()->is('mng-system*') ? 'active' : '' }}">
                        <i class="fas fa-cogs nav-icon"></i>
                        <p>System Settings</p>
                    </a>
                </li>

                <!-- Trash Management -->
                <li class="nav-item">
                    <a href="{{ url('mng-trash') }}" class="nav-link {{ request()->is('mng-trash*') ? 'active' : '' }}">
                        <i class="fas fa-trash-alt nav-icon"></i>
                        <p>Trash</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<style>
    /* ============================================
       🥐 Bakery Admin Sidebar - Warm & Professional
       ============================================ */

    /* Bakery Theme Variables - Light & Fresh */
    :root {
        --sidebar-bg: linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%);
        --sidebar-text: #334155;
        --sidebar-hover: rgba(59, 130, 246, 0.1);
        --sidebar-active: #3b82f6;
        --sidebar-active-bg: rgba(59, 130, 246, 0.15);
        --sidebar-icon: #3b82f6;
        --sidebar-divider: rgba(59, 130, 246, 0.15);
    }

    /* Main Sidebar */
    .main-sidebar.sidebar-dark {
        background: var(--sidebar-bg) !important;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.2);
    }

    /* Brand Link */
    .brand-link {
        background: rgba(255, 255, 255, 0.8) !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        padding: 1.25rem !important;
        border-bottom: 1px solid var(--sidebar-divider) !important;
    }

    .brand-image {
        max-width: 140px;
        max-height: 100px;
        object-fit: contain;
        opacity: 1 !important;
        float: none !important;
        filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
        transition: transform 0.3s ease;
    }

    .brand-link:hover .brand-image {
        transform: scale(1.05);
    }

    /* User Panel */
    .user-panel {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        margin: 10px 10px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        border: 1px solid var(--sidebar-divider);
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, var(--sidebar-active), #60a5fa);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }

    .user-name {
        color: var(--sidebar-text);
        font-weight: 600;
        font-size: 0.95rem;
    }

    .user-role {
        color: var(--sidebar-active);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Nav Headers */
    .nav-header {
        color: var(--sidebar-active) !important;
        text-transform: uppercase;
        font-size: 0.7rem !important;
        letter-spacing: 1px;
        padding: 16px 16px 8px !important;
        font-weight: 700;
        opacity: 0.9;
    }

    /* Nav Links */
    .nav-sidebar .nav-link {
        padding: 12px 16px;
        font-size: 0.9rem;
        color: var(--sidebar-text) !important;
        border-radius: 8px;
        margin: 2px 10px;
        transition: all 0.3s ease;
    }

    .nav-sidebar .nav-item:hover>.nav-link {
        background-color: var(--sidebar-hover) !important;
        transform: translateX(4px);
    }

    /* Nav Icons */
    .nav-sidebar .nav-link .nav-icon {
        font-size: 1rem;
        color: var(--sidebar-icon);
        transition: all 0.3s ease;
        margin-right: 12px;
        width: 20px;
        text-align: center;
    }

    .nav-sidebar .nav-link:hover .nav-icon {
        color: var(--sidebar-text);
        transform: scale(1.1);
    }

    /* Active State */
    .nav-sidebar .nav-link.active {
        color: var(--sidebar-text) !important;
        background: var(--sidebar-active-bg) !important;
        border-left: 3px solid var(--sidebar-active);
        font-weight: 600;
    }

    .nav-sidebar .nav-link.active .nav-icon {
        color: var(--sidebar-active) !important;
    }

    /* Submenu styling */
    .nav-treeview {
        padding-left: 0 !important;
        background: rgba(59, 130, 246, 0.05);
        margin: 0 10px;
        border-radius: 8px;
    }

    .nav-treeview .nav-link {
        font-size: 0.85rem;
        padding-left: 45px !important;
        margin: 0;
        border-radius: 0;
    }

    .nav-treeview .nav-link:first-child {
        border-radius: 8px 8px 0 0;
    }

    .nav-treeview .nav-link:last-child {
        border-radius: 0 0 8px 8px;
    }

    .nav-treeview .nav-icon {
        font-size: 6px !important;
    }

    /* Active state - Submenu */
    .nav-treeview .nav-link.active {
        background: rgba(212, 165, 116, 0.1) !important;
        border-left: 2px solid var(--sidebar-active);
    }

    /* Menu open state */
    .menu-open>.nav-link {
        background: rgba(59, 130, 246, 0.08) !important;
    }

    /* Dropdown arrow animation */
    .nav-link .right {
        transition: transform 0.3s ease;
    }

    .menu-open>.nav-link .right {
        transform: rotate(-90deg);
    }

    /* Scrollbar */
    .sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.03);
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: var(--sidebar-divider);
        border-radius: 10px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: var(--sidebar-active);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .brand-image {
            max-width: 100px;
            max-height: 70px;
        }

        .user-panel {
            padding: 12px 15px;
        }

        .nav-sidebar .nav-link {
            font-size: 0.85rem;
            padding: 10px 14px;
        }
    }
</style>