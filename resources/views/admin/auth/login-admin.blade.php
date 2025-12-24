<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TOKO ROTI</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/icondapur.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-image d-flex align-items-center justify-content-center min-vh-100"
         style="background-image: url('{{ asset('storage/image/random1.jpg') }}');
                background-size: cover;
                background-position: center;">

        <div class="card shadow border-0 w-100 bg-dark text-white" style="max-width: 400px; backdrop-filter: blur(5px); background-color: rgba(0, 0, 0, 0.6);">
            <div class="card-body p-4">

                <div class="text-center mb-3">
                    <img loading="lazy" src="{{ asset('storage/image/logo1.png') }}" alt="Logo Dapur Indonesia" class="img-fluid" style="max-height: 100px;">
                </div>

                <h4 class="text-center text-warning mb-3">PRODUK PKM TOKO ROTI</h4>
                <p class="text-center text-light mb-4">Masuk sebagai Admin</p>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login-admin') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label text-white">Username</label>
                        <input type="text"
                               class="form-control @error('username') is-invalid @enderror"
                               id="username"
                               name="username"
                               required
                               autofocus
                               value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback d-block text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-white">Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               required>
                        @error('password')
                            <div class="invalid-feedback d-block text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning text-dark">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('services.ToastModalUser')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            @if (session('success') || session('error'))
                $('#toastNotification').toast({
                    delay: 3000,
                    autohide: true
                }).toast('show');
            @endif
        });
    </script>
</body>
</html>




