<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Images || Wijaya Bakery</title>
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

        .page-header {
            background: white;
            padding: 1.5rem;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-add {
            background: linear-gradient(135deg, #9c27b0, #7b1fa2);
            border: none;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-add:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(156, 39, 176, 0.3);
            color: white;
        }

        /* Hero grid */
        .hero-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .hero-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            transition: all 0.3s;
            position: relative;
        }

        .hero-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .hero-card.active {
            border-color: #28a745;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
        }

        .hero-image-container {
            position: relative;
            width: 100%;
            height: 180px;
            overflow: hidden;
            background: #f1f3f5;
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .hero-card:hover .hero-image {
            transform: scale(1.05);
        }

        .status-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            backdrop-filter: blur(4px);
        }

        .status-badge.active {
            background: rgba(40, 167, 69, 0.9);
            color: white;
        }

        .status-badge.inactive {
            background: rgba(108, 117, 125, 0.9);
            color: white;
        }

        .hero-card-body {
            padding: 1rem;
        }

        .hero-number {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 0.5rem;
        }

        .hero-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            flex: 1;
            padding: 0.5rem;
            border-radius: 6px;
            border: none;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-action.edit {
            background: #fff3e0;
            color: #e65100;
        }

        .btn-action.delete {
            background: #ffebee;
            color: #c62828;
        }

        .btn-action:hover {
            transform: translateY(-1px);
        }

        .btn-action.toggle-on {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .btn-action.toggle-off {
            background: #fff3e0;
            color: #e65100;
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

        /* Info box */
        .info-box {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-radius: 10px;
            padding: 1rem 1.5rem;
            margin: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .info-box i {
            font-size: 1.5rem;
            color: #1976d2;
        }

        .info-box p {
            margin: 0;
            color: #1565c0;
            font-size: 0.9rem;
        }

        /* Modal */
        .modal-content {
            border: none;
            border-radius: 12px;
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
                            <h1 class="m-0" style="font-weight: 600;">Landing Images</h1>
                            <p class="text-muted mb-0">Kelola gambar hero untuk halaman utama</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Hero</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="page-card">
                        <div class="page-header">
                            <div>
                                <h5 class="mb-0" style="font-weight: 600;">Daftar Gambar Hero</h5>
                                <small class="text-muted">Gambar yang aktif akan ditampilkan di homepage</small>
                            </div>
                            <a href="{{ route('admin.hero.create') }}" class="btn btn-add">
                                <i class="fas fa-plus mr-2"></i>Tambah Gambar
                            </a>
                        </div>

                        <div class="info-box">
                            <i class="fas fa-info-circle"></i>
                            <p>Gambar dengan status <strong>Aktif</strong> akan ditampilkan sebagai background hero di
                                halaman utama website. Ukuran yang disarankan adalah 1920×1080 piksel.</p>
                        </div>

                        @if($heroes->count() > 0)
                            <div class="hero-grid">
                                @foreach($heroes as $index => $hero)
                                    <div class="hero-card {{ $hero->status ? 'active' : '' }}">
                                        <div class="hero-image-container">
                                            @if($hero->gambar)
                                                <img loading="lazy" src="{{ asset('storage/uploads/hero/' . $hero->gambar) }}"
                                                    alt="Hero {{ $index + 1 }}" class="hero-image">
                                            @else
                                                <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                                    <i class="fas fa-image fa-3x"></i>
                                                </div>
                                            @endif
                                            <span class="status-badge {{ $hero->status ? 'active' : 'inactive' }}">
                                                <i
                                                    class="fas fa-{{ $hero->status ? 'check-circle' : 'pause-circle' }} mr-1"></i>
                                                {{ $hero->status ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </div>
                                        <div class="hero-card-body">
                                            <div class="hero-number">Hero #{{ $index + 1 }}</div>
                                            <div class="hero-actions">
                                                <a href="{{ route('admin.hero.edit', $hero->id) }}" class="btn-action edit">
                                                    <i class="fas fa-pen"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.hero.toggle', $hero->id) }}" method="POST"
                                                    class="d-inline flex-fill">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn-action w-100 {{ $hero->status ? 'toggle-off' : 'toggle-on' }}">
                                                        <i class="fas fa-{{ $hero->status ? 'eye-slash' : 'eye' }}"></i>
                                                        {{ $hero->status ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>
                                                </form>
                                                <button class="btn-action delete delete-btn" data-toggle="modal"
                                                    data-target="#deleteModal" data-id="{{ $hero->id }}">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-images"></i>
                                <h5>Belum ada gambar hero</h5>
                                <p>Tambahkan gambar untuk ditampilkan di halaman utama</p>
                            </div>
                        @endif
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
                    <p>Apakah Anda yakin ingin menghapus gambar hero ini?</p>
                    <p class="text-muted small mb-0">Gambar akan dihapus secara permanen.</p>
                </div>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash mr-1"></i>Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('services.ToastModal')
    @include('services.LogoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.delete-btn').click(function () {
                const id = $(this).data('id');
                $('#deleteForm').attr('action', '{{ url("mng-hero") }}/' + id);
            });

            @if(session('success') || session('error'))
                $('#toastNotification').toast({ delay: 3000 }).toast('show');
            @endif
        });
    </script>
</body>

</html>