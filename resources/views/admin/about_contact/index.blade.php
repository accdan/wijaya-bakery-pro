<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About & Contact || Wijaya Bakery</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/logo1.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

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
            max-width: 900px;
            margin: 0 auto;
        }

        .form-header {
            background: linear-gradient(135deg, #17a2b8, #138496);
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

        /* Section card */
        .section-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .section-header {
            background: #f8f9fa;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #17a2b8, #138496);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .section-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .section-header p {
            margin: 0;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .section-body {
            padding: 1.25rem;
        }

        /* Quill editor styling */
        .ql-container {
            border-radius: 0 0 8px 8px;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 1rem;
        }

        .ql-toolbar {
            border-radius: 8px 8px 0 0;
            background: #f8f9fa;
        }

        .ql-editor {
            min-height: 150px;
        }

        /* Preview box */
        .preview-box {
            background: linear-gradient(135deg, #e8f4f8, #d4edda);
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-top: 1.5rem;
        }

        .preview-box h6 {
            color: #155724;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .preview-box p {
            margin: 0;
            color: #1e7e34;
            font-size: 0.85rem;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            gap: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
            justify-content: flex-end;
        }

        .btn-save {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
            color: white;
        }

        .btn-view {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            color: #495057;
            font-weight: 500;
        }

        .btn-view:hover {
            background: #e9ecef;
            color: #343a40;
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
                            <h1 class="m-0" style="font-weight: 600;">About & Contact</h1>
                            <p class="text-muted mb-0">Edit informasi tentang bakery</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">About</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="form-card">
                        <div class="form-header">
                            <h4><i class="fas fa-info-circle mr-2"></i>Informasi Wijaya Bakery</h4>
                            <p>Edit deskripsi yang ditampilkan di halaman About</p>
                        </div>

                        <div class="form-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.about_contact.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <!-- About Section -->
                                <div class="section-card">
                                    <div class="section-header">
                                        <div class="section-icon">
                                            <i class="fas fa-store"></i>
                                        </div>
                                        <div>
                                            <h5>Tentang Kami</h5>
                                            <p>Deskripsi tentang Wijaya Bakery</p>
                                        </div>
                                    </div>
                                    <div class="section-body">
                                        <div id="aboutEditor" style="height: 180px;">
                                            {!! old('about_deskripsi', $data->about_deskripsi) !!}
                                        </div>
                                        <input type="hidden" name="about_deskripsi" id="about_deskripsi">
                                    </div>
                                </div>

                                <div class="preview-box">
                                    <h6><i class="fas fa-eye"></i> Pratinjau</h6>
                                    <p>Perubahan akan langsung terlihat di halaman <strong>About</strong> pada website
                                        publik.</p>
                                </div>

                                <div class="form-actions">
                                    <a href="{{ url('/') }}#about" target="_blank" class="btn btn-view">
                                        <i class="fas fa-external-link-alt mr-2"></i>Lihat di Website
                                    </a>
                                    <button type="submit" class="btn btn-save">
                                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    @include('services.ToastModal')
    @include('services.LogoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        // Initialize Quill editor
        var aboutQuill = new Quill('#aboutEditor', {
            theme: 'snow',
            placeholder: 'Tulis deskripsi tentang Wijaya Bakery...',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link'],
                    ['clean']
                ]
            }
        });

        // Save Quill content before form submit
        document.querySelector('form').addEventListener('submit', function () {
            document.querySelector('#about_deskripsi').value = aboutQuill.root.innerHTML;
        });

        @if(session('success') || session('error'))
            $('#toastNotification').toast({ delay: 3000 }).toast('show');
        @endif
    </script>
</body>

</html>



