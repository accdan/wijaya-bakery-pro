<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || Ubah Pengguna</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/icondapur.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
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
                            <h1 class="m-0">Ubah Pengguna</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit"></i> Form Ubah Pengguna</h3>
                        </div>
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('admin.user.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <!-- Kiri -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Nama Pengguna</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name', $user->name) }}" required>
                                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                name="username" value="{{ old('username', $user->username) }}" required>
                                            @error('username')<div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email', $user->email) }}">
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="no_telepon">Nomor Telepon</label>
                                            <input type="text"
                                                class="form-control @error('no_telepon') is-invalid @enderror"
                                                name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}">
                                            @error('no_telepon')<div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Tengah -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password">Password <small class="text-muted">(kosongkan jika
                                                    tidak ingin mengubah)</small></label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password">
                                            @error('password')<div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="role_id">Role</label>
                                            <select name="role_id" id="role_id"
                                                class="form-control @error('role_id') is-invalid @enderror">
                                                <option value="">-- Pilih Role --</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                        {{ $role->role_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <!-- Kanan: Foto -->
                                    <div class="col-md-4 text-center">
                                        <div class="form-group">
                                            <label for="profile_picture">Foto Profil</label>
                                            <input type="file" name="profile_picture" id="profile_picture"
                                                class="form-control-file @error('profile_picture') is-invalid @enderror"
                                                accept="image/*">
                                            @error('profile_picture')<div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div
                                            style="width: 100%; max-width: 300px; min-height: 200px; border: 2px dashed #ccc; margin: auto; display: flex; align-items: center; justify-content: center; background: repeating-conic-gradient(#f0f0f0 0% 25%, transparent 0% 50%) 50% / 20px 20px;">
                                            <img loading="lazy" id="preview"
                                                src="{{ $user->profile_picture ? asset('storage/uploads/profile/' . $user->profile_picture) : 'https://via.placeholder.com/300x300?text=Preview' }}"
                                                class="img-fluid rounded"
                                                style="max-width: 100%; max-height: 300px; object-fit: contain;">
                                        </div>
                                        <input type="hidden" name="cropped_image" id="cropped_image">
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Simpan
                                        Perubahan</button>
                                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Batal</a>
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
        $(document).ready(function () {
            $('[data-widget="treeview"]').Treeview('init');
        });

        let cropper;
        const image = document.getElementById('preview');
        const input = document.getElementById('profile_picture');

        input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = () => {
                image.src = reader.result;

                if (cropper) cropper.destroy();
                cropper = new Cropper(image, {
                    aspectRatio: NaN, // Free aspect ratio untuk full image
                    viewMode: 2,
                    autoCropArea: 1,
                    responsive: true,
                    background: true,
                    ready() {
                        const containerData = cropper.getContainerData();
                        cropper.setCropBoxData({
                            left: 0,
                            top: 0,
                            width: containerData.width,
                            height: containerData.height
                        });
                    },
                    crop(event) {
                        try {
                            const canvas = cropper.getCroppedCanvas({
                                maxWidth: 400,
                                maxHeight: 400,
                                imageSmoothingEnabled: true,
                                imageSmoothingQuality: 'high'
                            });
                            if (canvas) {
                                canvas.toBlob((blob) => {
                                    if (blob) {
                                        const reader = new FileReader();
                                        reader.onloadend = () => {
                                            document.getElementById('cropped_image').value = reader.result;
                                        };
                                        reader.readAsDataURL(blob);
                                    }
                                }, 'image/png');
                            }
                        } catch (e) {
                            console.log('Crop error:', e);
                        }
                    }
                });
            };
            reader.readAsDataURL(file);
        });
    </script>
</body>

</html>