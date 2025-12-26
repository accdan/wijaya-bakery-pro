<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sponsor || Wijaya Bakery</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/logo1.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />

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
            background: linear-gradient(135deg, #f59e0b, #d97706);
            padding: 1.5rem 2rem;
            color: white;
        }

        .form-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .form-header p {
            margin: 0.25rem 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .form-body {
            padding: 2rem;
        }

        .form-section {
            margin-bottom: 2rem;
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
            color: #f59e0b;
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
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }

        /* Image upload & preview */
        .upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            background: repeating-conic-gradient(#f0f0f0 0% 25%, transparent 0% 50%) 50% / 20px 20px;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .upload-preview {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            object-fit: contain;
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
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
            color: white;
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

        .file-upload-wrapper {
            position: relative;
            margin-bottom: 1rem;
        }

        .file-upload-label {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: #f59e0b;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .file-upload-label:hover {
            background: #d97706;
        }

        .file-upload-label i {
            margin-right: 0.5rem;
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
                            <h1 class="m-0" style="font-weight: 600;">Edit Sponsor</h1>
                            <p class="text-muted mb-0">Perbarui informasi sponsor</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.sponsor.index') }}">Sponsor</a>
                                </li>
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
                            <h4><i class="fas fa-edit mr-2"></i>Edit Sponsor</h4>
                            <p>Perbarui detail sponsor yang sudah ada</p>
                        </div>

                        <div class="form-body">
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.sponsor.update', $sponsor->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <!-- Basic Info -->
                                <div class="form-section">
                                    <h6 class="section-title"><i class="fas fa-info-circle"></i> Informasi Sponsor</h6>

                                    <div class="mb-3">
                                        <label class="form-label">Nama Sponsor <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="nama_sponsor"
                                            class="form-control @error('nama_sponsor') is-invalid @enderror"
                                            value="{{ old('nama_sponsor', $sponsor->nama_sponsor) }}" required>
                                        @error('nama_sponsor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                        <textarea name="deskripsi_sponsor" rows="3"
                                            class="form-control @error('deskripsi_sponsor') is-invalid @enderror"
                                            required>{{ old('deskripsi_sponsor', $sponsor->deskripsi_sponsor) }}</textarea>
                                        @error('deskripsi_sponsor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Logo -->
                                <div class="form-section">
                                    <h6 class="section-title"><i class="fas fa-image"></i> Logo Sponsor</h6>

                                    <div class="file-upload-wrapper">
                                        <label for="logo_sponsor" class="file-upload-label">
                                            <i class="fas fa-upload"></i>Pilih Logo Baru
                                        </label>
                                        <input type="file" name="logo_sponsor" id="logo_sponsor" accept="image/*"
                                            style="display: none;">
                                        <small class="text-muted d-block mt-2">PNG, JPG, WEBP (Max 2MB, 300×150px
                                            disarankan)</small>
                                    </div>

                                    <div class="upload-area">
                                        <img loading="lazy" id="preview"
                                            src="{{ $sponsor->logo_sponsor ? asset('storage/uploads/sponsor/' . $sponsor->logo_sponsor) : 'https://via.placeholder.com/300x150?text=Preview+Logo' }}"
                                            class="upload-preview">
                                    </div>

                                    <input type="hidden" name="cropped_logo" id="cropped_logo">
                                    @error('logo_sponsor')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Actions -->
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-save">
                                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                    </button>
                                    <a href="{{ route('admin.sponsor.index') }}" class="btn btn-cancel">
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

    <!-- Crop Modal -->
    <div class="modal fade" id="cropModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Logo</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div style="max-height: 500px; overflow: hidden;">
                        <img id="cropperImage" src="" style="max-width: 100%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="cropButton">Crop & Simpan</button>
                </div>
            </div>
        </div>
    </div>

    @include('services.LogoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <script>
        let cropper;

        document.getElementById('logo_sponsor').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Show crop modal
                    document.getElementById('cropperImage').src = e.target.result;
                    $('#cropModal').modal('show');

                    // Initialize cropper after modal shown
                    $('#cropModal').on('shown.bs.modal', function () {
                        if (cropper) {
                            cropper.destroy();
                        }
                        cropper = new Cropper(document.getElementById('cropperImage'), {
                            aspectRatio: 2 / 1, // 300x150 ratio
                            viewMode: 1,
                            autoCropArea: 1
                        });
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('cropButton').addEventListener('click', function () {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 300,
                    height: 150
                });

                // Convert to base64
                const croppedImage = canvas.toDataURL('image/png');
                document.getElementById('cropped_logo').value = croppedImage;

                // Update preview
                document.getElementById('preview').src = croppedImage;

                // Close modal
                $('#cropModal').modal('hide');

                // Destroy cropper
                cropper.destroy();
            }
        });

        // Clean up cropper when modal is closed
        $('#cropModal').on('hidden.bs.modal', function () {
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        });
    </script>
</body>

</html>