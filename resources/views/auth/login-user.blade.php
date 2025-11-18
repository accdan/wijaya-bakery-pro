<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Wijaya Bakery</title>
  <link rel="icon" type="image/png" href="{{ asset('image/logo1.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #fdf6e3; /* cream */
      min-height: 100vh;
    }
    .login-wrapper {
      min-height: 100vh;
    }
    .login-card {
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
  <div class="container-fluid login-wrapper d-flex flex-column flex-md-row">
    <!-- Logo section -->
    <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
      <img src="{{ asset('image/logo1.png') }}" alt="Wijaya Bakery Logo" style="max-width: 250px;">
    </div>

    <!-- Login form -->
    <div class="col-md-6 d-flex align-items-center justify-content-center">
      <div class="login-card shadow-sm w-100" style="max-width: 400px;">
        <div class="text-center mb-4 d-md-none">
          <img src="{{ asset('image/logo1.png') }}" alt="Wijaya Bakery Logo" style="max-height: 80px;">
        </div>
        <h4 class="text-brown mb-3 text-center">Masuk ke Akun Anda</h4>

        @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('user.login') }}">
          @csrf

          <div class="mb-3">
            <label for="username" class="form-label text-brown">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required autofocus value="{{ old('username') }}">
            @error('username')
              <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="password" class="form-label text-brown">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
              <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-custom">Masuk</button>
          </div>
        </form>

        <!-- Forgot Password Link -->
        <div class="text-center mb-3">
          <a href="{{ route('password.request') }}" class="text-brown text-decoration-none small fw-bold">
            <i class="bi bi-key me-1"></i>Lupa Password?
          </a>
        </div>

        <!-- Google Login -->
        <div class="text-center mb-3">
          <span class="text-muted">Atau</span>
        </div>

        <div class="d-grid mb-3">
          <a href="{{ route('google.login') }}" class="btn btn-google">
            <i class="bi bi-google me-2"></i>Login dengan Google
          </a>
        </div>

        <div class="text-center">
          <span class="text-muted">Belum punya akun?</span>
          <a href="{{ route('user.register') }}" class="text-brown text-decoration-none ms-2 fw-bold">Daftar Sekarang</a>
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
