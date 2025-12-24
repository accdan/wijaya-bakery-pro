<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Ubah Peran</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/icondapur.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap"
        rel="stylesheet">
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
                            <h1 class="m-0"><i class="fas fa-edit"></i> Ubah Peran</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header bg-warning text-dark">
                            <h3 class="card-title"><i class="fas fa-pencil-alt"></i> Form Ubah Peran</h3>
                        </div>
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <form action="{{ route('admin.role.update', $role->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="form-group">
                                    <label for="role_name"><i class="fas fa-id-badge"></i> Nama Peran</label>
                                    <input type="text" class="form-control @error('role_name') is-invalid @enderror"
                                        name="role_name" value="{{ old('role_name', $role->role_name) }}" required>
                                    @error('role_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="role_description"><i class="fas fa-align-left"></i> Deskripsi</label>
                                    <textarea class="form-control @error('role_description') is-invalid @enderror"
                                        name="role_description" rows="3"
                                        required>{{ old('role_description', $role->role_description) }}</textarea>
                                    @error('role_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="role_status"><i class="fas fa-toggle-on"></i> Status</label>
                                    <select class="form-control @error('role_status') is-invalid @enderror"
                                        name="role_status">
                                        <option value="1" {{ old('role_status', $role->role_status) == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('role_status', $role->role_status) == 0 ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('role_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">
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
</body>

</html>



