<!-- Fresh Bakery Navbar - Warm & Inviting 🥐 -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bakery-navbar">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="/">
      <img loading="lazy" src="{{ asset('storage/image/logo1.png') }}" alt="Wijaya Bakery" width="40" height="40"
        class="me-2 brand-logo">
      <span class="brand-text">Wijaya Bakery</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="/#about">Tentang</a></li>
        <li class="nav-item"><a class="nav-link" href="/#menu">Menu</a></li>
        @yield('navbar-links')
      </ul>
      <ul class="navbar-nav">
        @auth
          <!-- Cart Button -->
          <li class="nav-item me-2">
            <a href="{{ route('cart.index') }}" class="btn btn-cart position-relative">
              <i class="bi bi-cart3"></i>
              @if(Auth::user()->cartCount() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cart-badge">
                  {{ Auth::user()->cartCount() }}
                </span>
              @endif
            </a>
          </li>
          <!-- User Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle user-dropdown" href="#" id="userDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end bakery-dropdown">
              <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="bi bi-person me-2"></i>Profile</a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item">
            <a class="btn btn-login me-2" href="{{ route('user.login.form') }}">
              <i class="bi bi-box-arrow-in-right me-1"></i>Login
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-register" href="{{ route('user.register.form') }}">
              <i class="bi bi-person-plus me-1"></i>Daftar
            </a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<style>
  /* ============================================
   🥐 Fresh Bakery Navbar - Warm & Fresh Brown
   ============================================ */

  /* Fresh Bakery Color Tokens */
  :root {
    --navbar-bg: rgba(245, 235, 220, 0.97);
    --navbar-text: #4E342E;
    --navbar-accent: #8B4513;
    --navbar-accent-light: #A0522D;
    --navbar-hover-bg: rgba(139, 69, 19, 0.1);
    --navbar-shadow: rgba(78, 52, 46, 0.12);
  }

  /* Main Navbar */
  .bakery-navbar {
    background: var(--navbar-bg) !important;
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    border-bottom: 1px solid rgba(160, 82, 45, 0.12);
    box-shadow:
      0 4px 30px var(--navbar-shadow),
      0 1px 3px rgba(0, 0, 0, 0.04);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    padding: 0.6rem 0;
  }

  .bakery-navbar:hover {
    box-shadow:
      0 6px 40px rgba(93, 64, 55, 0.12),
      0 2px 6px rgba(0, 0, 0, 0.05);
  }

  /* Brand Logo & Text */
  .navbar-brand {
    font-family: 'Playfair Display', Georgia, serif;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .brand-logo {
    filter: drop-shadow(0 2px 4px rgba(93, 64, 55, 0.15));
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
  }

  .navbar-brand:hover .brand-logo {
    transform: scale(1.1) rotate(-5deg);
    filter: drop-shadow(0 4px 8px rgba(93, 64, 55, 0.2));
  }

  .brand-text {
    font-weight: 700;
    font-size: 1.5rem;
    background: linear-gradient(135deg, #8B4513 0%, #A0522D 50%, #CD853F 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    transition: all 0.3s ease;
  }

  .navbar-brand:hover .brand-text {
    transform: translateY(-1px);
  }

  /* Nav Links */
  .bakery-navbar .nav-link {
    font-family: 'Inter', -apple-system, sans-serif;
    font-weight: 500;
    font-size: 0.95rem;
    color: var(--navbar-text) !important;
    padding: 0.6rem 1.1rem !important;
    margin: 0 0.15rem;
    border-radius: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
  }

  /* Shimmer effect on hover */
  .bakery-navbar .nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg,
        transparent,
        rgba(205, 133, 63, 0.15),
        transparent);
    transition: left 0.5s ease;
  }

  .bakery-navbar .nav-link:hover::before {
    left: 100%;
  }

  /* Underline effect */
  .bakery-navbar .nav-link::after {
    content: '';
    position: absolute;
    bottom: 6px;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--navbar-accent), var(--navbar-accent-light));
    border-radius: 2px;
    transition: all 0.3s ease;
    transform: translateX(-50%);
  }

  .bakery-navbar .nav-link:hover::after {
    width: 60%;
  }

  .bakery-navbar .nav-link:hover {
    color: var(--navbar-accent) !important;
    background: var(--navbar-hover-bg);
    transform: translateY(-2px);
  }

  /* Toggler for Mobile */
  .bakery-navbar .navbar-toggler {
    border: 2px solid rgba(160, 82, 45, 0.3) !important;
    border-radius: 10px !important;
    padding: 0.5rem 0.7rem !important;
    background: rgba(160, 82, 45, 0.05) !important;
    transition: all 0.3s ease !important;
  }

  .bakery-navbar .navbar-toggler:hover,
  .bakery-navbar .navbar-toggler:focus {
    background: rgba(160, 82, 45, 0.1) !important;
    border-color: rgba(160, 82, 45, 0.5) !important;
    box-shadow: 0 0 0 3px rgba(160, 82, 45, 0.1) !important;
  }

  .bakery-navbar .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='%23A0522D' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E") !important;
  }

  /* Cart Button */
  .btn-cart {
    background: linear-gradient(135deg, rgba(160, 82, 45, 0.1), rgba(205, 133, 63, 0.08)) !important;
    border: 1.5px solid rgba(160, 82, 45, 0.35) !important;
    color: var(--navbar-accent) !important;
    border-radius: 10px !important;
    padding: 0.55rem 1rem !important;
    font-weight: 600 !important;
    backdrop-filter: blur(5px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
  }

  .btn-cart:hover {
    background: linear-gradient(135deg, rgba(160, 82, 45, 0.18), rgba(205, 133, 63, 0.12)) !important;
    border-color: var(--navbar-accent) !important;
    color: #8B4513 !important;
    transform: translateY(-2px) scale(1.02) !important;
    box-shadow: 0 6px 20px rgba(160, 82, 45, 0.2) !important;
  }

  .cart-badge {
    background: linear-gradient(135deg, #E74C3C, #C0392B) !important;
    font-size: 0.7rem;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(231, 76, 60, 0.4);
    animation: pulse-badge 2s infinite;
  }

  @keyframes pulse-badge {

    0%,
    100% {
      transform: translate(-50%, -50%) scale(1);
    }

    50% {
      transform: translate(-50%, -50%) scale(1.1);
    }
  }

  /* Login Button */
  .btn-login {
    background: transparent !important;
    border: 1.5px solid rgba(160, 82, 45, 0.4) !important;
    color: var(--navbar-accent) !important;
    border-radius: 10px !important;
    padding: 0.5rem 1.2rem !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
  }

  .btn-login:hover {
    background: rgba(160, 82, 45, 0.08) !important;
    border-color: var(--navbar-accent) !important;
    color: #8B4513 !important;
    transform: translateY(-2px) !important;
  }

  /* Register Button */
  .btn-register {
    background: linear-gradient(135deg, var(--navbar-accent), #CD853F) !important;
    border: none !important;
    color: #ffffff !important;
    border-radius: 10px !important;
    padding: 0.55rem 1.3rem !important;
    font-weight: 600 !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    box-shadow: 0 4px 15px rgba(160, 82, 45, 0.3);
  }

  .btn-register:hover {
    background: linear-gradient(135deg, #CD853F, var(--navbar-accent)) !important;
    transform: translateY(-2px) scale(1.02) !important;
    box-shadow: 0 6px 25px rgba(160, 82, 45, 0.4) !important;
    color: #ffffff !important;
  }

  /* User Dropdown */
  .user-dropdown {
    background: rgba(160, 82, 45, 0.08);
    border-radius: 10px;
    padding: 0.5rem 1rem !important;
    color: var(--navbar-text) !important;
  }

  .user-dropdown:hover {
    background: rgba(160, 82, 45, 0.12);
    color: var(--navbar-accent) !important;
  }

  /* Dropdown Menu */
  .bakery-dropdown {
    background: rgba(255, 253, 250, 0.98) !important;
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    border: 1px solid rgba(160, 82, 45, 0.12) !important;
    border-radius: 14px !important;
    box-shadow:
      0 10px 40px rgba(93, 64, 55, 0.12),
      0 0 0 1px rgba(160, 82, 45, 0.05) !important;
    margin-top: 0.6rem !important;
    padding: 0.5rem !important;
    overflow: hidden;
  }

  .bakery-dropdown .dropdown-item {
    color: var(--navbar-text) !important;
    font-weight: 500 !important;
    padding: 0.65rem 1rem !important;
    border-radius: 8px !important;
    transition: all 0.25s ease !important;
    margin: 0.15rem 0;
  }

  .bakery-dropdown .dropdown-item:hover {
    background: linear-gradient(135deg, rgba(160, 82, 45, 0.1), rgba(205, 133, 63, 0.08)) !important;
    color: var(--navbar-accent) !important;
    transform: translateX(5px) !important;
  }

  .bakery-dropdown .dropdown-divider {
    border-color: rgba(160, 82, 45, 0.1) !important;
    margin: 0.4rem 0.5rem !important;
  }

  /* Mobile Responsive */
  @media (max-width: 991.98px) {
    .bakery-navbar {
      padding: 0.5rem 0;
    }

    .navbar-collapse {
      background: rgba(255, 253, 250, 0.98);
      border-radius: 16px;
      margin-top: 1rem;
      padding: 1rem;
      border: 1px solid rgba(160, 82, 45, 0.1);
      box-shadow: 0 8px 32px rgba(93, 64, 55, 0.1);
    }

    .bakery-navbar .nav-link {
      padding: 0.8rem 1rem !important;
      margin: 0.2rem 0;
    }

    .bakery-navbar .nav-link::after {
      display: none;
    }

    .btn-login,
    .btn-register,
    .btn-cart {
      width: 100%;
      text-align: center;
      margin: 0.3rem 0 !important;
    }
  }
</style>
