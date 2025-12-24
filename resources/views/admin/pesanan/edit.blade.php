<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Edit Pesanan</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/icondapur.jpg') }}">
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
                        <h1 class="m-0"><i class="fas fa-shopping-cart"></i> Edit Pesanan</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header bg-warning text-white">
                        <h3 class="card-title"><i class="fas fa-edit"></i> Form Edit Pesanan</h3>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('admin.pesanan.update', $pesanan->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_pemesan"><i class="fas fa-user"></i> Nama Pemesan</label>
                                        <input type="text" class="form-control @error('nama_pemesan') is-invalid @enderror"
                                               name="nama_pemesan" value="{{ old('nama_pemesan', $pesanan->nama_pemesan) }}" required>
                                        @error('nama_pemesan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_hp"><i class="fas fa-phone"></i> Nomor Telepon</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                               name="no_hp" value="{{ old('no_hp', $pesanan->no_hp) }}" required>
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="menu_id"><i class="fas fa-utensils"></i> Menu</label>
                                        <select class="form-control @error('menu_id') is-invalid @enderror"
                                                name="menu_id" id="menu_id" required>
                                            <option value="">-- Pilih Menu --</option>
                                            @foreach($menus as $menu)
                                                <option value="{{ $menu->id }}" data-harga="{{ $menu->harga }}"
                                                    {{ (old('menu_id', $pesanan->menu_id) == $menu->id) ? 'selected' : '' }}>
                                                    {{ $menu->nama_menu }} - Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('menu_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="harga_satuan"><i class="fas fa-money-bill"></i> Harga Satuan</label>
                                        <input type="number" class="form-control @error('harga_satuan') is-invalid @enderror"
                                               name="harga_satuan" id="harga_satuan" value="{{ old('harga_satuan', $pesanan->harga_satuan) }}" min="0" required readonly>
                                        @error('harga_satuan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jumlah"><i class="fas fa-hashtag"></i> Jumlah</label>
                                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                               name="jumlah" id="jumlah" value="{{ old('jumlah', $pesanan->jumlah) }}" min="1" required>
                                        @error('jumlah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-calculator"></i> Total Harga</label>
                                        <input type="text" class="form-control" id="total_harga_display"
                                               value="Rp {{ number_format($pesanan->harga_satuan * $pesanan->jumlah, 0, ',', '.') }}" readonly>
                                        <input type="hidden" name="calculated_total" id="calculated_total" value="{{ $pesanan->harga_satuan * $pesanan->jumlah }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="catatan"><i class="fas fa-sticky-note"></i> Catatan</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror"
                                          name="catatan" rows="3" placeholder="Tambahkan catatan khusus untuk pesanan ini (opsional)">{{ old('catatan', $pesanan->catatan) }}</textarea>
                                @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-calendar"></i> Tanggal Pembuatan</label>
                                <input type="text" class="form-control" value="{{ $pesanan->created_at->format('d/m/Y H:i') }}" readonly>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Update Pesanan
                                </button>
                                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-secondary">
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
        function calculateTotal() {
            const hargaSatuan = parseFloat($('#harga_satuan').val()) || 0;
            const jumlah = parseInt($('#jumlah').val()) || 0;
            const total = hargaSatuan * jumlah;

            $('#total_harga_display').val('Rp ' + total.toLocaleString('id-ID'));
            $('#calculated_total').val(total);
        }

        $('#menu_id').on('change', function() {
            const selectedOption = $(this).find('option:selected');
            const harga = selectedOption.data('harga') || 0;
            $('#harga_satuan').val(harga);
            calculateTotal();
        });

        $('#jumlah').on('input', calculateTotal);

        // Initialize calculation
        calculateTotal();
    });
</script>
</body>
</html>




