<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Detail Menu</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
        }
        .menu-img {
            width: 100%;
            max-width: 180px;
            height: auto;
            object-fit: cover;
            border: 3px solid #dee2e6;
            border-radius: 10px;
        }
        .table th {
            background-color: #f8f9fa;
        }
        @media (max-width: 768px) {
            .card {
                margin: 0 10px;
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
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0">Detail Menu</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid d-flex justify-content-center">
                    <div class="card shadow-lg w-100" style="max-width: 800px;">
                        <div class="card-header bg-warning">
                            <h3 class="card-title mb-0 text-white"><i class="fas fa-utensils"></i> Informasi Menu</h3>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-4 text-center mb-3">
                                    <img src="{{ $menu->gambar_menu ? asset('uploads/menu/' . $menu->gambar_menu) : asset('image/default-food.png') }}"
     class="menu-img img-fluid rounded" alt="Foto Menu">
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>ID Menu</th>
                                                <td>{{ $menu->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Menu</th>
                                                <td>{{ $menu->nama_menu }}</td>
                                            </tr>
                                            {{-- <tr>
                                                <th>Deskripsi</th>
                                                <td>{{ $menu->deskripsi_menu }}</td>
                                            </tr>
                                            <tr>
                                                <th>Prosedur</th>
                                                <td>{{ $menu->prosedur }}</td>
                                            </tr> --}}
                                            <tr>
                                                <th>Kategori</th>
                                                <td>{{ $menu->kategori->nama_kategori ?? '-' }}</td>
                                            </tr>
                                            {{-- <tr>
                                                <th>Foto Menu</th>
                                                <td class="text-center">
                                                    <img src="{{ $menu->gambar_menu ? asset('public/' . $menu->gambar_menu) : asset('uploads/menu') }}"
                                                         class="menu-img img-fluid rounded" alt="Foto Menu">
                                                </td>
                                            </tr> --}}
                                            <tr>
                                                <th>Dibuat pada</th>
                                                <td>{{ $menu->created_at->translatedFormat('d F Y H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Terakhir diubah</th>
                                                <td>{{ $menu->updated_at->translatedFormat('d F Y H:i') }}</td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
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
