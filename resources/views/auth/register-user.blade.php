<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar | Wijaya Bakery</title>
  <link rel="icon" type="image/png" href="{{ asset('image/logo1.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #fdf6e3; /* cream */
      min-height: 100vh;
    }
    .register-wrapper {
      min-height: 100vh;
    }
    .register-card {
      background: #ffffff; /* putih */
      border: 1px solid #8b5e3c; /* coklat */
      padding: 2rem;
      border-radius: 8px;
    }
    .btn-custom {
      background-color: #8b5e3c;
      color: #fff;
    }
    .btn-custom:hover {
      background-color: #a06a41;
      color: #fff;
    }
    .btn-google {
      background-color: #4285f4;
      color: #fff;
      border: none;
    }
    .btn-google:hover {
      background-color: #3367d6;
      color: #fff;
    }
    .text-brown {
      color: #8b5e3c;
    }
  </style>
</head>
<body>
  <div class="container-fluid register-wrapper d-flex flex-column flex-md-row">
    <!-- Logo section -->
    <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
      <img src="{{ asset('image/logo1.png') }}" alt="Wijaya Bakery Logo" style="max-width: 250px;">
    </div>

    <!-- Register form -->
    <div class="col-md-6 d-flex align-items-center justify-content-center">
      <div class="register-card shadow-sm w-100" style="max-width: 450px;">
        <div class="text-center mb-4 d-md-none">
          <img src="{{ asset('image/logo1.png') }}" alt="Wijaya Bakery Logo" style="max-height: 80px;">
        </div>
        <h4 class="text-brown mb-3 text-center">Daftar Akun Baru</h4>
        <p class="text-center text-muted mb-4">Bergabunglah dengan Wijaya Bakery untuk pengalaman yang lebih baik</p>

        @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('user.register') }}">
          @csrf

          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="name" class="form-label text-brown">Nama Lengkap</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name') }}">
              @error('name')
                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label for="username" class="form-label text-brown">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required value="{{ old('username') }}">
              @error('username')
                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label for="email" class="form-label text-brown">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="mb-3">
            <label for="no_telepon" class="form-label text-brown">Nomor Telepon</label>
            <input type="tel" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" placeholder="08xxxxxxxxxx" required value="{{ old('no_telepon') }}">
            @error('no_telepon')
              <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label text-brown">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
              <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="password_confirmation" class="form-label text-brown">Konfirmasi Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
              <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-custom">Daftar Sekarang</button>
          </div>
        </form>

        <!-- Google Registration -->
        <div class="text-center mb-3">
          <span class="text-muted">Atau</span>
        </div>

        <div class="d-grid mb-3">
          <a href="{{ route('google.login') }}" class="btn btn-google">
            <i class="bi bi-google me-2"></i>Daftar dengan Google
          </a>
        </div>

        <div class="text-center">
          <span class="text-muted">Sudah punya akun?</span>
          <a href="{{ route('user.login') }}" class="text-brown text-decoration-none ms-2 fw-bold">Masuk</a>
        </div>

        <div class="text-center mt-3">
          <a href="/" class="text-brown text-decoration-none">← Kembali ke Beranda</a>
        </div>
      </div>
    </div>
  </div>

  <div id="toastNotification" class="toast align-items-center position-fixed top-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        @if(session('success'))
          <i class="bi bi-check-circle-fill text-success me-2"></i>{{ session('success') }}
        @elseif(session('error'))
          <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>{{ session('error') }}
        @endif
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>

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
