<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Hero || Wijaya Bakery</title>
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
            background: linear-gradient(135deg, #9c27b0, #7b1fa2);
            padding: 1.5rem 2rem;
            color: white;
        }

        .form-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .form-header p {
            margin: 0.25rem 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .form-body {
            padding: 2rem;
        }

        /* Upload area */
        .upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.2s;
            cursor: pointer;
            background: #f8f9fa;
            margin-bottom: 1.5rem;
        }

        .upload-area:hover {
            border-color: #9c27b0;
            background: #faf5fb;
        }

        .upload-area.has-image {
            padding: 1rem;
            background: white;
        }

        .upload-preview {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            object-fit: cover;
            display: none;
        }

        .upload-icon {
            font-size: 3rem;
            color: #9c27b0;
            margin-bottom: 1rem;
            opacity: 0.6;
        }

        .upload-text {
            color: #6c757d;
        }

        .upload-text strong {
            color: #9c27b0;
        }

        /* Status toggle */
        .status-toggle {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
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

        /* Tips */
        .tips-box {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }

        .tips-box h6 {
            color: #e65100;
            margin-bottom: 0.5rem;
        }

        .tips-box ul {
            margin: 0;
            padding-left: 1.25rem;
            color: #bf360c;
            font-size: 0.85rem;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            gap: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
            margin-top: 1.5rem;
        }

        .btn-save {
            background: linear-gradient(135deg, #9c27b0, #7b1fa2);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(156, 39, 176, 0.3);
            color: white;
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
                            <h1 class="m-0" style="font-weight: 600;">Tambah Hero</h1>
                            <p class="text-muted mb-0">Upload gambar baru untuk landing page</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.hero.index') }}">Hero</a></li>
                                <li class="breadcrumb-item active">Tambah</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="form-card">
                        <div class="form-header">
                            <h4><i class="fas fa-image mr-2"></i>Upload Gambar Hero</h4>
                            <p>Gambar akan ditampilkan di halaman utama</p>
                        </div>

                        <div class="form-body">
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="tips-box">
                                    <h6><i class="fas fa-lightbulb mr-1"></i>Tips Upload</h6>
                                    <ul>
                                        <li>Ukuran optimal: <strong>1920 × 1080 piksel</strong></li>
                                        <li>Format: JPG, PNG, atau WEBP</li>
                                        <li>Maksimal ukuran file: 5MB</li>
                                    </ul>
                                </div>

                                <div class="upload-area" id="uploadArea"
                                    onclick="document.getElementById('gambar').click()">
                                    <img loading="lazy" id="preview" class="upload-preview" src="">
                                    <div id="uploadPlaceholder">
                                        <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                        <p class="upload-text">
                                            <strong>Klik untuk upload</strong> atau drag & drop<br>
                                            <small>Gambar akan ditampilkan sebagai background hero</small>
                                        </p>
                                    </div>
                                    <input type="file" id="gambar" name="gambar" accept="image/*" style="display: none;"
                                        required>
                                </div>
                                @error('gambar')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror

                                <div class="status-toggle">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status"
                                            value="1" checked>
                                        <label class="custom-control-label" for="status"></label>
                                    </div>
                                    <div>
                                        <strong>Status Aktif</strong>
                                        <p class="text-muted small mb-0">Gambar akan langsung ditampilkan di homepage
                                        </p>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-save">
                                        <i class="fas fa-save mr-2"></i>Upload & Simpan
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
                    const preview = document.getElementById('preview');
                    const placeholder = document.getElementById('uploadPlaceholder');
                    const area = document.getElementById('uploadArea');

                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                    area.classList.add('has-image');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>



