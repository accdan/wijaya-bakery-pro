<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu || Wijaya Bakery</title>
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
            color: #ffc107;
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
            padding: 1.5rem;
            text-align: center;
            transition: all 0.2s;
            cursor: pointer;
            background: #f8f9fa;
        }

        .upload-area:hover {
            border-color: #ffc107;
            background: #fffef5;
        }

        .current-image {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
            object-fit: cover;
            margin-bottom: 1rem;
        }

        .upload-text {
            color: #6c757d;
            font-size: 0.9rem;
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
                            <h1 class="m-0" style="font-weight: 600;">Edit Menu</h1>
                            <p class="text-muted mb-0">Perbarui informasi menu</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">Menu</a></li>
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
                            <h4><i class="fas fa-edit mr-2"></i>Edit: {{ $menu->nama_menu }}</h4>
                            <p>Perbarui detail menu</p>
                        </div>

                        <div class="form-body">
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <!-- Basic Info -->
                                <div class="form-section">
                                    <h6 class="section-title"><i class="fas fa-info-circle"></i> Informasi Dasar</h6>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Menu <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="nama_menu"
                                                class="form-control @error('nama_menu') is-invalid @enderror"
                                                value="{{ old('nama_menu', $menu->nama_menu) }}" required>
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
                                                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $menu->kategori_id) == $kategori->id ? 'selected' : '' }}>
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
                                            required>{{ old('deskripsi_menu', $menu->deskripsi_menu) }}</textarea>
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
                                                    value="{{ old('harga', $menu->harga) }}" required>
                                            </div>
                                            @error('harga')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Stok <span class="text-danger">*</span></label>
                                            <input type="number" name="stok" min="0"
                                                class="form-control @error('stok') is-invalid @enderror"
                                                value="{{ old('stok', $menu->stok) }}" required>
                                            @error('stok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="form-section">
                                    <h6 class="section-title"><i class="fas fa-image"></i> Gambar Menu</h6>

                                    <div class="upload-area" onclick="document.getElementById('gambar_menu').click()">
                                        <img loading="lazy" id="preview" class="current-image"
                                            src="{{ $menu->gambar_menu ? asset('storage/uploads/menu/' . $menu->gambar_menu) : 'https://via.placeholder.com/150x150?text=No+Image' }}">
                                        <p class="upload-text mb-0">
                                            <i class="fas fa-camera mr-1"></i>Klik untuk ganti gambar<br>
                                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah</small>
                                        </p>
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
                                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
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
                    document.getElementById('preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>



