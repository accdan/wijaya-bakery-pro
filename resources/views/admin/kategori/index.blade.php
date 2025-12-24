<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori || Wijaya Bakery</title>
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
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header h5 {
            margin: 0;
            font-weight: 600;
            color: #343a40;
        }

        .btn-add {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-add:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
            color: white;
        }

        .search-box {
            position: relative;
            max-width: 300px;
        }

        .search-box input {
            padding-left: 2.5rem;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .search-box i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        /* Category grid */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
            padding: 1.5rem;
        }

        .category-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .category-card:hover {
            background: white;
            border-color: #007bff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .category-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .category-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .category-name {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 0.25rem;
        }

        .category-count {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .category-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: all 0.2s;
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
            transform: scale(1.1);
        }

        /* Table view (alternative) */
        .clean-table {
            margin: 0;
        }

        .clean-table thead th {
            background: #f8f9fa;
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 600;
            color: #495057;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .clean-table tbody td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f4;
        }

        .clean-table tbody tr:hover {
            background: #f8f9fa;
        }

        .table-footer {
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        .table-info {
            font-size: 0.85rem;
            color: #6c757d;
        }

        /* Modal */
        .modal-content {
            border: none;
            border-radius: 12px;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
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
                            <h1 class="m-0" style="font-weight: 600;">Kelola Kategori</h1>
                            <p class="text-muted mb-0">Kelola kategori menu roti</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Kategori</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="page-card">
                        <div class="page-header">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari kategori...">
                            </div>
                            <a href="{{ route('admin.kategori.create') }}" class="btn btn-add">
                                <i class="fas fa-plus mr-2"></i>Tambah Kategori
                            </a>
                        </div>

                        @if($kategoris->count() > 0)
                            <div class="category-grid" id="categoryGrid">
                                @foreach($kategoris as $kategori)
                                    <div class="category-card" data-name="{{ strtolower($kategori->nama_kategori) }}">
                                        <div class="category-info">
                                            <div class="category-icon">
                                                <i class="fas fa-folder"></i>
                                            </div>
                                            <div>
                                                <div class="category-name">{{ $kategori->nama_kategori }}</div>
                                                <div class="category-count">
                                                    {{ $kategori->menus()->count() ?? 0 }} menu
                                                </div>
                                            </div>
                                        </div>
                                        <div class="category-actions">
                                            <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn-action edit"
                                                title="Edit">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn-action delete delete-btn" data-toggle="modal"
                                                data-target="#deleteModal" data-id="{{ $kategori->id }}"
                                                data-name="{{ $kategori->nama_kategori }}" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="table-footer">
                                <div class="table-info">
                                    Total {{ $kategoris->count() }} kategori
                                </div>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-folder-open"></i>
                                <h5>Belum ada kategori</h5>
                                <p>Klik tombol "Tambah Kategori" untuk membuat kategori pertama</p>
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
                    <p>Apakah Anda yakin ingin menghapus kategori <strong id="kategoriName"></strong>?</p>
                    <p class="text-muted small mb-0">Menu dalam kategori ini tidak akan terhapus.</p>
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
            // Search functionality
            $('#searchInput').on('keyup', function () {
                const value = $(this).val().toLowerCase();
                $('.category-card').each(function () {
                    const name = $(this).data('name');
                    $(this).toggle(name.indexOf(value) > -1);
                });
            });

            // Delete modal
            $('.delete-btn').click(function () {
                const id = $(this).data('id');
                const name = $(this).data('name');
                $('#kategoriName').text(name);
                $('#deleteForm').attr('action', '{{ url("mng-kategori") }}/' + id);
            });

            // Toast notification
            @if(session('success') || session('error'))
                $('#toastNotification').toast({ delay: 3000 }).toast('show');
            @endif
        });
    </script>
</body>

</html>



