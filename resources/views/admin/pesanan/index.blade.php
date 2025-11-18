<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Pesanan</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icondapur.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
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
                            <h1 class="m-0">Manajemen Pesanan</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <!-- Search and Filter Card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pencarian dan Filter</h3>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.pesanan.index') }}" class="mb-4">
                                <div class="row">
                                    <!-- Search Input -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="search">Cari Pesanan:</label>
                                            <input type="text" name="search" id="search" class="form-control"
                                                   placeholder="Cari nama pemesan, nomor HP, atau menu..."
                                                   value="{{ request('search') }}">
                                        </div>
                                    </div>

                                    <!-- Date Range -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tanggal_mulai">Tanggal Mulai:</label>
                                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                                                   value="{{ request('tanggal_mulai') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tanggal_akhir">Tanggal Akhir:</label>
                                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                                                   value="{{ request('tanggal_akhir') }}">
                                        </div>
                                    </div>

                                    <!-- Sort By -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="sort_by">Urutkan Berdasarkan:</label>
                                            <select name="sort_by" id="sort_by" class="form-control">
                                                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Tanggal Pesan</option>
                                                <option value="nama_pemesan" {{ request('sort_by') == 'nama_pemesan' ? 'selected' : '' }}>Nama Pemesan</option>
                                                <option value="total_harga" {{ request('sort_by') == 'total_harga' ? 'selected' : '' }}>Total Harga</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i> Cari
                                        </button>
                                        <a href="{{ route('admin.pesanan.index') }}" class="btn btn-secondary ml-2">
                                            <i class="fas fa-times"></i> Reset
                                        </a>
                                        @if(request()->hasAny(['search', 'tanggal_mulai', 'tanggal_akhir']))
                                            <small class="text-muted ml-3">
                                                Menampilkan hasil filter: {{ $pesanans->count() }} pesanan
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Orders List Card -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Daftar Pesanan</h3>
                            <a href="{{ route('admin.pesanan.create') }}" class="btn btn-primary btn-sm ml-auto">
                                <i class="fas fa-plus"></i> Tambah Pesanan
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="pesananTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemesan</th>
                                            <th>No HP</th>
                                            <th>Menu</th>
                                            <th>Jumlah</th>
                                            <th>Harga Satuan</th>
                                            <th>Subtotal</th>
                                            <th>Diskon</th>
                                            <th>Total Akhir</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 0; @endphp
                                        @foreach($pesanans as $groupKey => $group)
                                            @php
                                                $info = explode('|', $groupKey);
                                                $nama = $info[0];
                                                $noHp = $info[1];
                                                $waktu = $info[2];
                                                $totalAsli = $group->sum('total_harga');
                                                $totalDiscount = $group->sum('discount_amount');
                                                $totalFinal = $group->sum('final_price');
                                                $counter++;
                                            @endphp
                                            <tr class="table-primary">
                                                <td>{{ $counter }}</td>
                                                <td><strong>{{ $nama }}</strong></td>
                                                <td>{{ $noHp }}</td>
                                                <td colspan="5" class="text-center">
                                                    <strong>Waktu Pesan: {{ $waktu }}</strong><br>
                                                    @if($totalDiscount > 0)
                                                        <small class="text-muted">
                                                            Total Asli: Rp {{ number_format($totalAsli, 0, ',', '.') }} |
                                                            Diskon: Rp {{ number_format($totalDiscount, 0, ',', '.') }} |
                                                            Total Akhir: Rp {{ number_format($totalFinal, 0, ',', '.') }}
                                                        </small>
                                                    @else
                                                        <small class="text-muted">Total Pesanan: Rp {{ number_format($totalAsli, 0, ',', '.') }}</small>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{-- Group actions if needed --}}
                                                </td>
                                            </tr>
                                            @foreach($group as $pesanan)
                                                <tr {{ $pesanan->discount_amount > 0 ? 'class="table-warning"' : '' }}>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        {{ $pesanan->menu->nama_menu ?? 'Menu tidak tersedia' }}
                                                        @if($pesanan->promo)
                                                            <br><small class="text-primary"><i class="fas fa-tag me-1"></i>{{ $pesanan->promo->nama_promo }}</small>
                                                        @endif
                                                    </td>
                                                    <td>{{ $pesanan->jumlah }}</td>
                                                    <td>Rp {{ number_format($pesanan->harga_satuan, 0, ',', '.') }}</td>
                                                    <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                                    <td>
                                                        @if($pesanan->discount_amount > 0)
                                                            <span class="text-danger">
                                                                <i class="fas fa-arrow-down me-1"></i>
                                                                -Rp {{ number_format($pesanan->discount_amount, 0, ',', '.') }}<br>
                                                                <small class="text-muted">{{ ucfirst($pesanan->discount_type) }}</small>
                                                            </span>
                                                        @else
                                                            <span class="text-muted">Tidak ada diskon</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <strong {{ $pesanan->discount_amount > 0 ? 'class="text-success font-weight-bold"' : '' }}>
                                                            Rp {{ number_format($pesanan->final_price, 0, ',', '.') }}
                                                            @if($pesanan->discount_amount > 0)
                                                                <i class="fas fa-check-circle text-success ms-1" title="Sudah diskon"></i>
                                                            @endif
                                                        </strong>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.pesanan.show', $pesanan->id) }}" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i> Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deletePesananModal" tabindex="-1" aria-labelledby="deletePesananModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deletePesananModalLabel"><i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus pesanan ini? Tindakan ini tidak dapat dibatalkan.
                </div>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('services.ToastModal')
    @include('services.LogoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/ToastScript.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#pesananTable").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,  // Disable client-side search since we have server-side search
                "ordering": false,   // Disable DataTables ordering since we have server-side sorting
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "emptyTable": "Tidak ada data pesanan yang sesuai dengan filter"
                }
            });

            $('.delete-pesanan-btn').click(function () {
                let pesananId = $(this).data('pesanan-id');
                let deleteUrl = "{{ url('pesanan') }}/" + pesananId;
                $('#deleteForm').attr('action', deleteUrl);
            });

            @if (session('success') || session('error'))
                $('#toastNotification').toast({
                    delay: 3000,
                    autohide: true
                }).toast('show');
            @endif

            // Set default date values if not set
            if (!document.getElementById('tanggal_mulai').value) {
                let today = new Date();
                let thirtyDaysAgo = new Date();
                thirtyDaysAgo.setDate(today.getDate() - 30);

                document.getElementById('tanggal_mulai').value = thirtyDaysAgo.toISOString().split('T')[0];
                document.getElementById('tanggal_akhir').value = today.toISOString().split('T')[0];
            }
        });
    </script>
</body>
</html>
