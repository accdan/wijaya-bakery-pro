<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan || Wijaya Bakery</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/logo1.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background: #f4f6f9;
        }

        .page-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
        }

        /* Filter section */
        .filter-section {
            background: #f8f9fa;
            padding: 1.25rem;
            border-bottom: 1px solid #e9ecef;
        }

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: flex-end;
        }

        .filter-group {
            flex: 1;
            min-width: 150px;
        }

        .filter-group label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .filter-group .form-control {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
        }

        .filter-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-filter {
            background: #007bff;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            color: white;
            font-size: 0.875rem;
        }

        .btn-reset {
            background: #e9ecef;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            color: #495057;
            font-size: 0.875rem;
        }

        /* Stats bar */
        .stats-bar {
            display: flex;
            gap: 2rem;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e9ecef;
            background: white;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #343a40;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #6c757d;
            text-transform: uppercase;
        }

        /* Order cards */
        .orders-container {
            padding: 1.5rem;
        }

        .order-card {
            background: #f8f9fa;
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
            border: 1px solid #e9ecef;
            transition: all 0.2s;
        }

        .order-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .order-header {
            background: white;
            padding: 1rem 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e9ecef;
        }

        .order-customer {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .customer-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .customer-name {
            font-weight: 600;
            color: #343a40;
        }

        .customer-phone {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .order-meta {
            text-align: right;
        }

        .order-date {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .order-total {
            font-weight: 700;
            color: #28a745;
            font-size: 1.1rem;
        }

        /* Order items */
        .order-items {
            padding: 1rem 1.25rem;
        }

        .order-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px dashed #dee2e6;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .item-img {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            object-fit: cover;
            background: #e9ecef;
        }

        .item-name {
            font-weight: 500;
            color: #343a40;
        }

        .item-qty {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .item-price {
            font-weight: 600;
            color: #495057;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .filter-row {
                flex-direction: column;
            }

            .stats-bar {
                flex-wrap: wrap;
                justify-content: center;
            }

            .order-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .order-meta {
                text-align: center;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('include.navbarSistem')
        @include('include.sidebar')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="font-weight: 600;">Kelola Pesanan</h1>
                            <p class="text-muted mb-0">Lihat dan kelola pesanan pelanggan</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Pesanan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="page-card">
                        <!-- Filter Section -->
                        <div class="filter-section">
                            <form method="GET" action="{{ route('admin.pesanan.index') }}">
                                <div class="filter-row">
                                    <div class="filter-group" style="flex: 2;">
                                        <label>Cari</label>
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Nama pemesan, HP, atau menu..."
                                            value="{{ request('search') }}">
                                    </div>
                                    <div class="filter-group">
                                        <label>Dari Tanggal</label>
                                        <input type="date" name="tanggal_mulai" class="form-control"
                                            value="{{ request('tanggal_mulai') }}" id="tanggal_mulai">
                                    </div>
                                    <div class="filter-group">
                                        <label>Sampai Tanggal</label>
                                        <input type="date" name="tanggal_akhir" class="form-control"
                                            value="{{ request('tanggal_akhir') }}" id="tanggal_akhir">
                                    </div>
                                    <div class="filter-group">
                                        <label>Urutkan</label>
                                        <select name="sort_by" class="form-control">
                                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                                            <option value="nama_pemesan" {{ request('sort_by') == 'nama_pemesan' ? 'selected' : '' }}>Nama</option>
                                            <option value="total_harga" {{ request('sort_by') == 'total_harga' ? 'selected' : '' }}>Total</option>
                                        </select>
                                    </div>
                                    <div class="filter-actions">
                                        <button type="submit" class="btn btn-filter">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <a href="{{ route('admin.pesanan.index') }}" class="btn btn-reset">
                                            <i class="fas fa-redo"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Stats Bar -->
                        @php
                            $totalOrders = $pesanans->count();
                            $totalRevenue = 0;
                            foreach ($pesanans as $group) {
                                $totalRevenue += $group->sum('total_harga');
                            }
                        @endphp
                        <div class="stats-bar" style="justify-content: space-between; align-items: center;">
                            <div style="display: flex; gap: 2rem;">
                                <div class="stat-item">
                                    <div class="stat-value">{{ $totalOrders }}</div>
                                    <div class="stat-label">Total Pesanan</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value text-success">Rp
                                        {{ number_format($totalRevenue, 0, ',', '.') }}
                                    </div>
                                    <div class="stat-label">Total Pendapatan</div>
                                </div>
                            </div>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('admin.pesanan.exportCsv', request()->query()) }}" class="btn btn-sm"
                                    style="background: #28a745; color: white; border-radius: 8px;">
                                    <i class="fas fa-file-excel mr-1"></i>Export CSV
                                </a>
                                <a href="{{ route('admin.pesanan.exportPrint', request()->query()) }}" target="_blank"
                                    class="btn btn-sm" style="background: #6c757d; color: white; border-radius: 8px;">
                                    <i class="fas fa-print mr-1"></i>Cetak
                                </a>
                            </div>
                        </div>

                        <!-- Orders List -->
                        <div class="orders-container">
                            @if($pesanans->count() > 0)
                                @foreach($pesanans as $groupKey => $group)
                                    @php
                                        $info = explode('|', $groupKey);
                                        $nama = $info[0];
                                        $noHp = $info[1];
                                        $waktu = $info[2];
                                        $totalAsli = $group->sum('total_harga');
                                        $initial = strtoupper(substr($nama, 0, 1));
                                    @endphp
                                    <div class="order-card">
                                        <div class="order-header">
                                            <div class="order-customer">
                                                <div class="customer-avatar">{{ $initial }}</div>
                                                <div>
                                                    <div class="customer-name">{{ $nama }}</div>
                                                    <div class="customer-phone">
                                                        <i class="fas fa-phone-alt mr-1"></i>{{ $noHp }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="order-meta">
                                                <div class="order-date">
                                                    <i class="far fa-clock mr-1"></i>{{ $waktu }}
                                                </div>
                                                <div class="order-total">Rp {{ number_format($totalAsli, 0, ',', '.') }}</div>
                                            </div>
                                        </div>
                                        <div class="order-items">
                                            @foreach($group as $pesanan)
                                                <div class="order-item">
                                                    <div class="item-info">
                                                        <img loading="lazy" src="{{ $pesanan->menu->gambar_menu ? asset('storage/uploads/menu/' . $pesanan->menu->gambar_menu) : 'https://via.placeholder.com/40' }}"
                                                            alt="{{ $pesanan->menu->nama_menu ?? 'Menu' }}" class="item-img">
                                                        <div>
                                                            <div class="item-name">
                                                                {{ $pesanan->menu->nama_menu ?? 'Menu tidak tersedia' }}
                                                            </div>
                                                            <div class="item-qty">{{ $pesanan->jumlah }} × Rp
                                                                {{ number_format($pesanan->harga_satuan, 0, ',', '.') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item-price">Rp
                                                        {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-shopping-bag"></i>
                                    <h5>Belum ada pesanan</h5>
                                    <p>Pesanan dari pelanggan akan muncul di sini</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    @include('services.ToastModal')
    @include('services.LogoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function () {
            // Set default dates if not set
            if (!document.getElementById('tanggal_mulai').value) {
                let today = new Date();
                let thirtyDaysAgo = new Date();
                thirtyDaysAgo.setDate(today.getDate() - 30);

                document.getElementById('tanggal_mulai').value = thirtyDaysAgo.toISOString().split('T')[0];
                document.getElementById('tanggal_akhir').value = today.toISOString().split('T')[0];
            }

            @if(session('success') || session('error'))
                $('#toastNotification').toast({ delay: 3000 }).toast('show');
            @endif
        });
    </script>
</body>

</html>



