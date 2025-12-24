<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hero || Wijaya Bakery</title>
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
            max-width: 700px;
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

        /* Current image */
        .current-image-container {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .current-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            display: block;
        }

        .change-image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            padding: 2rem 1rem 1rem;
            color: white;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .change-image-overlay:hover {
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.85));
        }

        .change-image-overlay i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        /* Status toggle */
        .status-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .status-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .status-info h6 {
            margin: 0;
            font-weight: 600;
        }

        .status-info p {
            margin: 0;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .custom-switch .custom-control-label::before {
            width: 48px;
            height: 24px;
            border-radius: 24px;
        }

        .custom-switch .custom-control-label::after {
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }

        .custom-switch .custom-control-input:checked~.custom-control-label::after {
            transform: translateX(24px);
        }

        /* Buttons */
        .form-actions {
            display: flex;
            gap: 1rem;
            padding-top: 1.5rem;
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
                            <h1 class="m-0" style="font-weight: 600;">Edit Hero</h1>
                            <p class="text-muted mb-0">Perbarui gambar landing page</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.hero.index') }}">Hero</a></li>
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
                            <h4><i class="fas fa-edit mr-2"></i>Edit Gambar Hero</h4>
                            <p>Perbarui gambar atau status</p>
                        </div>

                        <div class="form-body">
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.hero.update', $hero->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="current-image-container"
                                    onclick="document.getElementById('gambar').click()">
                                    <img loading="lazy" id="preview" class="current-image"
                                        src="{{ $hero->gambar ? asset('storage/uploads/hero/' . $hero->gambar) : 'https://via.placeholder.com/700x300?text=No+Image' }}">
                                    <div class="change-image-overlay">
                                        <i class="fas fa-camera"></i>
                                        <span>Klik untuk ganti gambar</span>
                                    </div>
                                    <input type="file" id="gambar" name="gambar" accept="image/*"
                                        style="display: none;">
                                </div>
                                @error('gambar')
                                    <div class="text-danger small mb-3">{{ $message }}</div>
                                @enderror

                                <div class="status-section">
                                    <div class="status-header">
                                        <div class="status-info">
                                            <h6>Status Tampilan</h6>
                                            <p>Aktifkan untuk menampilkan di homepage</p>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="status"
                                                name="status" value="1" {{ $hero->status ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-save">
                                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                    </button>
                                    <a href="{{ route('admin.hero.index') }}" class="btn btn-cancel">
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

    <script>
        document.getElementById('gambar').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>



