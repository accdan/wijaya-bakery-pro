<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Detail Pengguna</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/icondapur.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
        }
        .profile-img {
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
                            <h1 class="m-0">Detail Pengguna</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid d-flex justify-content-center">
                    <div class="card shadow-lg w-100" style="max-width: 800px;">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title mb-0">Informasi Pengguna</h3>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-4 text-center mb-3">
                                    <img loading="lazy" src="{{ $user->profile_picture ? asset('storage/uploads/profile/' . $user->profile_picture) : asset('storage/image/default-avatar.png') }}"
                                        class="profile-img img-fluid rounded" alt="Foto Profil">
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th style="width: 40%;">ID Pengguna</th>
                                                <td>{{ $user->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <td>{{ $user->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Username</th>
                                                <td>{{ $user->username }}</td>
                                            </tr>
                                            <tr>
                                                <th>Peran</th>
                                                <td>{{ $user->role->role_name ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
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




