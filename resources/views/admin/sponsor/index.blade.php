<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Sponsor || Wijaya Bakery</title>
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
            background: linear-gradient(135deg, #f59e0b, #d97706);
            padding: 1.5rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .btn-add {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-add:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        /* Sponsor grid */
        .sponsor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .sponsor-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e9ecef;
            transition: all 0.3s;
        }

        .sponsor-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            transform: translateY(-4px);
        }

        .sponsor-logo-container {
            height: 140px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
        }

        .sponsor-logo {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .sponsor-placeholder {
            width: 80px;
            height: 80px;
            background: #dee2e6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            font-size: 2rem;
        }

        .sponsor-body {
            padding: 1.25rem;
        }

        .sponsor-name {
            font-size: 1.15rem;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 0.5rem;
        }

        .sponsor-desc {
            font-size: 0.9rem;
            color: #6c757d;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 1rem;
            min-height: 2.7rem;
        }

        .sponsor-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            flex: 1;
            padding: 0.5rem;
            border-radius: 8px;
            border: none;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-action.edit {
            background: #fef3c7;
            color: #d97706;
        }

        .btn-action.delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-action:hover {
            transform: translateY(-1px);
        }

        .btn-action.toggle-on {
            background: #d1fae5;
            color: #059669;
        }

        .btn-action.toggle-off {
            background: #fed7aa;
            color: #ea580c;
        }

        .status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            backdrop-filter: blur(4px);
        }

        .status-badge.active {
            background: rgba(16, 185, 129, 0.9);
            color: white;
        }

        .status-badge.inactive {
            background: rgba(156, 163, 175, 0.9);
            color: white;
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
                            <h1 class="m-0" style="font-weight: 600;">Kelola Sponsor</h1>
                            <p class="text-muted mb-0">Partner dan sponsor bakery</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Sponsor</li>
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
                                <h5><i class="fas fa-handshake mr-2"></i>Daftar Sponsor</h5>
                                <small style="opacity: 0.8;">{{ $sponsors->count() }} sponsor terdaftar</small>
                            </div>
                            <a href="{{ route('admin.sponsor.create') }}" class="btn btn-add">
                                <i class="fas fa-plus mr-2"></i>Tambah Sponsor
                            </a>
                        </div>

                        @if($sponsors->count() > 0)
                            <div class="sponsor-grid">
                                @foreach($sponsors as $sponsor)
                                    <div class="sponsor-card">
                                        <div class="sponsor-logo-container">
                                            @if($sponsor->logo_sponsor)
                                                <img loading="lazy"
                                                    src="{{ asset('storage/uploads/sponsor/' . $sponsor->logo_sponsor) }}"
                                                    alt="{{ $sponsor->nama_sponsor }}" class="sponsor-logo">
                                            @else
                                                <div class="sponsor-placeholder">
                                                    <i class="fas fa-building"></i>
                                                </div>
                                            @endif
                                            <span class="status-badge {{ ($sponsor->status ?? true) ? 'active' : 'inactive' }}">
                                                <i
                                                    class="fas fa-{{ ($sponsor->status ?? true) ? 'check-circle' : 'pause-circle' }} mr-1"></i>
                                                {{ ($sponsor->status ?? true) ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </div>
                                        <div class="sponsor-body">
                                            <div class="sponsor-name">{{ $sponsor->nama_sponsor }}</div>
                                            <div class="sponsor-desc">
                                                {{ $sponsor->deskripsi_sponsor ?? 'Tidak ada deskripsi' }}
                                            </div>
                                            <div class="sponsor-actions">
                                                <a href="{{ route('admin.sponsor.edit', $sponsor->id) }}"
                                                    class="btn-action edit">
                                                    <i class="fas fa-pen"></i>Edit
                                                </a>
                                                <form action="{{ route('admin.sponsor.toggle', $sponsor->id) }}" method="POST"
                                                    class="d-inline flex-fill">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn-action w-100 {{ ($sponsor->status ?? true) ? 'toggle-off' : 'toggle-on' }}">
                                                        <i
                                                            class="fas fa-{{ ($sponsor->status ?? true) ? 'eye-slash' : 'eye' }}"></i>
                                                        {{ ($sponsor->status ?? true) ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>
                                                </form>
                                                <button class="btn-action delete" data-toggle="modal" data-target="#deleteModal"
                                                    data-id="{{ $sponsor->id }}">
                                                    <i class="fas fa-trash"></i>Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-handshake"></i>
                                <h5>Belum ada sponsor</h5>
                                <p>Tambahkan sponsor untuk ditampilkan di homepage</p>
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
                    <p>Apakah Anda yakin ingin menghapus sponsor ini?</p>
                </div>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Hapus</button>
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
            // Delete modal
            $('.delete').click(function () {
                const id = $(this).data('id');
                $('#deleteForm').attr('action', '{{ url("mng-sponsor") }}/' + id);
            });

            @if(session('success') || session('error'))
                $('#toastNotification').toast({ delay: 3000 }).toast('show');
            @endif
        });
    </script>
</body>

</html>