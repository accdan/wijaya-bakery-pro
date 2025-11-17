<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Detail Pesanan</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icondapur.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('include.navbarSistem')
    @include('include.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-shopping-cart"></i> Detail Pesanan</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-sm-right">
                            <a href="{{ route('admin.pesanan.edit', $pesanan->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.pesanan.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow">
                            <div class="card-header bg-info text-white">
                                <h3 class="card-title"><i class="fas fa-info-circle"></i> Informasi Pesanan</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><strong><i class="fas fa-user"></i> Nama Pemesan</strong></label>
                                            <p class="form-control-plaintext">{{ $pesanan->nama_pemesan }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><strong><i class="fas fa-id-card"></i> ID Pesanan</strong></label>
                                            <p class="form-control-plaintext">{{ $pesanan->id }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><strong><i class="fas fa-phone"></i> Nomor Telepon</strong></label>
                                            <p class="form-control-plaintext">{{ $pesanan->no_hp }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><strong><i class="fas fa-calendar"></i> Tanggal Pesan</strong></label>
                                            <p class="form-control-plaintext">{{ $pesanan->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-header bg-success text-white">
                                <h3 class="card-title"><i class="fas fa-utensils"></i> Detail Menu</h3>
                            </div>
                            <div class="card-body">
                                @if($pesanan->menu)
                                    <div class="text-center mb-3">
                                        <img src="{{ asset('uploads/menu/' . $pesanan->menu->gambar_menu) }}" alt="{{ $pesanan->menu->nama_menu }}" class="img-fluid rounded" style="max-height: 150px;">
                                    </div>
                                    <h5 class="text-center">{{ $pesanan->menu->nama_menu }}</h5>
                                    <hr>
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <strong>Harga Satuan</strong>
                                            <br>Rp {{ number_format($pesanan->harga_satuan, 0, ',', '.') }}
                                        </div>
                                        <div class="col-6">
                                            <strong>Jumlah</strong>
                                            <br>{{ $pesanan->jumlah }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <h4 class="text-success">Total: Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</h4>
                                    </div>
                                @else
                                    <div class="alert alert-warning text-center">
                                        <i class="fas fa-exclamation-triangle"></i> Informasi menu tidak tersedia.
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($pesanan->catatan)
                            <div class="card shadow">
                                <div class="card-header bg-warning text-white">
                                    <h3 class="card-title"><i class="fas fa-sticky-note"></i> Catatan Khusus</h3>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">{{ $pesanan->catatan }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-receipt"></i> Ringkasan Pesanan</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Detail</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $pesanan->menu->nama_menu ?? 'Menu tidak tersedia' }}</td>
                                                <td>{{ $pesanan->menu->deskripsi_menu ?? '-' }}</td>
                                                <td>Rp {{ number_format($pesanan->harga_satuan, 0, ',', '.') }}</td>
                                                <td>{{ $pesanan->jumlah }}</td>
                                                <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="font-weight-bold">
                                                <td colspan="4" class="text-right">TOTAL PESANAN:</td>
                                                <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">
                                    <i class="fas fa-clock"></i> Dibuat pada {{ $pesanan->created_at->format('d F Y') }} pukul {{ $pesanan->created_at->format('H:i') }}
                                    @if($pesanan->updated_at != $pesanan->created_at)
                                        <br><i class="fas fa-edit"></i> Terakhir diperbarui pada {{ $pesanan->updated_at->format('d F Y') }} pukul {{ $pesanan->updated_at->format('H:i') }}
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('include.footerSistem')
</div>

@include('services.logoutModal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
