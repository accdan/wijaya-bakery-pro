 <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || About & Contact</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icondapur.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
                        <h1>Edit About & Contact</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.about_contact.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h3 class="card-title">Formulir Edit</h3>
                        </div>
                        <div class="card-body row">

                            {{-- ABOUT SECTION --}}
                            <div class="col-md-6">
                                <h5><i class="fas fa-info-circle"></i> Tentang Kami</h5>
                                <div class="form-group">
                                    <label for="about_deskripsi">Deskripsi Tentang Kami</label>
                                    <div id="aboutEditor" style="height: 200px;">{!! old('about_deskripsi', $data->about_deskripsi) !!}</div>
                                    <input type="hidden" name="about_deskripsi" id="about_deskripsi">
                                </div>
                            </div>

                            {{-- CONTACT SECTION
                            <div class="col-md-6">
                                <h5><i class="fas fa-phone"></i> Kontak</h5>
                                <div class="form-group">
                                    <label for="contact_deskripsi">Deskripsi Kontak</label>
                                    <div id="contactEditor" style="height: 200px;">{!! old('contact_deskripsi', $data->contact_deskripsi) !!}</div>
                                    <input type="hidden" name="contact_deskripsi" id="contact_deskripsi">
                                </div>
                            </div> --}}

                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('admin.about_contact.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    @include('include.footerSistem')
</div>

@include('services.ToastModal')
@include('services.LogoutModal')

<!-- Script dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    // Inisialisasi Quill dengan toolbar lengkap
    var aboutQuill = new Quill('#aboutEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                ['link', 'image'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['clean']
            ]
        }
    });

    var contactQuill = new Quill('#contactEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                ['link', 'image'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['clean']
            ]
        }
    });

    // Simpan isi Quill editor ke dalam input hidden sebelum submit
    document.querySelector('form').addEventListener('submit', function () {
        document.querySelector('#about_deskripsi').value = aboutQuill.root.innerHTML;
        document.querySelector('#contact_deskripsi').value = contactQuill.root.innerHTML;
    });
</script>
</body>
</html>
