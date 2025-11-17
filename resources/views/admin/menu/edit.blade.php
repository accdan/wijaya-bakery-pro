<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Ubah Menu</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css"/>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('include.navbarSistem')
    @include('include.sidebar')

    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0"><i class="fas fa-edit"></i> Ubah Menu</h1>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title"><i class="fas fa-pen"></i> Form Ubah Menu</h3>
                    </div>

                    <div class="card-body">

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <!-- Nama Menu -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-tag"></i> Nama Menu</label>
                                        <input type="text" 
                                            name="nama_menu"
                                            class="form-control @error('nama_menu') is-invalid @enderror"
                                            value="{{ old('nama_menu', $menu->nama_menu) }}" required>
                                        @error('nama_menu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kategori -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-folder"></i> Kategori</label>
                                        <select name="kategori_id" 
                                            class="form-control @error('kategori_id') is-invalid @enderror"
                                            required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}" 
                                                    {{ old('kategori_id', $menu->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                                    {{ $kategori->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Harga dan Stok -->
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-money-bill"></i> Harga</label>
                                        <input type="number" min="0"
                                            name="harga"
                                            value="{{ old('harga', $menu->harga) }}"
                                            class="form-control @error('harga') is-invalid @enderror"
                                            required>
                                        @error('harga')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-box"></i> Stok</label>
                                        <input type="number" min="0"
                                            name="stok"
                                            value="{{ old('stok', $menu->stok) }}"
                                            class="form-control @error('stok') is-invalid @enderror"
                                            required>
                                        @error('stok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-group">
                                <label><i class="fas fa-info-circle"></i> Deskripsi</label>
                                <textarea name="deskripsi_menu" 
                                    rows="3"
                                    class="form-control @error('deskripsi_menu') is-invalid @enderror"
                                    required>{{ old('deskripsi_menu', $menu->deskripsi_menu) }}</textarea>
                                @error('deskripsi_menu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gambar -->
                            <div class="card mt-3">
                                <div class="card-header bg-light">
                                    <strong><i class="fas fa-image"></i> Gambar Menu</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row align-items-center">

                                        <!-- Preview -->
                                        <div class="col-md-6 text-center">

                                            <div style="width: 220px; height: 230px; border: 1px dashed #bbb;
                                                        margin: 0 auto 12px; display: flex; align-items: center;
                                                        justify-content: center; border-radius: 8px; background: #f9f9f9;">
                                                <img id="preview"
                                                    src="{{ $menu->gambar_menu ? asset('uploads/menu/' . $menu->gambar_menu) 
                                                    : 'https://via.placeholder.com/220x230?text=Preview' }}"
                                                    class="img-fluid rounded"
                                                    style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                            </div>

                                            <input type="file" 
                                                class="form-control-file @error('gambar_menu') is-invalid @enderror"
                                                name="gambar_menu"
                                                id="gambar_menu"
                                                accept="image/*"
                                                style="font-size: 14px; max-width: 220px;">

                                            @error('gambar_menu')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Tabel ukuran gambar -->
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped mx-auto"
                                                    style="max-width: 380px; font-size: 14px;">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th>Platform</th>
                                                            <th>Ukuran</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Desktop, Tablet & Mobile</td>
                                                            <td><strong>220 × 230 px</strong></td>
                                                            <td>Format portrait</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Format disarankan</td>
                                                            <td>.jpg / .webp</td>
                                                            <td>Kualitas bagus, file kecil</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <input type="hidden" name="cropped_image" id="cropped_image">
                            </div>

                            <!-- Tombol -->
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Batal
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

@include('services.logoutModal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<script>
    let cropper;
    const image = document.getElementById('preview');
    const input = document.getElementById('gambar_menu');

    function initCropper() {
        if (cropper) cropper.destroy();
        cropper = new Cropper(image, {
            aspectRatio: 220 / 230,
            viewMode: 1,
            autoCropArea: 1,
            crop() {
                const canvas = cropper.getCroppedCanvas({ width: 220, height: 230 });
                canvas.toBlob(blob => {
                    const reader = new FileReader();
                    reader.onloadend = () => {
                        document.getElementById('cropped_image').value = reader.result;
                    };
                    reader.readAsDataURL(blob);
                });
            }
        });
    }

    window.onload = initCropper;

    input.addEventListener('change', e => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = () => {
            image.src = reader.result;
            initCropper();
        };
        reader.readAsDataURL(file);
    });
</script>

</body>
</html>
