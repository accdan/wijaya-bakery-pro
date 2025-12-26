<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sponsor || Wijaya Bakery</title>
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
            max-width: 800px;
            margin: 0 auto;
        }

        .form-header {
            background: linear-gradient(135deg, #f59e0b, #d97706);
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

        .form-section {
            margin-bottom: 2rem;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            color: #f59e0b;
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
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }

        /* Image upload */
        .upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.2s;
            cursor: pointer;
            background: #f8f9fa;
        }

        .upload-area:hover {
            border-color: #f59e0b;
            background: #fff7ed;
        }

        .upload-area.has-image {
            padding: 1rem;
        }

        .upload-preview {
            max-width: 300px;
            max-height: 200px;
            border-radius: 8px;
            object-fit: contain;
            display: none;
        }

        .upload-icon {
            font-size: 2.5rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .upload-text {
            color: #6c757d;
        }

        .upload-text strong {
            color: #f59e0b;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            gap: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
            margin-top: 2rem;
        }

        .btn-save {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
            color: white;
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
                            <h1 class="m-0" style="font-weight: 600;">Tambah Sponsor</h1>
                            <p class="text-muted mb-0">Tambahkan partner sponsor baru</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.sponsor.index') }}">Sponsor</a>
                                </li>
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
                            <h4><i class="fas fa-plus-circle mr-2"></i>Form Sponsor Baru</h4>
                            <p>Isi detail sponsor yang ingin ditambahkan</p>
                        </div>

                        <div class="form-body">
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.sponsor.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Basic Info -->
                                <div class="form-section">
                                    <h6 class="section-title"><i class="fas fa-info-circle"></i> Informasi Sponsor</h6>

                                    <div class="mb-3">
                                        <label class="form-label">Nama Sponsor <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="nama_sponsor"
                                            class="form-control @error('nama_sponsor') is-invalid @enderror"
                                            value="{{ old('nama_sponsor') }}" placeholder="Contoh: PT. Indofood"
                                            required>
                                        @error('nama_sponsor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                        <textarea name="deskripsi_sponsor" rows="3"
                                            class="form-control @error('deskripsi_sponsor') is-invalid @enderror"
                                            placeholder="Jelaskan tentang sponsor ini..."
                                            required>{{ old('deskripsi_sponsor') }}</textarea>
                                        @error('deskripsi_sponsor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Logo -->
                                <div class="form-section">
                                    <h6 class="section-title"><i class="fas fa-image"></i> Logo Sponsor</h6>

                                    <div class="upload-area" id="uploadArea"
                                        onclick="document.getElementById('logo_sponsor').click()">
                                        <img loading="lazy" id="preview" class="upload-preview" src="">
                                        <div id="uploadPlaceholder">
                                            <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                            <p class="upload-text">
                                                <strong>Klik untuk upload</strong> atau drag & drop<br>
                                                <small>PNG, JPG, WEBP (Max 2MB, 300×150px disarankan)</small>
                                            </p>
                                        </div>
                                        <input type="file" id="logo_sponsor" name="logo_sponsor" accept="image/*"
                                            style="display: none;">
                                    </div>
                                    @error('logo_sponsor')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Actions -->
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-save">
                                        <i class="fas fa-save mr-2"></i>Simpan Sponsor
                                    </button>
                                    <a href="{{ route('admin.sponsor.index') }}" class="btn btn-cancel">
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
        document.getElementById('logo_sponsor').addEventListener('change', function (e) {
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