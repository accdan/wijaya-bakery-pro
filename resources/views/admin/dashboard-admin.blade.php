<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard || Wijaya Bakery Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/logo1.png') }}">

    <!-- Preconnect -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --bakery-primary: #8B4513;
            --bakery-primary-light: #A0522D;
            --bakery-secondary: #D2691E;
            --bakery-accent: #DEB887;
            --bakery-warm: #F5DEB3;
            --bakery-bg: #FDF8F3;
        }

        body {
            font-family: 'Source Sans Pro', sans-serif !important;
            background-color: var(--bakery-bg);
        }

        .content-wrapper {
            background-color: var(--bakery-bg);
        }

        /* Clean stat cards - Bakery Theme */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 2px 8px rgba(139, 69, 19, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: none;
            border-left: 4px solid;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(139, 69, 19, 0.12);
        }

        .stat-card.primary {
            border-left-color: var(--bakery-primary);
        }

        .stat-card.success {
            border-left-color: #5D8A4D;
        }

        .stat-card.warning {
            border-left-color: var(--bakery-secondary);
        }

        .stat-card.info {
            border-left-color: var(--bakery-accent);
        }

        .stat-card .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: white;
        }

        .stat-card.primary .stat-icon {
            background: linear-gradient(135deg, var(--bakery-primary), var(--bakery-primary-light));
        }

        .stat-card.success .stat-icon {
            background: linear-gradient(135deg, #5D8A4D, #4A7040);
        }

        .stat-card.warning .stat-icon {
            background: linear-gradient(135deg, var(--bakery-secondary), #B8860B);
        }

        .stat-card.info .stat-icon {
            background: linear-gradient(135deg, var(--bakery-accent), #C4A87C);
        }

        .stat-card .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4A3728;
        }

        .stat-card .stat-label {
            font-size: 0.8rem;
            color: #8B7355;
            margin-bottom: 0;
        }

        /* Clean cards - Bakery */
        .dashboard-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(139, 69, 19, 0.08);
            border: none;
            overflow: hidden;
        }

        .dashboard-card .card-header {
            background: linear-gradient(135deg, var(--bakery-bg) 0%, #FAF3EB 100%);
            border-bottom: 1px solid rgba(139, 69, 19, 0.1);
            padding: 0.875rem 1.25rem;
        }

        .dashboard-card .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: var(--bakery-primary);
            font-size: 0.95rem;
        }

        .dashboard-card .card-body {
            padding: 1rem;
        }

        /* Quick actions */
        .quick-action {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            background: #f8f9fa;
            transition: all 0.2s ease;
            text-decoration: none;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .quick-action:hover {
            background: #e9ecef;
            color: #212529;
            text-decoration: none;
        }

        .quick-action i {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            font-size: 0.875rem;
        }

        /* Low stock alert */
        .low-stock-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .low-stock-item:last-child {
            border-bottom: none;
        }

        .stock-badge {
            background: #dc3545;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Top menu list */
        .top-menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .top-menu-item:last-child {
            border-bottom: none;
        }

        .top-menu-rank {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
            margin-right: 0.75rem;
        }

        .top-menu-item:nth-child(1) .top-menu-rank {
            background: #ffd700;
            color: #856404;
        }

        .top-menu-item:nth-child(2) .top-menu-rank {
            background: #c0c0c0;
            color: #495057;
        }

        .top-menu-item:nth-child(3) .top-menu-rank {
            background: #cd7f32;
            color: white;
        }

        /* Summary cards in chart section - Bakery */
        .summary-stat {
            text-align: center;
            padding: 0.875rem;
            background: linear-gradient(135deg, var(--bakery-bg) 0%, #FAF3EB 100%);
            border-radius: 10px;
            border: 1px solid rgba(139, 69, 19, 0.08);
        }

        .summary-stat .value {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--bakery-primary);
        }

        .summary-stat .label {
            font-size: 0.7rem;
            color: #8B7355;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        /* Filter form - Bakery */
        .filter-form {
            background: linear-gradient(135deg, var(--bakery-bg) 0%, #FAF3EB 100%);
            padding: 0.875rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            border: 1px solid rgba(139, 69, 19, 0.08);
        }

        .filter-form .form-control,
        .filter-form .form-select {
            border-radius: 8px;
            border: 1px solid rgba(139, 69, 19, 0.15);
            font-size: 0.875rem;
        }

        .filter-form .btn {
            border-radius: 6px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('include.navbarSistem')
        @include('include.sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">

            <!-- Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="font-weight: 600;">Dashboard</h1>
                            <p class="text-muted mb-0">Selamat datang di panel admin Wijaya Bakery</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Maintenance Mode Alert -->
                    @if($maintenanceMode ?? false)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fas fa-tools mr-2"></i>
                            <strong>Maintenance Mode Aktif!</strong> Website sedang dalam mode perbaikan.
                            <a href="{{ url('mng-system') }}" class="btn btn-sm btn-warning ml-3">Kelola</a>
                        </div>
                    @endif

                    <!-- Row 1: Today's Stats -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="text-muted mb-3"><i class="fas fa-clock mr-2"></i>Statistik Hari Ini</h6>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="stat-card success">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="stat-label">Pendapatan Hari Ini</p>
                                        <h3 class="stat-value">Rp {{ number_format($revenueToday ?? 0, 0, ',', '.') }}
                                        </h3>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-coins"></i>
                                    </div>
                                </div>
                                <span class="small text-muted">{{ $ordersToday ?? 0 }} pesanan hari ini</span>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="stat-card warning">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="stat-label">Pesanan Aktif</p>
                                        <h3 class="stat-value">{{ $activeOrders ?? 0 }}</h3>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-spinner fa-pulse"></i>
                                    </div>
                                </div>
                                <a href="{{ url('mng-pesanan') }}" class="small text-warning">Lihat Pesanan →</a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="stat-card {{ ($outOfStockMenus ?? 0) > 0 ? 'danger' : 'info' }}"
                                style="{{ ($outOfStockMenus ?? 0) > 0 ? 'border-left-color: #dc3545;' : '' }}">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="stat-label">Stok Habis</p>
                                        <h3 class="stat-value">{{ $outOfStockMenus ?? 0 }}</h3>
                                    </div>
                                    <div class="stat-icon"
                                        style="{{ ($outOfStockMenus ?? 0) > 0 ? 'background: linear-gradient(135deg, #dc3545, #c82333);' : '' }}">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                </div>
                                @if(($outOfStockMenus ?? 0) > 0)
                                    <a href="{{ url('mng-menu') }}" class="small text-danger">Perlu restock! →</a>
                                @else
                                    <span class="small text-muted">Semua stok tersedia</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="stat-card primary">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="stat-label">Total User</p>
                                        <h3 class="stat-value">{{ $totalUser ?? 0 }}</h3>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <a href="{{ url('mng-user') }}" class="small text-primary">Kelola User →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Monthly Stats -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-muted mb-3"><i class="fas fa-calendar-alt mr-2"></i>Statistik Bulan Ini</h6>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="stat-card primary">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="stat-label">Total Menu</p>
                                        <h3 class="stat-value">{{ $totalMenu ?? 0 }}</h3>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-bread-slice"></i>
                                    </div>
                                </div>
                                <a href="{{ url('mng-menu') }}" class="small text-primary">Kelola Menu →</a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="stat-card success">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="stat-label">Kategori</p>
                                        <h3 class="stat-value">{{ $totalKategori ?? 0 }}</h3>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-th-list"></i>
                                    </div>
                                </div>
                                <a href="{{ url('mng-kategori') }}" class="small text-success">Kelola Kategori →</a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="stat-card warning">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="stat-label">Pesanan Bulan Ini</p>
                                        <h3 class="stat-value">{{ $ordersMonth ?? 0 }}</h3>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                </div>
                                <span class="small text-muted">Total: {{ $ordersTotal ?? 0 }} pesanan</span>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="stat-card info">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="stat-label">Pendapatan Bulan Ini</p>
                                        <h3 class="stat-value">Rp {{ number_format($revenueMonth ?? 0, 0, ',', '.') }}
                                        </h3>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                </div>
                                <span class="small text-muted">Total: Rp
                                    {{ number_format($revenueTotal ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>


                    <!-- Row 2: Main Content -->
                    <div class="row">
                        <!-- Left Column: Chart -->
                        <div class="col-lg-8 mb-4">
                            <div class="dashboard-card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5><i class="fas fa-chart-line mr-2"></i>Grafik Penjualan</h5>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                        data-toggle="collapse" data-target="#chartFilters">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                </div>
                                <div class="card-body">
                                    <!-- Collapsible Filters -->
                                    <div class="collapse mb-3" id="chartFilters">
                                        <form method="GET" class="filter-form">
                                            <div class="row align-items-end">
                                                <div class="col-md-3 mb-2">
                                                    <label class="small text-muted">Tahun</label>
                                                    <select class="form-control form-control-sm" name="year">
                                                        @for($y = now()->year - 2; $y <= now()->year + 1; $y++)
                                                            <option value="{{ $y }}" @if($y == $year) selected @endif>{{ $y }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label class="small text-muted">Dari Bulan</label>
                                                    <select class="form-control form-control-sm" name="start_month">
                                                        @for($m = 1; $m <= 12; $m++)
                                                            <option value="{{ $m }}" @if($m == $startMonth) selected @endif>
                                                                {{ \Carbon\Carbon::create()->month($m)->format('M') }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label class="small text-muted">Sampai Bulan</label>
                                                    <select class="form-control form-control-sm" name="end_month">
                                                        @for($m = 1; $m <= 12; $m++)
                                                            <option value="{{ $m }}" @if($m == $endMonth) selected @endif>
                                                                {{ \Carbon\Carbon::create()->month($m)->format('M') }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <button type="submit" class="btn btn-primary btn-sm btn-block">
                                                        <i class="fas fa-search"></i> Terapkan
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Summary Stats -->
                                    @php
                                        $totalPeriodRevenue = 0;
                                        $totalPeriodOrders = 0;
                                        if ($monthlyProfitData) {
                                            foreach ($monthlyProfitData as $monthData) {
                                                $totalPeriodRevenue += $monthData['revenue'];
                                                $totalPeriodOrders += $monthData['orders'];
                                            }
                                        }
                                    @endphp
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <div class="summary-stat">
                                                <div class="value text-success">Rp
                                                    {{ number_format($totalPeriodRevenue, 0, ',', '.') }}
                                                </div>
                                                <div class="label">Pendapatan Periode</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="summary-stat">
                                                <div class="value text-primary">{{ $totalPeriodOrders }}</div>
                                                <div class="label">Total Pesanan</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="summary-stat">
                                                <div class="value text-info">{{ count($monthlyProfitData ?? []) }}</div>
                                                <div class="label">Jumlah Bulan</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Chart -->
                                    <canvas id="monthlyProfitChart" height="100"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Sidebar Widgets -->
                        <div class="col-lg-4">
                            <!-- Top Menu This Month -->
                            <div class="dashboard-card mb-4">
                                <div class="card-header">
                                    <h5><i class="fas fa-trophy mr-2 text-warning"></i>Menu Terlaris</h5>
                                </div>
                                <div class="card-body">
                                    @if($topMenusThisMonth->count() > 0)
                                        @foreach($topMenusThisMonth->take(5) as $index => $menu)
                                            <div class="top-menu-item">
                                                <div class="top-menu-rank">{{ $index + 1 }}</div>
                                                <div class="flex-grow-1">
                                                    <div class="font-weight-medium">{{ $menu->nama_menu }}</div>
                                                    <small class="text-muted">{{ $menu->total_ordered }} terjual</small>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-center text-muted mb-0">Belum ada data bulan ini</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Low Stock Alert -->
                            @if($lowStockMenus->count() > 0)
                                <div class="dashboard-card mb-4" style="border-left: 4px solid #dc3545;">
                                    <div class="card-header">
                                        <h5><i class="fas fa-exclamation-triangle mr-2 text-danger"></i>Stok Rendah</h5>
                                    </div>
                                    <div class="card-body">
                                        @foreach($lowStockMenus->take(5) as $menu)
                                            <div class="low-stock-item">
                                                <span>{{ $menu->nama_menu }}</span>
                                                <span class="stock-badge">{{ $menu->stok }} sisa</span>
                                            </div>
                                        @endforeach
                                        @if($lowStockMenus->count() > 5)
                                            <a href="{{ url('mng-menu') }}"
                                                class="btn btn-sm btn-outline-danger btn-block mt-3">
                                                Lihat Semua ({{ $lowStockMenus->count() }})
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Quick Actions -->
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <h5><i class="fas fa-bolt mr-2"></i>Aksi Cepat</h5>
                                </div>
                                <div class="card-body">
                                    <a href="{{ url('mng-menu/create') }}" class="quick-action">
                                        <i class="fas fa-plus bg-primary text-white"></i>
                                        <span>Tambah Menu Baru</span>
                                    </a>
                                    <a href="{{ url('mng-kategori/create') }}" class="quick-action">
                                        <i class="fas fa-folder-plus bg-success text-white"></i>
                                        <span>Tambah Kategori</span>
                                    </a>
                                    <a href="{{ url('mng-menu') }}" class="quick-action">
                                        <i class="fas fa-boxes bg-warning text-white"></i>
                                        <span>Update Stok</span>
                                    </a>
                                    <a href="{{ url('/') }}" class="quick-action" target="_blank">
                                        <i class="fas fa-external-link-alt bg-info text-white"></i>
                                        <span>Lihat Website</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>

        @include('include.footerSistem')
    </div>

    @include('services.ToastModal')
    @include('services.LogoutModal')

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="{{ asset('resources/js/ToastScript.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Aktifkan treeview dropdown
            $('[data-widget="treeview"]').each(function () {
                if (typeof AdminLTE !== 'undefined' && AdminLTE.Treeview) {
                    AdminLTE.Treeview._jQueryInterface.call($(this));
                }
            });

            // Monthly Profit Chart
            const monthlyProfitData = @json($monthlyProfitData ?: []);
            const profitLabels = Object.values(monthlyProfitData).map(item => item.month_name);
            const profitValues = Object.values(monthlyProfitData).map(item => item.revenue);
            const ordersValues = Object.values(monthlyProfitData).map(item => item.orders);

            const profitCtx = document.getElementById('monthlyProfitChart');
            if (profitCtx) {
                new Chart(profitCtx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: profitLabels,
                        datasets: [
                            {
                                label: 'Pendapatan (Rp)',
                                data: profitValues,
                                backgroundColor: 'rgba(139, 69, 19, 0.7)',
                                borderColor: 'rgba(139, 69, 19, 1)',
                                borderWidth: 1,
                                borderRadius: 6,
                                yAxisID: 'y',
                            },
                            {
                                label: 'Jumlah Pesanan',
                                data: ordersValues,
                                borderColor: 'rgba(210, 105, 30, 1)',
                                backgroundColor: 'rgba(210, 105, 30, 0.1)',
                                borderWidth: 2,
                                yAxisID: 'y1',
                                type: 'line',
                                tension: 0.4,
                                pointRadius: 4,
                                pointBackgroundColor: 'rgba(210, 105, 30, 1)',
                                pointHoverRadius: 6,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                padding: 12,
                                cornerRadius: 8,
                                callbacks: {
                                    label: function (context) {
                                        let label = context.dataset.label || '';
                                        if (label) label += ': ';
                                        if (context.datasetIndex === 0) {
                                            label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                        } else {
                                            label += context.parsed.y + ' pesanan';
                                        }
                                        return label;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: { display: false }
                            },
                            y: {
                                type: 'linear',
                                display: true,
                                position: 'left',
                                grid: { color: 'rgba(0, 0, 0, 0.05)' },
                                ticks: {
                                    callback: function (value) {
                                        if (value >= 1000000) {
                                            return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                                        } else if (value >= 1000) {
                                            return 'Rp ' + (value / 1000).toFixed(0) + 'rb';
                                        }
                                        return 'Rp ' + value;
                                    }
                                }
                            },
                            y1: {
                                type: 'linear',
                                display: true,
                                position: 'right',
                                grid: { drawOnChartArea: false },
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>