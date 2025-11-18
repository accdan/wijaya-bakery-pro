<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Tambah Promo</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icondapur.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('include.navbarSistem')
    @include('include.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0"><i class="fas fa-tags"></i> Tambah Promo Baru</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title"><i class="fas fa-plus-circle"></i> Form Tambah Promo</h3>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('admin.promo.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nama_promo"><i class="fas fa-tag"></i> Nama Promo</label>
                                <input type="text" class="form-control @error('nama_promo') is-invalid @enderror"
                                       name="nama_promo" value="{{ old('nama_promo') }}" required>
                                @error('nama_promo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="deskripsi"><i class="fas fa-info-circle"></i> Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                          name="deskripsi_promo" rows="3">{{ old('deskripsi_promo') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="gambar_promo"><i class="fas fa-image"></i> Gambar Promo</label>
                                <h5>Ukuran Gambar Promo</h5>
                                    <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                        <th>Platform</th>
                                        <th>Ukuran Gambar</th>
                                        <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td>Desktop, Tablet & Mobile</td>
                                        <td><strong>800 x 400 px</strong></td>
                                        <td>Format landscape, cocok untuk tampilan carousel</td>
                                        </tr>
                                        <tr>
                                        <tr>
                                        <td>Format disarankan</td>
                                        <td><code>.jpg</code> / <code>.webp</code></td>
                                        <td>Resolusi jelas, sebaiknya dikompres tanpa menurunkan kualitas</td>
                                        </tr>
                                    </tbody>
                                    </table>
                                <input type="file" class="form-control-file @error('gambar_promo') is-invalid @enderror"
                                       name="gambar_promo">
                                @error('gambar_promo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Discount Configuration Section -->
                            <div class="card border-primary mt-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="fas fa-percentage"></i> Konfigurasi Diskon</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="menu_id"><i class="fas fa-utensils"></i> Menu (Opsional)</label>
                                                <select class="form-control @error('menu_id') is-invalid @enderror" name="menu_id">
                                                    <option value="">-- Semua Menu --</option>
                                                    @foreach(\App\Models\Menu::all() as $menu)
                                                        <option value="{{ $menu->id }}" {{ old('menu_id') == $menu->id ? 'selected' : '' }}>
                                                            {{ $menu->nama_menu }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <small class="text-muted">Kosongkan jika diskon berlaku untuk semua menu</small>
                                                @error('menu_id')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="min_quantity"><i class="fas fa-hashtag"></i> Jumlah Minimal Pembelian</label>
                                                <input type="number" class="form-control @error('min_quantity') is-invalid @enderror"
                                                       name="min_quantity" value="{{ old('min_quantity', 1) }}" min="1" required>
                                                <small class="text-muted">Minimal jumlah item yang harus dibeli</small>
                                                @error('min_quantity')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="discount_type"><i class="fas fa-calculator"></i> Tipe Diskon</label>
                                                <select class="form-control @error('discount_type') is-invalid @enderror"
                                                        name="discount_type" id="discount_type" required>
                                                    <option value="">-- Pilih Tipe Diskon --</option>
                                                    <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Nominal (Rp)</option>
                                                    <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                                                </select>
                                                @error('discount_type')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="discount_value"><i class="fas fa-money-bill"></i> Nilai Diskon</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control @error('discount_value') is-invalid @enderror"
                                                           name="discount_value" id="discount_value"
                                                           value="{{ old('discount_value', 0) }}" min="0" step="0.01" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="discount_unit">Rp</span>
                                                    </div>
                                                </div>
                                                <small class="text-muted">Nilai diskon yang didapat pembeli</small>
                                                @error('discount_value')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="is_discount_active" value="0">
                                            <input type="checkbox" class="custom-control-input @error('is_discount_active') is-invalid @enderror"
                                                   id="is_discount_active" name="is_discount_active" value="1"
                                                   {{ old('is_discount_active', 1) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="is_discount_active">
                                                <i class="fas fa-check"></i> <strong>Aktifkan Diskon</strong>
                                            </label>
                                        </div>
                                        <small class="text-muted">Centang untuk mengaktifkan fitur diskon pada promo ini</small>
                                        @error('is_discount_active')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i>
                                        <strong>Contoh:</strong><br>
                                        Menu: Nasi Goreng, Jumlah Min: 2, Tipe: Persentase, Nilai: 10% = Diskon 10% untuk 2+ porsi Nasi Goreng
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status"><i class="fas fa-toggle-on"></i> Status Promo</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                <small class="text-muted">Status keseluruhan promo</small>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('admin.promo.index') }}" class="btn btn-secondary">
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

<script>
$(document).ready(function() {
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

    // Update discount unit on blur
    $('#discount_type').blur(function() {
        $(this).trigger('change');
    });
});
</script>
</body>
</html>
