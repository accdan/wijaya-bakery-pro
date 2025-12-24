<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Wijaya Admin</title>
  <link rel="icon" type="image/png" href="{{ asset('storage/image/logo1.png') }}">
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
    .text-brown {
      color: #8b5e3c;
    }
  </style>
</head>
<body>
  <div class="container-fluid login-wrapper d-flex flex-column flex-md-row">
    <!-- Kiri kosong / bisa diisi gambar / info -->
    <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
      <!-- Kosong atau bisa logo besar / quote / ilustrasi -->
      <img loading="lazy" src="{{ asset('storage/image/logo1.png') }}" alt="Logo Dapur Indonesia" style="max-width: 200px;">
    </div>

    <!-- Form login kanan -->
    <div class="col-md-6 d-flex align-items-center justify-content-center">
      <div class="login-card shadow-sm w-100" style="max-width: 400px;">
        <div class="text-center mb-4 d-md-none">
          <img loading="lazy" src="{{ asset('storage/image/logo1.png') }}" alt="Logo Dapur Indonesia" style="max-height: 80px;">
        </div>
        <h4 class="text-brown mb-3 text-center">Login Owner</h4>

        @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login-admin') }}">
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

          <div class="d-grid">
            <button type="submit" class="btn btn-custom">Masuk</button>
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




