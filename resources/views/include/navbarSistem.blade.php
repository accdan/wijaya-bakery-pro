<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" style="position: relative;">
                <i class="far fa-bell"></i>
                @php
                    // Get recent orders (last 24 hours) as notifications
                    $recentOrders = \App\Models\Pesanan::where('created_at', '>=', now()->subHours(24))
                        ->select('nama_pemesan', 'created_at', 'total_harga')
                        ->groupBy('nama_pemesan', 'created_at', 'total_harga')
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();
                    $notifCount = $recentOrders->count();
                @endphp
                @if($notifCount > 0)
                    <span class="badge badge-warning navbar-badge">{{ $notifCount }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 320px;">
                <span class="dropdown-item dropdown-header"
                    style="background: linear-gradient(135deg, #8B4513, #5D3A1A); color: white;">
                    <i class="fas fa-bell mr-2"></i>{{ $notifCount }} Notifikasi Baru
                </span>
                <div class="dropdown-divider"></div>

                @forelse($recentOrders as $order)
                    <a href="{{ route('admin.pesanan.index') }}" class="dropdown-item" style="padding: 12px 15px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div
                                style="width: 40px; height: 40px; background: linear-gradient(135deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #343a40;">{{ $order->nama_pemesan }}</div>
                                <div style="font-size: 12px; color: #6c757d;">
                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }} •
                                    {{ $order->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                @empty
                    <div class="dropdown-item text-center text-muted" style="padding: 20px;">
                        <i class="fas fa-inbox" style="font-size: 24px; opacity: 0.5; margin-bottom: 8px;"></i>
                        <br>Tidak ada notifikasi baru
                    </div>
                @endforelse

                <a href="{{ route('admin.pesanan.index') }}" class="dropdown-item dropdown-footer"
                    style="background: #f8f9fa; text-align: center; font-weight: 500;">
                    <i class="fas fa-eye mr-1"></i>Lihat Semua Pesanan
                </a>
            </div>
        </li>

        <!-- Quick Stats -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-chart-line"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 280px; padding: 0;">
                <span class="dropdown-item dropdown-header"
                    style="background: linear-gradient(135deg, #007bff, #0056b3); color: white;">
                    <i class="fas fa-chart-bar mr-2"></i>Statistik Hari Ini
                </span>
                @php
                    $todayOrders = \App\Models\Pesanan::whereDate('created_at', today())->count();
                    $todayRevenue = \App\Models\Pesanan::whereDate('created_at', today())->sum('total_harga');
                    $lowStockItems = \App\Models\Menu::where('stok', '<', 10)->count();
                @endphp
                <div style="padding: 15px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <span style="color: #6c757d;">Pesanan</span>
                        <span style="font-weight: 600; color: #343a40;">{{ $todayOrders }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <span style="color: #6c757d;">Pendapatan</span>
                        <span style="font-weight: 600; color: #28a745;">Rp
                            {{ number_format($todayRevenue, 0, ',', '.') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #6c757d;">Stok Rendah</span>
                        <span
                            style="font-weight: 600; color: {{ $lowStockItems > 0 ? '#dc3545' : '#28a745' }};">{{ $lowStockItems }}
                            item</span>
                    </div>
                </div>
                <a href="{{ url('dashboard-admin') }}" class="dropdown-item dropdown-footer"
                    style="background: #f8f9fa; text-align: center; font-weight: 500;">
                    <i class="fas fa-tachometer-alt mr-1"></i>Dashboard
                </a>
            </div>
        </li>

        <!-- User Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user-circle"></i>
                <span class="ml-1">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ url('dashboard-admin') }}" class="dropdown-item">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item text-danger" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </div>
        </li>
    </ul>
</nav>



