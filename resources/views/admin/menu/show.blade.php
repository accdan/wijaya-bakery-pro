<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Menu || Wijaya Bakery</title>
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

        .detail-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            max-width: 900px;
            margin: 0 auto;
        }

        /* Hero section with image */
        .menu-hero {
            position: relative;
            height: 280px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            overflow: hidden;
        }

        .menu-hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.3;
        }

        .menu-hero-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            align-items: center;
            padding: 2rem;
        }

        .menu-image {
            width: 180px;
            height: 180px;
            border-radius: 16px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            background: white;
        }

        .menu-hero-info {
            margin-left: 2rem;
            color: white;
        }

        .menu-hero-info h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .menu-category-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .menu-price-big {
            font-size: 1.75rem;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.9);
            color: #28a745;
            padding: 0.5rem 1.25rem;
            border-radius: 10px;
            display: inline-block;
        }

        /* Content section */
        .menu-content {
            padding: 2rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.25rem;
            text-align: center;
            transition: all 0.2s;
        }

        .info-card:hover {
            background: #f0f2f5;
            transform: translateY(-2px);
        }

        .info-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin: 0 auto 0.75rem;
        }

        .info-icon.stock {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            color: #2e7d32;
        }

        .info-icon.price {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            color: #e65100;
        }

        .info-icon.category {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #1565c0;
        }

        .info-icon.date {
            background: linear-gradient(135deg, #f3e5f5, #e1bee7);
            color: #7b1fa2;
        }

        .info-label {
            font-size: 0.8rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #343a40;
        }

        /* Description section */
        .description-section {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .description-section h5 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #343a40;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .description-section h5 i {
            color: #6c757d;
        }

        .description-text {
            color: #495057;
            line-height: 1.7;
            font-size: 1rem;
        }

        /* Timestamps */
        .timestamps {
            display: flex;
            gap: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .timestamps i {
            color: #adb5bd;
            margin-right: 0.5rem;
        }

        /* Actions */
        .action-bar {
            display: flex;
            gap: 1rem;
            padding: 1.5rem 2rem;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        .btn-action {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            border: none;
        }

        .btn-back:hover {
            background: #5a6268;
            color: white;
        }

        .btn-edit {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #212529;
            border: none;
        }

        .btn-edit:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
            color: #212529;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
            margin-left: auto;
        }

        .btn-delete:hover {
            background: #c82333;
            color: white;
        }

        /* Stock badge */
        .stock-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .stock-status.high {
            background: #d4edda;
            color: #155724;
        }

        .stock-status.medium {
            background: #fff3cd;
            color: #856404;
        }

        .stock-status.low {
            background: #f8d7da;
            color: #721c24;
        }

        /* Modal */
        .modal-content {
            border: none;
            border-radius: 12px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .menu-hero {
                height: auto;
                padding: 1.5rem;
            }

            .menu-hero-content {
                flex-direction: column;
                text-align: center;
            }

            .menu-image {
                width: 140px;
                height: 140px;
            }

            .menu-hero-info {
                margin-left: 0;
                margin-top: 1rem;
            }

            .action-bar {
                flex-wrap: wrap;
            }

            .btn-delete {
                margin-left: 0;
                width: 100%;
                justify-content: center;
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
                            <h1 class="m-0" style="font-weight: 600;">Detail Menu</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">Menu</a></li>
                                <li class="breadcrumb-item active">Detail</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="detail-card">
                        <!-- Hero Section -->
                        <div class="menu-hero">
                            @if($menu->gambar_menu)
                                <img loading="lazy" src="{{ asset('storage/uploads/menu/' . $menu->gambar_menu) }}" class="menu-hero-bg" alt="">
                            @endif
                            <div class="menu-hero-content">
                                <img loading="lazy" src="{{ $menu->gambar_menu ? asset('storage/uploads/menu/' . $menu->gambar_menu) : 'https://via.placeholder.com/180x180?text=No+Image' }}"
                                    class="menu-image" alt="{{ $menu->nama_menu }}">
                                <div class="menu-hero-info">
                                    <div class="menu-category-badge">
                                        <i
                                            class="fas fa-tag mr-1"></i>{{ $menu->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                    </div>
                                    <h1>{{ $menu->nama_menu }}</h1>
                                    <div class="menu-price-big">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="menu-content">
                            <!-- Info Grid -->
                            <div class="info-grid">
                                <div class="info-card">
                                    <div class="info-icon stock"><i class="fas fa-boxes"></i></div>
                                    <div class="info-label">Stok Tersedia</div>
                                    <div class="info-value">
                                        @if($menu->stok >= 30)
                                            <span class="stock-status high"><i
                                                    class="fas fa-check-circle"></i>{{ $menu->stok }} pcs</span>
                                        @elseif($menu->stok >= 10)
                                            <span class="stock-status medium"><i
                                                    class="fas fa-exclamation-circle"></i>{{ $menu->stok }} pcs</span>
                                        @else
                                            <span class="stock-status low"><i
                                                    class="fas fa-exclamation-triangle"></i>{{ $menu->stok }} pcs</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="info-card">
                                    <div class="info-icon price"><i class="fas fa-money-bill-wave"></i></div>
                                    <div class="info-label">Harga</div>
                                    <div class="info-value" style="color: #28a745;">Rp
                                        {{ number_format($menu->harga, 0, ',', '.') }}</div>
                                </div>

                                <div class="info-card">
                                    <div class="info-icon category"><i class="fas fa-folder"></i></div>
                                    <div class="info-label">Kategori</div>
                                    <div class="info-value">{{ $menu->kategori->nama_kategori ?? '-' }}</div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="description-section">
                                <h5><i class="fas fa-align-left"></i>Deskripsi Menu</h5>
                                <p class="description-text">
                                    {{ $menu->deskripsi_menu ?? 'Belum ada deskripsi untuk menu ini.' }}
                                </p>
                            </div>

                            <!-- Timestamps -->
                            <div class="timestamps">
                                <div>
                                    <i class="fas fa-calendar-plus"></i>
                                    Dibuat: {{ $menu->created_at->translatedFormat('d F Y, H:i') }}
                                </div>
                                <div>
                                    <i class="fas fa-calendar-check"></i>
                                    Diperbarui: {{ $menu->updated_at->translatedFormat('d F Y, H:i') }}
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="action-bar">
                            <a href="{{ route('admin.menu.index') }}" class="btn-action btn-back">
                                <i class="fas fa-arrow-left"></i>Kembali
                            </a>
                            <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn-action btn-edit">
                                <i class="fas fa-pen"></i>Edit Menu
                            </a>
                            <button class="btn-action btn-delete" data-toggle="modal" data-target="#deleteModal">
                                <i class="fas fa-trash"></i>Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus menu <strong>{{ $menu->nama_menu }}</strong>?</p>
                    <p class="text-muted small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash mr-1"></i>Hapus Menu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('services.LogoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>



