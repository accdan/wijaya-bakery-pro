<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori || Wijaya Bakery</title>
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

        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
            max-width: 500px;
            margin: 0 auto;
        }

        .form-header {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            padding: 1.5rem 2rem;
            color: #212529;
        }

        .form-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .form-header p {
            margin: 0.25rem 0 0;
            opacity: 0.8;
            font-size: 0.9rem;
        }

        .form-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 0.75rem 1rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
            border-top: 1px solid #e9ecef;
        }

        .btn-save {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            color: #212529;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
            color: #212529;
        }

        .btn-cancel {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            color: #495057;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #e9ecef;
            color: #343a40;
        }

        .icon-preview {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #ffc107, #ffb300);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #212529;
            font-size: 1.5rem;
            margin: 0 auto 1.5rem;
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
                            <h1 class="m-0" style="font-weight: 600;">Edit Kategori</h1>
                            <p class="text-muted mb-0">Perbarui nama kategori</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.kategori.index') }}">Kategori</a>
                                </li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="form-card">
                        <div class="form-header">
                            <h4><i class="fas fa-edit mr-2"></i>Edit Kategori</h4>
                            <p>{{ $kategori->nama_kategori }}</p>
                        </div>

                        <div class="form-body">
                            <div class="icon-preview">
                                <i class="fas fa-folder"></i>
                            </div>

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="mb-3">
                                    <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_kategori"
                                        class="form-control @error('nama_kategori') is-invalid @enderror"
                                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required autofocus>
                                    @error('nama_kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-save">
                                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                    </button>
                                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-cancel">
                                        <i class="fas fa-times mr-2"></i>Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    @include('services.LogoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>



