<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu || Wijaya Bakery</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/logo1.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Source Sans Pro', sans-serif; background: #f4f6f9; }
        
        .page-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
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
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-add:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
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
        
        /* Clean table */
        .clean-table {
            margin: 0;
        }
        
        .clean-table thead th {
            background: #f8f9fa;
            border: none;
            padding: 1rem;
            font-weight: 600;
            color: #495057;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .clean-table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f4;
        }
        
        .clean-table tbody tr:hover {
            background: #f8f9fa;
        }
        
        .menu-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .menu-img {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            background: #f1f3f4;
        }
        
        .menu-name {
            font-weight: 600;
            color: #343a40;
        }
        
        .menu-desc {
            font-size: 0.8rem;
            color: #6c757d;
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .badge-kategori {
            background: #e3f2fd;
            color: #1976d2;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .badge-stock {
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .badge-stock.low { background: #ffebee; color: #c62828; }
        .badge-stock.medium { background: #fff3e0; color: #e65100; }
        .badge-stock.high { background: #e8f5e9; color: #2e7d32; }
        
        .price-tag {
            font-weight: 700;
            color: #2e7d32;
        }
        
        /* Action buttons */
        .action-btns {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: all 0.2s;
        }
        
        .btn-action.view { background: #e3f2fd; color: #1976d2; }
        .btn-action.edit { background: #fff3e0; color: #e65100; }
        .btn-action.delete { background: #ffebee; color: #c62828; }
        
        .btn-action:hover { transform: scale(1.1); }
        
        /* Pagination */
        .table-footer {
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        
        .modal-header {
            border-bottom: 1px solid #e9ecef;
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
            <!-- Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="font-weight: 600;">Kelola Menu</h1>
                            <p class="text-muted mb-0">Kelola daftar menu roti Wijaya Bakery</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Menu</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="page-card">
                        <!-- Header with search and add button -->
                        <div class="page-header">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari menu...">
                            </div>
                            <a href="{{ route('admin.menu.create') }}" class="btn btn-add">
                                <i class="fas fa-plus mr-2"></i>Tambah Menu
                            </a>
                        </div>
                        
                        <!-- Table -->
                        <div class="table-responsive">
                            @if($menus->count() > 0)
                                <table class="table clean-table" id="menuTable">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th style="width: 120px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($menus as $menu)
                                            <tr>
                                                <td>
                                                    <div class="menu-info">
                                                        <img loading="lazy" src="{{ $menu->gambar_menu ? asset('storage/uploads/menu/' . $menu->gambar_menu) : 'https://via.placeholder.com/50x50?text=No+Img' }}" 
                                                             alt="{{ $menu->nama_menu }}" class="menu-img">
                                                        <div>
                                                            <div class="menu-name">{{ $menu->nama_menu }}</div>
                                                            <div class="menu-desc">{{ Str::limit($menu->deskripsi_menu, 40) }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge-kategori">{{ $menu->kategori->nama_kategori ?? '-' }}</span>
                                                </td>
                                                <td>
                                                    <span class="price-tag">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                                </td>
                                                <td>
                                                    @if($menu->stok < 10)
                                                        <span class="badge-stock low">{{ $menu->stok }}</span>
                                                    @elseif($menu->stok < 30)
                                                        <span class="badge-stock medium">{{ $menu->stok }}</span>
                                                    @else
                                                        <span class="badge-stock high">{{ $menu->stok }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="action-btns">
                                                        <a href="{{ route('admin.menu.show', $menu->id) }}" class="btn-action view" title="Lihat Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn-action edit" title="Edit">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <button class="btn-action delete delete-btn" 
                                                                data-toggle="modal" 
                                                                data-target="#deleteModal"
                                                                data-id="{{ $menu->id }}" 
                                                                data-name="{{ $menu->nama_menu }}"
                                                                title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-bread-slice"></i>
                                    <h5>Belum ada menu</h5>
                                    <p>Klik tombol "Tambah Menu" untuk menambahkan menu pertama</p>
                                </div>
                            @endif
                        </div>
                        
                        @if($menus->count() > 0)
                            <div class="table-footer">
                                <div class="table-info">
                                    Menampilkan {{ $menus->count() }} menu
                                </div>
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
                    <p>Apakah Anda yakin ingin menghapus menu <strong id="menuName"></strong>?</p>
                    <p class="text-muted small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
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
        $(document).ready(function() {
            // Search functionality
            $('#searchInput').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $('#menuTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
            
            // Delete modal
            $('.delete-btn').click(function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                $('#menuName').text(name);
                $('#deleteForm').attr('action', '{{ url("mng-menu") }}/' + id);
            });
            
            // Toast notification
            @if(session('success') || session('error'))
                $('#toastNotification').toast({ delay: 3000 }).toast('show');
            @endif
        });
    </script>
</body>
</html>




