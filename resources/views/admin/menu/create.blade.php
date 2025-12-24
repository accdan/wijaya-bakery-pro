<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu || Wijaya Bakery</title>
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
            background: linear-gradient(135deg, #28a745, #20c997);
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
            color: #28a745;
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
            border-color: #28a745;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
        }

        .input-group-text {
            background: #f8f9fa;
            border-radius: 8px 0 0 8px;
            border: 1px solid #dee2e6;
            border-right: none;
        }

        .input-group .form-control {
            border-radius: 0 8px 8px 0;
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
            border-color: #28a745;
            background: #f1fff4;
        }

        .upload-area.has-image {
            padding: 1rem;
        }

        .upload-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            object-fit: cover;
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
            color: #28a745;
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
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
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

        /* Helper text */
        .form-text {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.25rem;
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
                            <h1 class="m-0" style="font-weight: 600;">Tambah Menu</h1>
                            <p class="text-muted mb-0">Buat menu baru untuk katalog</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">Menu</a></li>
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
                            <h4><i class="fas fa-plus-circle mr-2"></i>Form Menu Baru</h4>
                            <p>Isi detail menu yang ingin ditambahkan</p>
                        </div>

                        <div class="form-body">
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Basic Info -->
                                <div class="form-section">
                                    <h6 class="section-title"><i class="fas fa-info-circle"></i> Informasi Dasar</h6>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Menu <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="nama_menu"
                                                class="form-control @error('nama_menu') is-invalid @enderror"
                                                value="{{ old('nama_menu') }}" placeholder="Contoh: Roti Coklat"
                                                required>
                                            @error('nama_menu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Kategori <span
                                                    class="text-danger">*</span></label>
                                            <select name="kategori_id"
                                                class="form-control @error('kategori_id') is-invalid @enderror"
                                                required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                        {{ $kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kategori_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                        <textarea name="deskripsi_menu" rows="3"
                                            class="form-control @error('deskripsi_menu') is-invalid @enderror"
                                            placeholder="Jelaskan menu ini..."
                                            required>{{ old('deskripsi_menu') }}</textarea>
                                        @error('deskripsi_menu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Price & Stock -->
                                <div class="form-section">
                                    <h6 class="section-title"><i class="fas fa-tags"></i> Harga & Stok</h6>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Harga <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="number" name="harga" min="0"
                                                    class="form-control @error('harga') is-invalid @enderror"
                                                    value="{{ old('harga') }}" placeholder="0" required>
                                            </div>
                                            @error('harga')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Stok <span class="text-danger">*</span></label>
                                            <input type="number" name="stok" min="0"
                                                class="form-control @error('stok') is-invalid @enderror"
                                                value="{{ old('stok') }}" placeholder="0" required>
                                            @error('stok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="form-section">
                                    <h6 class="section-title"><i class="fas fa-image"></i> Gambar Menu</h6>

                                    <div class="upload-area" id="uploadArea"
                                        onclick="document.getElementById('gambar_menu').click()">
                                        <img loading="lazy" id="preview" class="upload-preview" src="">
                                        <div id="uploadPlaceholder">
                                            <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                            <p class="upload-text">
                                                <strong>Klik untuk upload</strong> atau drag & drop<br>
                                                <small>JPG, PNG, WEBP (Max 2MB, 220×230px)</small>
                                            </p>
                                        </div>
                                        <input type="file" id="gambar_menu" name="gambar_menu" accept="image/*"
                                            style="display: none;">
                                    </div>
                                    @error('gambar_menu')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Actions -->
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-save">
                                        <i class="fas fa-save mr-2"></i>Simpan Menu
                                    </button>
                                    <a href="{{ route('admin.menu.index') }}" class="btn btn-cancel">
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
        document.getElementById('gambar_menu').addEventListener('change', function (e) {
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



