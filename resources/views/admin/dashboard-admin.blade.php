<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard || Manajemen Resep Makanan Indonesia</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo1.png') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
        }
        .fc-daygrid-day-number {
            color: white !important;
        }
        .fc-daygrid-day {
            border: none !important;
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
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard Admin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard Admin</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <section class="content">
                <div class="container-fluid">

                   <!-- Row Horizontal: Statistik, Promo & Sponsor -->
                    <div class="row">
                        <!-- Kategori -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $totalKategori ?? 0 }}</h3>
                                    <p>Kategori Roti</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-th-list"></i>
                                </div>
                                <a href="{{ url('kategori') }}" class="small-box-footer">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Menu -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $totalMenu ?? 0 }}</h3>
                                    <p>Total Menu Roti</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <a href="{{ url('menu') }}" class="small-box-footer">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Promo -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $totalPromo ?? 0 }}</h3>
                                    <p>Total Promo</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <a href="{{ url('promo') }}" class="small-box-footer">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Sponsor -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3>{{ $totalSponsor ?? 0 }}</h3>
                                    <p>Total Sponsor</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <a href="{{ url('sponsor') }}" class="small-box-footer">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>


                    <!-- Row for Flexible Monthly Profit Chart -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-line"></i> Grafik Keuntungan Bulanan
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Date Range Filters -->
                                    <form method="GET" class="row g-3 mb-4">
                                        <div class="col-md-3">
                                            <label for="year" class="form-label">Tahun</label>
                                            <select class="form-control" id="year" name="year">
                                                @for($y = now()->year - 2; $y <= now()->year + 1; $y++)
                                                    <option value="{{ $y }}" @if($y == $year) selected @endif>{{ $y }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="start_month" class="form-label">Dari Bulan</label>
                                            <select class="form-control" id="start_month" name="start_month">
                                                @for($m = 1; $m <= 12; $m++)
                                                    <option value="{{ $m }}" @if($m == $startMonth) selected @endif>
                                                        {{ \Carbon\Carbon::create()->month($m)->format('M') }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="end_month" class="form-label">Sampai Bulan</label>
                                            <select class="form-control" id="end_month" name="end_month">
                                                @for($m = 1; $m <= 12; $m++)
                                                    <option value="{{ $m }}" @if($m == $endMonth) selected @endif>
                                                        {{ \Carbon\Carbon::create()->month($m)->format('M') }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-3 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary me-2">
                                                <i class="fas fa-search"></i> Filter
                                            </button>
                                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                                <i class="fas fa-undo"></i> Reset
                                            </a>
                                        </div>
                                    </form>

                                    <!-- Monthly Profit Chart -->
                                    <div class="row">
                                        <div class="col-md-8">
                                            <canvas id="monthlyProfitChart" height="100"></canvas>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- Profit Summary -->
                                            <div class="card border-info">
                                                <div class="card-header bg-info text-white">
                                                    <h6 class="card-title mb-0">
                                                        <i class="fas fa-info-circle"></i> Ringkasan Periode
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    @php
                                                        $totalPeriodRevenue = 0;
                                                        $totalPeriodOrders = 0;
                                                        $avgMonthlyRevenue = 0;

                                                        if ($monthlyProfitData) {
                                                            foreach ($monthlyProfitData as $monthData) {
                                                                $totalPeriodRevenue += $monthData['revenue'];
                                                                $totalPeriodOrders += $monthData['orders'];
                                                            }
                                                            $monthCount = count($monthlyProfitData);
                                                            $avgMonthlyRevenue = $monthCount > 0 ? $totalPeriodRevenue / $monthCount : 0;
                                                        }
                                                    @endphp

                                                    <div class="mb-2">
                                                        <strong>Total Pendapatan:</strong><br>
                                                        <span class="text-success h5">Rp {{ number_format($totalPeriodRevenue, 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="mb-2">
                                                        <strong>Total Pesanan:</strong><br>
                                                        <span class="text-primary h6">{{ $totalPeriodOrders }} pesanan</span>
                                                    </div>
                                                    <div class="mb-2">
                                                        <strong>Rata-rata Bulanan:</strong><br>
                                                        <span class="text-info">Rp {{ number_format($avgMonthlyRevenue, 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="mb-0">
                                                        <strong>Jumlah Bulan:</strong><br>
                                                        <span class="text-secondary">{{ count($monthlyProfitData ?? []) }} bulan</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Monthly Details Table -->
                                            <div class="card mt-3">
                                                <div class="card-header">
                                                    <h6 class="card-title mb-0">
                                                        <i class="fas fa-table"></i> Detail Bulanan
                                                    </h6>
                                                </div>
                                                <div class="card-body p-0">
                                                    <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                                                        <table class="table table-sm mb-0">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th class="p-2">Bulan</th>
                                                                    <th class="p-2">Pendapatan</th>
                                                                    <th class="p-2">Pesanan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if($monthlyProfitData)
                                                                    @foreach($monthlyProfitData as $monthData)
                                                                        <tr>
                                                                            <td class="p-2">{{ $monthData['month_name'] }} {{ $year }}</td>
                                                                            <td class="p-2">
                                                                                @if($monthData['revenue'] > 0)
                                                                                    <span class="text-success">Rp {{ number_format($monthData['revenue'], 0, ',', '.') }}</span>
                                                                                @else
                                                                                    <small class="text-muted">-</small>
                                                                                @endif
                                                                            </td>
                                                                            <td class="p-2">
                                                                                @if($monthData['orders'] > 0)
                                                                                    {{ $monthData['orders'] }}
                                                                                @else
                                                                                    <small class="text-muted">-</small>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="3" class="text-center text-muted p-3">Tidak ada data</td>
                                                                    </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row for Original Sales Data & Top Menus -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-line"></i> Grafik Penjualan 30 Hari Terakhir
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="salesChart" height="80"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-bar"></i> Menu Terlaris Bulan Ini
                                    </h3>
                                </div>
                                <div class="card-body">
                                    @if($topMenusThisMonth->count() > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($topMenusThisMonth as $index => $menu)
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>{{ $index + 1 }}. {{ $menu->nama_menu }}</span>
                                                    <span class="badge badge-primary badge-pill">{{ $menu->total_ordered }} porsi</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-center text-muted">Belum ada data penjualan bulan ini.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row for Profit/Loss Calculator -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-calculator"></i> Kalkulator Keuntungan
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="modal">Modal (Capital)</label>
                                                <input type="number" class="form-control" id="modal" placeholder="Masukkan nilai modal" min="0">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Periode</label>
                                                <select class="form-control" id="periode">
                                                    <option value="month">Bulan Ini</option>
                                                    <option value="year">Tahun Ini</option>
                                                    <option value="total">Semua Waktu</option>
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-primary mt-2" onclick="calculateProfit()">Hitung Keuntungan</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="small-box bg-success">
                                                <div class="inner">
                                                    <h4 id="totalRevenue">0</h4>
                                                    <p>Total Pendapatan</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-money-bill-wave"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="small-box bg-warning">
                                                <div class="inner">
                                                    <h4 id="totalCost">0</h4>
                                                    <p>Modal Digunakan</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-coins"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="small-box" id="profitBox">
                                                <div class="inner">
                                                    <h4 id="profit">0</h4>
                                                    <p>Keuntungan</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-chart-line" id="profitIcon"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                    <h4 id="totalOrders">0</h4>
                                                    <p>Total Pesanan</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row for Low Stock Alert -->
                    @if($lowStockMenus->count() > 0)
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-exclamation-triangle"></i> Peringatan Stok Rendah
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <p>Menu berikut memiliki stok kurang dari 20:</p>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Menu</th>
                                                <th>Stok Tersisa</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($lowStockMenus as $menu)
                                            <tr>
                                                <td>{{ $menu->nama_menu }}</td>
                                                <td>
                                                    <span class="badge badge-danger">{{ $menu->stok }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Restok
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

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
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Aktifkan treeview dropdown
            $('[data-widget="treeview"]').each(function () {
                AdminLTE.Treeview._jQueryInterface.call($(this));
            });
        });
    </script>
    <script src="{{ asset('resources/js/ToastScript.js') }}"></script>

    <script>
        // Charts
        document.addEventListener('DOMContentLoaded', function () {
            // Monthly Profit Chart
            const monthlyProfitData = @json($monthlyProfitData ?: []);
            const profitLabels = Object.values(monthlyProfitData).map(item => item.month_name + ' ' + {{ $year }});
            const profitValues = Object.values(monthlyProfitData).map(item => item.revenue);
            const ordersValues = Object.values(monthlyProfitData).map(item => item.orders);

            // Monthly Profit Chart
            const profitCtx = document.getElementById('monthlyProfitChart');
            if (profitCtx) {
                const profitCtx2D = profitCtx.getContext('2d');
                new Chart(profitCtx2D, {
                    type: 'bar',
                    data: {
                        labels: profitLabels,
                        datasets: [
                            {
                                label: 'Pendapatan (Rp)',
                                data: profitValues,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                                yAxisID: 'y',
                            },
                            {
                                label: 'Jumlah Pesanan',
                                data: ordersValues,
                                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                                yAxisID: 'y1',
                                type: 'line',
                                tension: 0.4,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        scales: {
                            x: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Bulan'
                                }
                            },
                            y: {
                                type: 'linear',
                                display: true,
                                position: 'left',
                                title: {
                                    display: true,
                                    text: 'Pendapatan (Rp)'
                                },
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    }
                                },
                                grid: {
                                    drawOnChartArea: true,
                                }
                            },
                            y1: {
                                type: 'linear',
                                display: true,
                                position: 'right',
                                title: {
                                    display: true,
                                    text: 'Jumlah Pesanan'
                                },
                                grid: {
                                    drawOnChartArea: false,
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: `Grafik Keuntungan Tahun {{ $year }}`
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.datasetIndex === 0) {
                                            label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                        } else {
                                            label += context.parsed.y + ' pesanan';
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Sales Chart (30 days)
            const salesData = @json($salesData ? $salesData->pluck('total', 'date')->toArray() : []);
            const salesLabels = Object.keys(salesData);
            const salesValues = Object.values(salesData);

            const ctx = document.getElementById('salesChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: salesLabels,
                    datasets: [{
                        label: 'Total Penjualan Per Hari',
                        data: salesValues,
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });

            // Profit Calculator
            function calculateProfit() {
                const modal = parseFloat(document.getElementById('modal').value) || 0;
                const period = document.getElementById('periode').value;

                let revenue = 0;
                let orders = 0;

                if (period === 'month') {
                    revenue = @json($revenueMonth);
                    orders = @json($ordersMonth);
                } else if (period === 'year') {
                    revenue = @json($revenueYear);
                    orders = @json($ordersYear);
                } else {
                    revenue = @json($revenueTotal);
                    orders = @json($ordersTotal);
                }

                const profit = revenue - modal;
                const profitBox = document.getElementById('profitBox');
                const profitIcon = document.getElementById('profitIcon');

                // Update UI
                document.getElementById('totalRevenue').textContent = 'Rp ' + revenue.toLocaleString('id-ID');
                document.getElementById('totalCost').textContent = 'Rp ' + modal.toLocaleString('id-ID');
                document.getElementById('profit').textContent = 'Rp ' + Math.abs(profit).toLocaleString('id-ID');
                document.getElementById('totalOrders').textContent = orders;

                // Color coding for profit/loss
                if (profit >= 0) {
                    profitBox.className = 'small-box bg-success';
                    profitIcon.className = 'fas fa-arrow-up';
                    document.getElementById('profit').nextElementSibling.textContent = 'Keuntungan';
                } else {
                    profitBox.className = 'small-box bg-danger';
                    profitIcon.className = 'fas fa-arrow-down';
                    document.getElementById('profit').nextElementSibling.textContent = 'Kerugian';
                }
            }

            // Make calculateProfit global
            window.calculateProfit = calculateProfit;

            var calendarEl = document.getElementById('calendar');
            if (calendarEl) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'id'
                });
                calendar.render();
            }

            $('[data-widget="treeview"]').each(function () {
                AdminLTE.Treeview._jQueryInterface.call($(this));
            });
        });
    </script>
</body>
</html>
