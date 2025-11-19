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
                                                    <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                                                    <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Nominal (Rp)</option>
                                                    <option value="buy_one_get_one" {{ old('discount_type') == 'buy_one_get_one' ? 'selected' : '' }}>Buy One Get One</option>
                                                    <option value="free_shipping" {{ old('discount_type') == 'free_shipping' ? 'selected' : '' }}>Free Shipping</option>
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

                            <!-- Advanced Discount Rules Section -->
                            <div class="card border-success mt-4">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0"><i class="fas fa-cogs"></i> Advanced Discount Rules (Optional)</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="discount_rule"><i class="fas fa-filter"></i> Discount Rule Type</label>
                                        <select class="form-control @error('discount_rule') is-invalid @enderror"
                                                name="discount_rule" id="discount_rule">
                                            <option value="all_items" {{ old('discount_rule', 'all_items') == 'all_items' ? 'selected' : '' }}>
                                                All Items (Default)
                                            </option>
                                            <option value="single_menu" {{ old('discount_rule') == 'single_menu' ? 'selected' : '' }}>
                                                Single Specific Menu
                                            </option>
                                            <option value="multiple_menus" {{ old('discount_rule') == 'multiple_menus' ? 'selected' : '' }}>
                                                Multiple Menus Selection
                                            </option>
                                            <option value="category_only" {{ old('discount_rule') == 'category_only' ? 'selected' : '' }}>
                                                Entire Category
                                            </option>
                                            <option value="price_range" {{ old('discount_rule') == 'price_range' ? 'selected' : '' }}>
                                                Price Range
                                            </option>
                                        </select>
                                        <small class="text-muted">Choose how the discount should be applied</small>
                                        @error('discount_rule')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Multiple Menus Selection -->
                                    <div class="form-group" id="multiple_menus_section" style="display: none;">
                                        <label><i class="fas fa-check-square"></i> Select Multiple Menus</label>
                                        <div class="border p-3" style="max-height: 200px; overflow-y: auto;">
                                            @foreach(\App\Models\Menu::all() as $menu)
                                                <div class="form-check">
                                                    <input class="form-check-input menu-checkbox" type="checkbox"
                                                           name="selected_menus[]" value="{{ $menu->id }}"
                                                           id="menu_{{ $menu->id }}"
                                                           {{ in_array($menu->id, old('selected_menus', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="menu_{{ $menu->id }}">
                                                        {{ $menu->nama_menu }} <small class="text-muted">(Rp {{ number_format($menu->harga) }})</small>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <small class="text-muted">Check all menus that should get this discount</small>
                                        @error('selected_menus')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Category Selection -->
                                    <div class="form-group" id="category_section" style="display: none;">
                                        <label for="kategori_id"><i class="fas fa-folder"></i> Select Category</label>
                                        <select class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id">
                                            <option value="">-- Choose Category --</option>
                                            @foreach(\App\Models\Kategori::all() as $category)
                                                <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Discount applies to all items in selected category</small>
                                        @error('kategori_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Price Range -->
                                    <div id="price_range_section" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price_min"><i class="fas fa-arrow-down"></i> Minimum Price (Rp)</label>
                                                    <input type="number" class="form-control @error('price_min') is-invalid @enderror"
                                                           name="price_min" value="{{ old('price_min') }}" min="0" step="1000">
                                                    <small class="text-muted">Items priced above this value</small>
                                                    @error('price_min')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price_max"><i class="fas fa-arrow-up"></i> Maximum Price (Rp)</label>
                                                    <input type="number" class="form-control @error('price_max') is-invalid @enderror"
                                                           name="price_max" value="{{ old('price_max') }}" min="0" step="1000">
                                                    <small class="text-muted">Items priced below this value</small>
                                                    @error('price_max')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional Settings -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="valid_until"><i class="fas fa-calendar-times"></i> Expiration Date (Optional)</label>
                                                <input type="datetime-local" class="form-control @error('valid_until') is-invalid @enderror"
                                                       name="valid_until" value="{{ old('valid_until') }}">
                                                <small class="text-muted">Leave empty for no expiration</small>
                                                @error('valid_until')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="max_discount_uses"><i class="fas fa-users"></i> Max Uses Per Customer (Optional)</label>
                                                <input type="number" class="form-control @error('max_discount_uses') is-invalid @enderror"
                                                       name="max_discount_uses" value="{{ old('max_discount_uses') }}" min="1">
                                                <small class="text-muted">Leave empty for unlimited uses</small>
                                                @error('max_discount_uses')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="apply_to_cart_total" value="0">
                                            <input type="checkbox" class="custom-control-input @error('apply_to_cart_total') is-invalid @enderror"
                                                   id="apply_to_cart_total" name="apply_to_cart_total" value="1"
                                                   {{ old('apply_to_cart_total') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="apply_to_cart_total">
                                                <i class="fas fa-shopping-cart"></i> <strong>Apply to Cart Total</strong>
                                            </label>
                                        </div>
                                        <small class="text-muted">Apply discount to entire cart total instead of individual items</small>
                                        @error('apply_to_cart_total')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Old Menu Selection (for backward compatibility) -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning" id="menu_warning" style="display: none;">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <strong>Warning:</strong> Single menu selection is ignored when using Advanced Rules above.
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
        var discountValueLabel = $('#discount_value').closest('.form-group').find('label');

        if (discountType === 'percentage') {
            discountUnit.text('%');
            discountValue.attr('max', 100);
            discountValue.attr('step', 1);
            discountValueLabel.html('<i class="fas fa-money-bill"></i> Nilai Diskon');
            discountValue.prop('required', true);
        } else if (discountType === 'fixed') {
            discountUnit.text('Rp');
            discountValue.removeAttr('max');
            discountValue.attr('step', 0.01);
            discountValueLabel.html('<i class="fas fa-money-bill"></i> Nilai Diskon');
            discountValue.prop('required', true);
        } else if (discountType === 'buy_one_get_one') {
            discountUnit.text('Rp');
            discountValue.removeAttr('max');
            discountValue.attr('step', 0.01);
            discountValueLabel.html('<i class="fas fa-gift"></i> Potongan BOGO (Opsional)');
            discountValue.val('0'); // Set to 0 by default for BOGO
            discountValue.prop('required', false);
        } else if (discountType === 'free_shipping') {
            discountUnit.text('Rp');
            discountValue.val('0'); // Set to 0 for free shipping
            discountValueLabel.html('<i class="fas fa-truck"></i> Biaya Ongkir Normal (Opsional)');
            discountValue.prop('required', false);
        }
    });

    // Handle discount rule type change
    $('#discount_rule').change(function() {
        var ruleType = $(this).val();

        // Hide all sections first
        $('#multiple_menus_section').hide();
        $('#category_section').hide();
        $('#price_range_section').hide();
        $('#menu_warning').hide();

        // Show relevant section
        if (ruleType === 'multiple_menus') {
            $('#multiple_menus_section').show();
            $('#menu_warning').show();
        } else if (ruleType === 'category_only') {
            $('#category_section').show();
            $('#menu_warning').show();
        } else if (ruleType === 'price_range') {
            $('#price_range_section').show();
            $('#menu_warning').show();
        } else if (ruleType === 'single_menu') {
            $('#menu_warning').show();
        }
    });

    // Trigger changes on page load
    $('#discount_type').trigger('change');
    $('#discount_rule').trigger('change');

    // Update discount unit on blur
    $('#discount_type').blur(function() {
        $(this).trigger('change');
    });

    // Handle "select all" for multiple menus
    $('#select_all_menus').click(function() {
        $('.menu-checkbox').prop('checked', $(this).is(':checked'));
    });

    // Update "select all" checkbox based on individual checkboxes
    $('.menu-checkbox').change(function() {
        var totalCheckboxes = $('.menu-checkbox').length;
        var checkedCheckboxes = $('.menu-checkbox:checked').length;

        $('#select_all_menus').prop('checked', totalCheckboxes === checkedCheckboxes);
        $('#select_all_menus').prop('indeterminate', checkedCheckboxes > 0 && checkedCheckboxes < totalCheckboxes);
    });
});
</script>
</body>
</html>
