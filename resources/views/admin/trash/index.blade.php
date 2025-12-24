<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trash Management || Wijaya Bakery Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/logo1.png') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
            background-color: #f4f6f9;
        }

        .trash-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .trash-card .card-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.25rem;
        }

        .trash-card .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: #343a40;
        }

        .type-tabs {
            display: flex;
            gap: 0.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .type-tab {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .type-tab.active {
            background: #343a40;
            color: white;
        }

        .type-tab:not(.active) {
            background: white;
            color: #495057;
            border: 1px solid #dee2e6;
        }

        .type-tab:not(.active):hover {
            background: #e9ecef;
            text-decoration: none;
            color: #212529;
        }

        .type-tab .badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
        }

        .trash-item {
            display: flex;
            align-items: center;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #e9ecef;
            transition: background 0.2s;
        }

        .trash-item:hover {
            background: #f8f9fa;
        }

        .trash-item:last-child {
            border-bottom: none;
        }

        .trash-item-img {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 1rem;
            background: #e9ecef;
        }

        .trash-item-info {
            flex: 1;
        }

        .trash-item-name {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 0.25rem;
        }

        .trash-item-meta {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .trash-item-actions {
            display: flex;
            gap: 0.5rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        .btn-action {
            border-radius: 6px;
            font-weight: 500;
        }

        .bulk-actions {
            padding: 1rem 1.25rem;
            background: #fff3cd;
            border-bottom: 1px solid #ffc107;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .deleted-date {
            font-size: 0.8rem;
            color: #dc3545;
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
                            <h1 class="m-0" style="font-weight: 600;">
                                <i class="fas fa-trash-alt mr-2"></i>Trash Management
                            </h1>
                            <p class="text-muted mb-0">Pulihkan atau hapus permanen item yang sudah dihapus</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Trash</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="trash-card">
                        <!-- Type Tabs -->
                        <div class="type-tabs">
                            <a href="{{ url('mng-trash?type=menu') }}" 
                               class="type-tab {{ $type === 'menu' ? 'active' : '' }}">
                                <i class="fas fa-bread-slice"></i> Menu
                                @if($counts['menu'] > 0)
                                    <span class="badge badge-danger">{{ $counts['menu'] }}</span>
                                @endif
                            </a>
                            <a href="{{ url('mng-trash?type=kategori') }}" 
                               class="type-tab {{ $type === 'kategori' ? 'active' : '' }}">
                                <i class="fas fa-th-list"></i> Kategori
                                @if($counts['kategori'] > 0)
                                    <span class="badge badge-danger">{{ $counts['kategori'] }}</span>
                                @endif
                            </a>
                            <a href="{{ url('mng-trash?type=sponsor') }}" 
                               class="type-tab {{ $type === 'sponsor' ? 'active' : '' }}">
                                <i class="fas fa-handshake"></i> Sponsor
                                @if($counts['sponsor'] > 0)
                                    <span class="badge badge-danger">{{ $counts['sponsor'] }}</span>
                                @endif
                            </a>
                            <a href="{{ url('mng-trash?type=pesanan') }}" 
                               class="type-tab {{ $type === 'pesanan' ? 'active' : '' }}">
                                <i class="fas fa-shopping-bag"></i> Pesanan
                                @if($counts['pesanan'] > 0)
                                    <span class="badge badge-danger">{{ $counts['pesanan'] }}</span>
                                @endif
                            </a>
                        </div>

                        <!-- Bulk Actions -->
                        @if($trashedItems->count() > 0)
                        <div class="bulk-actions">
                            <span>
                                <i class="fas fa-info-circle mr-1"></i>
                                {{ $trashedItems->count() }} item di trash
                            </span>
                            <div>
                                <form action="{{ url('mng-trash/restore-all/' . $type) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm btn-action">
                                        <i class="fas fa-undo mr-1"></i> Pulihkan Semua
                                    </button>
                                </form>
                                <form action="{{ url('mng-trash/empty/' . $type) }}" method="POST" style="display: inline;"
                                      onsubmit="return confirm('PERINGATAN: Semua item akan dihapus permanen dan tidak dapat dikembalikan. Lanjutkan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-action">
                                        <i class="fas fa-trash mr-1"></i> Kosongkan Trash
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endif

                        <!-- Trash Items -->
                        <div class="card-body p-0">
                            @if($trashedItems->count() > 0)
                                @foreach($trashedItems as $item)
                                    <div class="trash-item">
                                        @if($type === 'menu' && $item->gambar_menu)
                                            <img loading="lazy" src="{{ asset('storage/uploads/menu/' . $item->gambar_menu) }}" 
                                                 alt="{{ $item->nama_menu }}" class="trash-item-img">
                                        @elseif($type === 'sponsor' && $item->logo_sponsor)
                                            <img loading="lazy" src="{{ asset('storage/uploads/sponsor/' . $item->logo_sponsor) }}" 
                                                 alt="{{ $item->nama_sponsor }}" class="trash-item-img">
                                        @else
                                            <div class="trash-item-img d-flex align-items-center justify-content-center">
                                                <i class="fas fa-{{ $type === 'menu' ? 'bread-slice' : ($type === 'kategori' ? 'th-list' : ($type === 'sponsor' ? 'handshake' : 'shopping-bag')) }} text-muted"></i>
                                            </div>
                                        @endif

                                        <div class="trash-item-info">
                                            <div class="trash-item-name">
                                                @switch($type)
                                                    @case('menu')
                                                        {{ $item->nama_menu }}
                                                        @break
                                                    @case('kategori')
                                                        {{ $item->nama_kategori }}
                                                        @break
                                                    @case('sponsor')
                                                        {{ $item->nama_sponsor }}
                                                        @break
                                                    @case('pesanan')
                                                        #{{ $item->id }} - {{ $item->menu->nama_menu ?? 'Menu Dihapus' }}
                                                        @break
                                                @endswitch
                                            </div>
                                            <div class="trash-item-meta">
                                                @switch($type)
                                                    @case('menu')
                                                        {{ $item->kategori->nama_kategori ?? '-' }} • Rp {{ number_format($item->harga, 0, ',', '.') }}
                                                        @break
                                                    @case('kategori')
                                                        Kategori Menu
                                                        @break
                                                    @case('sponsor')
                                                        {{ Str::limit($item->deskripsi_sponsor, 50) }}
                                                        @break
                                                    @case('pesanan')
                                                        {{ $item->jumlah }} x Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                                        @break
                                                @endswitch
                                            </div>
                                            <div class="deleted-date">
                                                <i class="fas fa-clock mr-1"></i>
                                                Dihapus: {{ $item->deleted_at->format('d M Y H:i') }}
                                            </div>
                                        </div>

                                        <div class="trash-item-actions">
                                            <form action="{{ url('mng-trash/restore/' . $type . '/' . $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm btn-action" title="Pulihkan">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            </form>
                                            <form action="{{ url('mng-trash/delete/' . $type . '/' . $item->id) }}" method="POST"
                                                  onsubmit="return confirm('Hapus permanen item ini? Aksi tidak dapat dibatalkan.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-action" title="Hapus Permanen">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-trash-alt"></i>
                                    <h5>Trash Kosong</h5>
                                    <p>Tidak ada {{ $type }} yang dihapus.</p>
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

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>
