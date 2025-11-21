<!-- Enhanced Navbar Component - Dynamic and Comfortable -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #8b5e3c;">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="/">
      <img src="{{ asset('image/logo1.png') }}" alt="Wijaya Bakery" width="35" height="35" class="me-2">
      <span class="fw-bold">Wijaya Bakery</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="/#about">Tentang</a></li>
        <li class="nav-item"><a class="nav-link" href="/#menu">Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="/#promo">Promo</a></li>
        @yield('navbar-links')
      </ul>
      <ul class="navbar-nav">
        @auth
          <!-- Cart Button -->
          <li class="nav-item me-2">
            <a href="{{ route('cart.index') }}" class="btn btn-outline-light position-relative">
              <i class="bi bi-cart"></i>
              @if(Auth::user()->cartCount() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ Auth::user()->cartCount() }}
                </span>
              @endif
            </a>
          </li>
          <!-- User Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item">
            <a class="btn btn-outline-light me-2" href="{{ route('user.login.form') }}">
              <i class="bi bi-box-arrow-in-right me-1"></i>Login
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-light" href="{{ route('user.register.form') }}">
              <i class="bi bi-person-plus me-1"></i>Daftar
            </a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<style>
/* Enhanced Navbar - Dynamic and Comfortable */
.navbar {
  background: linear-gradient(135deg, rgba(139, 111, 71, 0.95), rgba(93, 78, 55, 0.95)) !important;
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 2px 20px rgba(139, 111, 71, 0.1);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.navbar-brand {
  font-family: 'Playfair Display', serif;
  font-weight: 700;
  font-size: 1.4rem;
  color: #ffffff !important;
  text-decoration: none;
  transition: all 0.3s ease;
}

.navbar-brand:hover {
  transform: translateY(-1px);
  color: rgba(255, 255, 255, 0.9) !important;
}

.navbar-brand img {
  filter: brightness(1.1) contrast(1.2);
  transition: transform 0.3s ease;
}

.navbar-brand:hover img {
  transform: scale(1.05);
}

.navbar-nav .nav-link {
  font-family: 'Inter', sans-serif;
  font-weight: 500;
  font-size: 1rem;
  color: rgba(255, 255, 255, 0.9) !important;
  padding: 0.75rem 1rem !important;
  border-radius: 8px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.navbar-nav .nav-link::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
  transition: left 0.5s ease;
}

.navbar-nav .nav-link:hover::before {
  left: 100%;
}

.navbar-nav .nav-link:hover {
  color: #ffffff !important;
  transform: translateY(-1px);
  background-color: rgba(255, 255, 255, 0.05) !important;
}

.navbar-toggler {
  border: 2px solid rgba(255, 255, 255, 0.2) !important;
  border-radius: 8px !important;
  padding: 0.4rem 0.6rem !important;
  background: rgba(255, 255, 255, 0.05) !important;
  transition: all 0.3s ease !important;
}

.navbar-toggler:hover {
  background: rgba(255, 255, 255, 0.1) !important;
  border-color: rgba(255, 255, 255, 0.4) !important;
}

.navbar-toggler-icon {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E") !important;
}

.btn-outline-light {
  background: rgba(255, 255, 255, 0.1) !important;
  border-color: rgba(255, 255, 255, 0.4) !important;
  color: rgba(255, 255, 255, 0.9) !important;
  border-radius: 8px !important;
  padding: 0.5rem 1rem !important;
  font-weight: 600 !important;
  backdrop-filter: blur(5px);
  transition: all 0.3s ease !important;
}

.btn-outline-light:hover {
  background: rgba(255, 255, 255, 0.2) !important;
  color: #ffffff !important;
  transform: translateY(-1px) !important;
  border-color: rgba(255, 255, 255, 0.6) !important;
  box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1) !important;
}

.btn-light {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.25)) !important;
  border: 1px solid rgba(255, 255, 255, 0.3) !important;
  color: #ffffff !important;
  border-radius: 8px !important;
  padding: 0.5rem 1rem !important;
  font-weight: 600 !important;
  transition: all 0.3s ease !important;
  backdrop-filter: blur(5px);
}

.btn-light:hover {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.35)) !important;
  transform: translateY(-1px) !important;
  box-shadow: 0 4px 12px rgba(255, 255, 255, 0.15) !important;
  color: #ffffff !important;
}

.dropdown-menu {
  background: rgba(139, 111, 71, 0.95) !important;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1) !important;
  border-radius: 12px !important;
  box-shadow: 0 8px 32px rgba(139, 111, 71, 0.2) !important;
  margin-top: 0.5rem !important;
}

.dropdown-item {
  color: rgba(255, 255, 255, 0.9) !important;
  font-weight: 500 !important;
  padding: 0.5rem 1rem !important;
  transition: all 0.3s ease !important;
}

.dropdown-item:hover {
  background: rgba(255, 255, 255, 0.1) !important;
  color: #ffffff !important;
  transform: translateX(4px) !important;
}
</style>
