<!-- resources/views/admin/sponsor/create.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Tambah Sponsor</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
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
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Tambah Sponsor Baru</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-plus-circle"></i> Form Tambah Sponsor</h3>
                        </div>
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('admin.sponsor.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="nama_sponsor">Nama Sponsor</label>
                                    <input type="text" class="form-control @error('nama_sponsor') is-invalid @enderror" name="nama_sponsor" value="{{ old('nama_sponsor') }}" required>
                                    @error('nama_sponsor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi_sponsor">Deskripsi Sponsor</label>
                                    <textarea name="deskripsi_sponsor" class="form-control @error('deskripsi_sponsor') is-invalid @enderror" rows="4" required>{{ old('deskripsi_sponsor') }}</textarea>
                                    @error('deskripsi_sponsor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label for="logo_sponsor">Logo Sponsor</label>
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
                                            <td><strong>300 x 150 px</strong></td>
                                            <td>Landscape (lebar lebih panjang) — cocok untuk logo umum</td>
                                          </tr>
                                          <tr>
                                            <td>Format disarankan</td>
                                            <td><code>.png</code> / <code>.webp</code></td>
                                            <td>Transparan background lebih bagus untuk estetika UI</td>
                                          </tr>
                                        </tbody>
                                      </table>                                      
                                    <input type="file" name="logo_sponsor" class="form-control-file @error('logo_sponsor') is-invalid @enderror" accept="image/*">
                                    @error('logo_sponsor')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                    <a href="{{ route('admin.sponsor.index') }}" class="btn btn-secondary">Batal</a>
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
</body>
</html>
