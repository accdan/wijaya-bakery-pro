<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Wijaya Bakery</title>
  <link rel="icon" type="image/png" href="{{ asset('storage/image/logo1.png') }}">

  <!-- Preconnect -->
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Inter:wght@400;500;600&display=swap"
    rel="stylesheet">

  <style>
    :root {
      --bakery-cream: #FEF9F3;
      --bakery-golden: #D4A574;
      --bakery-brown: #8B4513;
      --bakery-dark-brown: #5D3A1A;
      --bakery-peach: #FFECD2;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      background: linear-gradient(135deg, var(--bakery-cream) 0%, #fff 50%, var(--bakery-peach) 100%);
    }

    .login-container {
      display: flex;
      width: 100%;
      min-height: 100vh;
    }

    /* Left Panel - Branding */
    .brand-panel {
      flex: 1;
      background: linear-gradient(135deg, var(--bakery-brown) 0%, var(--bakery-dark-brown) 100%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 3rem;
      position: relative;
      overflow: hidden;
    }

    .brand-panel::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
      animation: float 20s linear infinite;
    }

    @keyframes float {
      0% {
        transform: translate(0, 0) rotate(0deg);
      }

      100% {
        transform: translate(-50px, -50px) rotate(360deg);
      }
    }

    .brand-content {
      position: relative;
      z-index: 1;
      text-align: center;
      color: white;
    }

    .brand-logo {
      width: 180px;
      height: 180px;
      margin-bottom: 2rem;
      filter: drop-shadow(0 8px 24px rgba(0, 0, 0, 0.3));
      animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {

      0%,
      100% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.05);
      }
    }

    .brand-title {
      font-family: 'Playfair Display', serif;
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 1rem;
      background: linear-gradient(180deg, #fff 0%, var(--bakery-peach) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .brand-tagline {
      font-size: 1.1rem;
      opacity: 0.9;
      max-width: 300px;
      line-height: 1.6;
    }

    .brand-features {
      margin-top: 3rem;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .feature-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1rem;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      backdrop-filter: blur(10px);
    }

    .feature-icon {
      width: 40px;
      height: 40px;
      background: var(--bakery-golden);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
    }

    .feature-text {
      font-size: 0.9rem;
      opacity: 0.95;
    }

    /* Right Panel - Form */
    .form-panel {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }

    .login-card {
      width: 100%;
      max-width: 420px;
      background: white;
      border-radius: 24px;
      padding: 3rem;
      box-shadow: 0 20px 60px rgba(139, 69, 19, 0.1);
    }

    .login-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .login-header h2 {
      font-family: 'Playfair Display', serif;
      color: var(--bakery-dark-brown);
      font-size: 1.8rem;
      margin-bottom: 0.5rem;
    }

    .login-header p {
      color: #6c757d;
      font-size: 0.95rem;
    }

    .form-floating {
      margin-bottom: 1rem;
    }

    .form-floating .form-control {
      border: 2px solid #e9ecef;
      border-radius: 12px;
      padding: 1rem 1rem 1rem 3rem;
      font-size: 1rem;
      transition: all 0.3s;
    }

    .form-floating .form-control:focus {
      border-color: var(--bakery-golden);
      box-shadow: 0 0 0 4px rgba(212, 165, 116, 0.15);
    }

    .input-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--bakery-brown);
      font-size: 1.1rem;
      z-index: 10;
    }

    .form-floating label {
      left: 2.5rem;
      color: #6c757d;
    }

    .btn-login {
      width: 100%;
      padding: 1rem;
      background: linear-gradient(135deg, var(--bakery-brown), var(--bakery-dark-brown));
      border: none;
      border-radius: 12px;
      color: white;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s;
      margin-top: 1rem;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(139, 69, 19, 0.3);
      background: linear-gradient(135deg, var(--bakery-dark-brown), var(--bakery-brown));
    }

    .divider {
      text-align: center;
      margin: 1.5rem 0;
      position: relative;
    }

    .divider::before {
      content: '';
      position: absolute;
      left: 0;
      top: 50%;
      width: 100%;
      height: 1px;
      background: #e9ecef;
    }

    .divider span {
      background: white;
      padding: 0 1rem;
      position: relative;
      color: #6c757d;
      font-size: 0.9rem;
    }

    .btn-google {
      width: 100%;
      padding: 0.9rem;
      background: white;
      border: 2px solid #e9ecef;
      border-radius: 12px;
      color: #333;
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.75rem;
      transition: all 0.3s;
    }

    .btn-google:hover {
      border-color: #4285f4;
      background: #f8f9fa;
      color: #4285f4;
    }

    .google-icon {
      width: 20px;
      height: 20px;
    }

    .form-footer {
      text-align: center;
      margin-top: 2rem;
      padding-top: 1.5rem;
      border-top: 1px solid #f0f0f0;
    }

    .form-footer a {
      color: var(--bakery-brown);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s;
    }

    .form-footer a:hover {
      color: var(--bakery-dark-brown);
    }

    .back-home {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      color: #6c757d;
      text-decoration: none;
      font-size: 0.9rem;
      margin-top: 1rem;
      transition: color 0.2s;
    }

    .back-home:hover {
      color: var(--bakery-brown);
    }

    .alert {
      border-radius: 12px;
      border: none;
      padding: 1rem;
      margin-bottom: 1.5rem;
    }

    /* Mobile */
    @media (max-width: 991px) {
      .brand-panel {
        display: none;
      }

      .form-panel {
        padding: 1.5rem;
      }

      .login-card {
        padding: 2rem;
      }
    }
  </style>
