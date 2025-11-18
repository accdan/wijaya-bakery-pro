<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Ubah Promo</title>
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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ubah Promo</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-edit"></i> Form Ubah Promo</h3>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('admin.promo.update', $promo->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_promo">Nama Promo</label>
                                        <input type="text" class="form-control @error('nama_promo') is-invalid @enderror" name="nama_promo" value="{{ old('nama_promo', $promo->nama_promo) }}" required>
                                        @error('nama_promo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi_promo">Deskripsi</label>
                                        <textarea name="deskripsi_promo" rows="4" class="form-control @error('deskripsi_promo') is-invalid @enderror">{{ old('deskripsi_promo', $promo->deskripsi_promo) }}</textarea>
                                        @error('deskripsi_promo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <!-- Discount Configuration -->
                                    <div class="card border-primary">
                                        <div class="card-header bg-primary text-white">
                                            <h6 class="mb-0"><i class="fas fa-percentage"></i> Konfigurasi Diskon</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="menu_id">Menu (Opsional)</label>
                                                <select name="menu_id" class="form-control @error('menu_id') is-invalid @enderror">
                                                    <option value="">-- Semua Menu --</option>
                                                    @foreach(\App\Models\Menu::all() as $menu)
                                                        <option value="{{ $menu->id }}" {{ old('menu_id', $promo->menu_id) == $menu->id ? 'selected' : '' }}>
                                                            {{ $menu->nama_menu }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <small class="text-muted">Kosongkan jika diskon berlaku untuk semua menu</small>
                                                @error('menu_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="min_quantity">Jumlah Minimal Pembelian</label>
                                                <input type="number" class="form-control @error('min_quantity') is-invalid @enderror" name="min_quantity"
                                                       value="{{ old('min_quantity', $promo->min_quantity ?? 1) }}" min="1" required>
                                                <small class="text-muted">Minimal jumlah item yang harus dibeli</small>
                                                @error('min_quantity')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="discount_type">Tipe Diskon</label>
                                                <select name="discount_type" class="form-control @error('discount_type') is-invalid @enderror" id="discount_type" required>
                                                    <option value="fixed" {{ old('discount_type', $promo->discount_type) == 'fixed' ? 'selected' : '' }}>Nominal (Rp)</option>
                                                    <option value="percentage" {{ old('discount_type', $promo->discount_type) == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                                                </select>
                                                @error('discount_type')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="discount_value">Nilai Diskon</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control @error('discount_value') is-invalid @enderror" name="discount_value"
                                                           id="discount_value" value="{{ old('discount_value', $promo->discount_value ?? 0) }}" min="0" step="0.01" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="discount_unit">{{ old('discount_type', $promo->discount_type) == 'percentage' ? '%' : 'Rp' }}</span>
                                                    </div>
                                                </div>
                                                <small class="text-muted">Nilai diskon yang didapat pembeli</small>
                                                @error('discount_value')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="form-check">
                                                <input type="hidden" name="is_discount_active" value="0">
                                                <input type="checkbox" class="form-check-input @error('is_discount_active') is-invalid @enderror" id="is_discount_active"
                                                       name="is_discount_active" value="1" {{ old('is_discount_active', $promo->is_discount_active ?? 1) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_discount_active">
                                                    <strong>Aktifkan Diskon</strong>
                                                </label>
                                                <small class="text-muted d-block">Centang untuk mengaktifkan fitur diskon pada promo ini</small>
                                                @error('is_discount_active')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status Promo</label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                            <option value="1" {{ old('status', $promo->status) == 1 ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ old('status', $promo->status) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        <small class="text-muted">Status keseluruhan promo</small>
                                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-6 text-center">
                                    <div class="form-group">
                                        <label for="gambar_promo">Gambar Promo</label>
                                        <input type="file" name="gambar_promo" id="gambar_promo" class="form-control-file @error('gambar_promo') is-invalid @enderror" accept="image/*">
                                        @error('gambar_promo')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div style="width: 300px; height: 300px; border: 2px dashed #ccc; margin: auto; display: flex; align-items: center; justify-content: center;">
                                        <img id="preview" src="{{ $promo->gambar_promo ? asset('uploads/promo/' . $promo->gambar_promo) : 'https://via.placeholder.com/300x300?text=Preview' }}" class="img-fluid rounded" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    </div>

                                    <input type="hidden" name="cropped_gambar_promo" id="cropped_gambar_promo">
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Simpan Perubahan</button>
                                <a href="{{ route('admin.promo.index') }}" class="btn btn-secondary">Batal</a>
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
    const input = document.getElementById('gambar_promo');

    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = () => {
            image.src = reader.result;

            if (cropper) cropper.destroy();
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
                crop() {
                    const canvas = cropper.getCroppedCanvas({ width: 300, height: 300 });
                    canvas.toBlob((blob) => {
                        const fileReader = new FileReader();
                        fileReader.onloadend = () => {
                            document.getElementById('cropped_gambar_promo').value = fileReader.result;
                        };
                        fileReader.readAsDataURL(blob);
                    });
                }
            });
        };
        reader.readAsDataURL(file);
    });

    // Handle discount type change
    $('#discount_type').change(function() {
        var discountType = $(this).val();
        var discountUnit = $('#discount_unit');
        var discountValue = $('#discount_value');

        if (discountType === 'percentage') {
            discountUnit.text('%');
            discountValue.attr('max', 100);
            discountValue.attr('step', 1);
        } else if (discountType === 'fixed') {
            discountUnit.text('Rp');
            discountValue.removeAttr('max');
            discountValue.attr('step', 0.01);
        }
    });

    // Trigger change on page load if there's a selected value
    $('#discount_type').trigger('change');

    // Jalankan cropper untuk gambar yang sudah ada saat load
    window.addEventListener('load', () => {
        if (image.getAttribute('src').includes('uploads')) {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
                crop() {
                    const canvas = cropper.getCroppedCanvas({ width: 300, height: 300 });
                    canvas.toBlob((blob) => {
                        const fileReader = new FileReader();
                        fileReader.onloadend = () => {
                            document.getElementById('cropped_gambar_promo').value = fileReader.result;
                        };
                        fileReader.readAsDataURL(blob);
                    });
                }
            });
        }
        // Trigger discount type change on load
        $('#discount_type').trigger('change');
    });
</script>
</body>
</html>