</head>

<body>
  <div class="login-container">
    <!-- Brand Panel -->
    <div class="brand-panel">
      <div class="brand-content">
        <img loading="lazy" src="{{ asset('storage/image/logo1.png') }}" alt="Wijaya Bakery" class="brand-logo">
        <h1 class="brand-title">Wijaya Bakery</h1>
        <p class="brand-tagline">Roti dan kue segar dengan resep turun-temurun sejak 1990</p>

        <!-- <div class="brand-features">
          <div class="feature-item">
            <div class="feature-icon">🥐</div>
            <span class="feature-text">Roti segar setiap hari</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon">🛒</div>
            <span class="feature-text">Pesan online dengan mudah</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon">💝</div>
            <span class="feature-text">Kualitas terjamin</span>
          </div>
        </div> -->
      </div>
    </div>

    <!-- Form Panel -->
    <div class="form-panel">
      <div class="login-card">
        <div class="login-header">
          <h2>Selamat Datang!</h2>
          <p>Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        @if(session('error'))
          <div class="alert alert-danger">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
          </div>
        @endif

        @if(session('success'))
          <div class="alert alert-success">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
          </div>
        @endif

        <form method="POST" action="{{ route('user.login') }}">
          @csrf

          <div class="form-floating position-relative">
            <i class="bi bi-person input-icon"></i>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
              name="username" placeholder="Username" required autofocus value="{{ old('username') }}">
            <label for="username">Username</label>
            @error('username')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-floating position-relative">
            <i class="bi bi-lock input-icon"></i>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
              name="password" placeholder="Password" required>
            <label for="password">Password</label>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="text-end mb-3">
            <a href="{{ route('password.request') }}" class="text-decoration-none"
              style="color: var(--bakery-brown); font-size: 0.9rem;">
              Lupa Password?
            </a>
          </div>

          <button type="submit" class="btn btn-login">
            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
          </button>
        </form>

        <div class="divider">
          <span>atau</span>
        </div>

        <a href="{{ route('google.login') }}" class="btn btn-google">
          <svg class="google-icon" viewBox="0 0 24 24">
            <path fill="#4285F4"
              d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
            <path fill="#34A853"
              d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
            <path fill="#FBBC05"
              d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
            <path fill="#EA4335"
              d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
          </svg>
          Masuk dengan Google
        </a>

        <div class="form-footer">
          <p class="mb-2">Belum punya akun? <a href="{{ route('user.register.form') }}">Daftar Sekarang</a></p>
          <a href="/" class="back-home">
            <i class="bi bi-arrow-left"></i>Kembali ke Beranda
          </a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>