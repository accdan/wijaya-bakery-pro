<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wijaya Bakery</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

  <style>
    html {
      scroll-behavior: smooth;
      scroll-padding-top: 80px;
    }

    :root {
      --cream: #faf8f5;
      --warm-white: #ffffff;
      --sage: #d4b896;
      --brown: #8b6f47;
      --dark-brown: #5d4e37;
      --text-primary: #4a3f35;
      --text-secondary: #6b5b4f;
    }

    body {
      font-family: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
      background-color: var(--cream);
      color: var(--text-primary);
      line-height: 1.6;
    }

    h1, h2, h3, h4 {
      font-family: "Playfair Display", serif;
      color: var(--text-primary);
      font-weight: 600;
    }

    /* Hero Section */
    .hero {
      height: 100vh;
      min-height: 100vh;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      padding: 0 2rem;
      position: relative;
    }

    .hero::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.4);
    }

    .hero-content {
      position: relative;
      z-index: 1;
      max-width: 600px;
    }

    .hero h1 {
      font-size: 3.5rem;
      color: var(--warm-white);
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
      margin-bottom: 1rem;
      line-height: 1.2;
    }

    .hero .lead {
      font-size: 1.2rem;
      color: var(--warm-white);
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
      font-weight: 300;
    }

    /* Section Styling */
    .section-padding {
      padding: 4rem 0;
    }

    .section-title {
      font-size: 2.2rem;
      margin-bottom: 0.5rem;
      text-align: center;
    }

    .section-subtitle {
      font-size: 1.1rem;
      color: var(--text-secondary);
      text-align: center;
      margin-bottom: 3rem;
      font-weight: 300;
    }

    /* Enhanced About Section */
    .about-section {
      background: linear-gradient(135deg, #fefefe 0%, #faf8f5 100%);
      padding: 6rem 0;
      position: relative;
      overflow: hidden;
    }

    .about-section::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background:
        radial-gradient(circle at 30% 20%, rgba(139, 111, 71, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(213, 182, 150, 0.05) 0%, transparent 50%);
      z-index: 0;
    }

    .about-content-card {
      position: relative;
      z-index: 1;
      padding: 3rem;
      background: linear-gradient(145deg, #ffffff, #faf8f5);
      border-radius: 20px;
      box-shadow:
        0 10px 30px rgba(0, 0, 0, 0.08),
        0 1px 8px rgba(0, 0, 0, 0.04),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
      border: 1px solid rgba(139, 111, 71, 0.1);
      animation: slideInLeft 0.8s ease-out;
    }

    .section-badge {
      display: inline-block;
      background: linear-gradient(45deg, var(--brown), #c49b6c);
      color: white;
      padding: 0.5rem 1.2rem;
      border-radius: 25px;
      font-size: 0.85rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 1.5rem;
      box-shadow: 0 4px 12px rgba(139, 111, 71, 0.2);
    }

    .section-title-about {
      font-size: 2.8rem;
      color: var(--text-primary);
      margin-bottom: 1rem;
      line-height: 1.2;
      background: linear-gradient(45deg, var(--brown), var(--text-primary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      animation: slideInUp 0.8s ease-out 0.2s both;
    }

    .about-subtitle {
      font-size: 1.2rem;
      color: var(--text-secondary);
      font-weight: 400;
      margin-bottom: 2rem;
      line-height: 1.6;
    }

    .about-description {
      color: var(--text-secondary);
      font-size: 1.1rem;
      line-height: 1.7;
      margin-bottom: 3rem;
      opacity: 0;
      animation: fadeInUp 0.8s ease-out 0.4s both;
    }

    .about-description p {
      margin-bottom: 1.5rem;
    }

    .about-features {
      display: flex;
      justify-content: center;
      gap: 2.5rem;
      animation: fadeInUp 0.8s ease-out 0.6s both;
    }

    .feature-item {
      text-align: center;
      padding: 1.5rem;
      background: var(--warm-white);
      border-radius: 16px;
      border: 2px solid rgba(139, 111, 71, 0.1);
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .feature-item::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(139, 111, 71, 0.1), transparent);
      transition: left 0.6s ease;
    }

    .feature-item:hover::before {
      left: 100%;
    }

    .feature-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
      border-color: rgba(139, 111, 71, 0.2);
    }

    .feature-item i {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      color: var(--brown);
    }

    .feature-text strong {
      display: block;
      font-size: 2rem;
      color: var(--text-primary);
      font-weight: 700;
    }

    .feature-text span {
      font-size: 0.9rem;
      color: var(--text-secondary);
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .about-image-container {
      position: relative;
      max-width: 500px;
      margin: 0 auto;
      animation: slideInRight 0.8s ease-out;
    }

    .about-main-image {
      width: 100%;
      border-radius: 24px;
      box-shadow:
        0 20px 40px rgba(0, 0, 0, 0.1),
        0 8px 16px rgba(0, 0, 0, 0.06),
        0 0 0 1px rgba(139, 111, 71, 0.1);
      transition: transform 0.4s ease;
    }

    .about-main-image:hover {
      transform: scale(1.02);
    }

    .about-image-overlay {
      position: absolute;
      bottom: -30px;
      right: -30px;
      width: 40%;
      height: 60%;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      z-index: 1;
      animation: bounceIn 1s ease-out 0.5s both;
    }

    .about-small-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border: 2px solid white;
    }

    .floating-element {
      position: absolute;
      top: 20px;
      left: -20px;
      width: 60px;
      height: 60px;
      background: linear-gradient(45deg, #FFD700, #FFA500);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 6px 16px rgba(255, 215, 0, 0.3);
      color: white;
      font-size: 1.5rem;
      animation: float 3s ease-in-out infinite;
      z-index: 1;
    }

    /* Menu Section - Redesigned */
    .menu-section {
      background-color: var(--sage);
      min-height: auto;
      padding: 4rem 0;
    }

    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 1.5rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .menu-card {
      background: var(--warm-white);
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      display: flex;
      flex-direction: column;
    }

    .menu-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .menu-image-container {
      position: relative;
      width: 100%;
      height: 180px;
      overflow: hidden;
      background: var(--cream);
    }

    .menu-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .menu-card:hover .menu-image {
      transform: scale(1.06);
    }

    .menu-content {
      padding: 1.2rem;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      flex-grow: 1;
    }

    .menu-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--text-primary);
      line-height: 1.3;
      margin: 0;
    }

    .menu-description {
      font-size: 0.85rem;
      color: var(--text-secondary);
      line-height: 1.5;
      flex-grow: 1;
      margin: 0;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .menu-price {
      font-size: 1.2rem;
      font-weight: 600;
      color: var(--brown);
      margin-top: 0.5rem;
      margin-bottom: 0.5rem;
    }

    .menu-actions {
      margin-top: auto;
      padding-top: 1rem;
      border-top: 1px solid rgba(139, 111, 71, 0.1);
    }

    .btn-add-cart {
      background-color: var(--brown);
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      font-size: 0.9rem;
      font-weight: 500;
      transition: all 0.3s ease;
      width: 100%;
    }

    .btn-add-cart:hover {
      background-color: var(--dark-brown);
      transform: translateY(-1px);
    }

    .btn-order-wa {
      background-color: #25d366;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      font-size: 0.9rem;
      font-weight: 500;
      transition: all 0.3s ease;
      width: 100%;
    }

    .btn-order-wa:hover {
      background-color: #1fb855;
      transform: translateY(-1px);
    }

    .stock-info {
      font-size: 0.8rem;
      color: var(--text-secondary);
      text-align: center;
      margin-top: 0.25rem;
    }

    .quantity-selector {
      display: none;
      margin-bottom: 0.5rem;
      padding: 0.5rem;
      background: rgba(139, 111, 71, 0.05);
      border-radius: 4px;
    }

    .quantity-selector.show {
      display: block;
    }

    /* Order Section */
    .order-section {
      background-color: var(--warm-white);
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 4rem 0;
    }

    .order-container {
      max-width: 800px;
      margin: 0 auto;
      background: var(--cream);
      padding: 2.5rem;
      border-radius: 16px;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
    }

    .form-label {
      font-weight: 500;
      color: var(--text-primary);
      margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
      border: 2px solid var(--sage);
      border-radius: 8px;
      padding: 0.75rem;
      transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
      border-color: var(--brown);
      box-shadow: 0 0 0 0.2rem rgba(139, 111, 71, 0.15);
    }

    .menu-item-row {
      background: var(--warm-white);
      padding: 1rem;
      border-radius: 8px;
      margin-bottom: 0.75rem;
      border: 1px solid var(--sage);
    }

    .btn-add-menu {
      background: var(--sage);
      color: var(--text-primary);
      border: none;
      padding: 0.5rem 1.5rem;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-add-menu:hover {
      background: var(--brown);
      color: white;
      transform: translateY(-1px);
    }

    .btn-remove-menu {
      background: transparent;
      color: #dc3545;
      border: 1px solid #dc3545;
      padding: 0.4rem 0.8rem;
      border-radius: 6px;
      font-size: 0.9rem;
      transition: all 0.3s ease;
    }

    .btn-remove-menu:hover {
      background: #dc3545;
      color: white;
    }

    .total-section {
      background: var(--brown);
      color: white;
      padding: 1.5rem;
      border-radius: 12px;
      margin-top: 1.5rem;
      text-align: center;
    }

    .total-label {
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
    }

    .total-price {
      font-size: 2rem;
      font-weight: 700;
      font-family: 'Playfair Display', serif;
    }

    .btn-submit-order {
      background: #25d366;
      color: white;
      border: none;
      padding: 1rem 2rem;
      border-radius: 10px;
      font-size: 1.1rem;
      font-weight: 600;
      width: 100%;
      margin-top: 1.5rem;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .btn-submit-order:hover {
      background: #1fb855;
      transform: translateY(-2px);
      box-shadow: 0 4px 16px rgba(37, 211, 102, 0.3);
    }

    /* Promo Section */
    .promo-section {
      background-color: var(--sage);
      min-height: auto;
      padding: 4rem 0;
    }

    .promo-card {
      border-radius: 12px;
      overflow: hidden;
      background: var(--warm-white);
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease;
      border: 1px solid var(--sage);
    }

    .promo-card:hover {
      transform: translateY(-2px);
    }

    .promo-card img {
      height: 180px;
      object-fit: cover;
    }

    /* Contact Section */
    .contact-section {
      background-color: var(--warm-white);
      min-height: auto;
      padding: 4rem 0;
    }

    .contact-card {
      background: var(--warm-white);
      border-radius: 16px;
      border: none;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease;
    }

    .contact-card:hover {
      transform: translateY(-2px);
    }

    .contact-icon {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1rem;
      font-size: 1.5rem;
    }

    .instagram-icon {
      background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
      color: white;
    }

    .gofood-icon {
      background: #00aa13;
      color: white;
    }

    .shopee-icon {
      background: #ee4d2d;
      color: white;
    }

    .contact-btn {
      background: var(--brown);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 0.75rem 1.5rem;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-block;
      width: 100%;
      text-align: center;
    }

    .contact-btn:hover {
      background: var(--dark-brown);
      color: white;
      transform: translateY(-1px);
    }

    /* Sponsors Section */
    .sponsors-section {
      background-color: var(--cream);
      min-height: auto;
      padding: 3rem 0;
    }

    .sponsor-card {
      padding: 1rem;
      background: var(--warm-white);
      border-radius: 8px;
      transition: transform 0.3s ease;
    }

    .sponsor-card:hover {
      transform: translateY(-2px);
    }

    /* Footer */
    .footer {
      background: linear-gradient(135deg, var(--brown) 0%, var(--dark-brown) 100%);
      color: white;
      min-height: auto;
      padding: 3rem 0 1.5rem;
    }

    .footer-content {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
      margin-bottom: 2rem;
    }

    .footer-section h5 {
      color: white;
      font-size: 1.1rem;
      margin-bottom: 1rem;
      font-weight: 600;
    }

    .footer-info {
      display: flex;
      align-items: center;
      margin-bottom: 0.75rem;
      color: rgba(255, 255, 255, 0.9);
    }

    .footer-info i {
      width: 20px;
      margin-right: 0.75rem;
      color: var(--sage);
    }

    .footer-divider {
      height: 1px;
      background: rgba(255, 255, 255, 0.2);
      margin: 2rem 0 1rem;
    }

    .footer-bottom {
      text-align: center;
      color: rgba(255, 255, 255, 0.8);
      font-size: 0.9rem;
    }

    /* WhatsApp Button */
    .whatsapp-float {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 999;
      width: 60px;
      height: 60px;
      background: #25d366;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 16px rgba(37, 211, 102, 0.3);
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .whatsapp-float:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 24px rgba(37, 211, 102, 0.4);
    }

    .whatsapp-float i {
      font-size: 1.5rem;
      color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.5rem;
      }

      .section-padding {
        padding: 2.5rem 0;
      }

      .menu-grid {
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 1rem;
      }

      .order-container {
        padding: 1.5rem;
      }

      .total-price {
        font-size: 1.5rem;
      }

      .about-features {
        flex-direction: column;
        gap: 1.5rem;
      }

      .section-title-about {
        font-size: 2.2rem;
      }
    }

    /* Animations */
    @keyframes slideInLeft {
      from {
        opacity: 0;
        transform: translateX(-50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }

    @keyframes bounceIn {
      0% {
        opacity: 0;
        transform: scale(0.3);
      }
      50% {
        opacity: 1;
        transform: scale(1.05);
      }
      70% {
        transform: scale(0.9);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }
  </style>
</head>

<body>
  <!-- Navigation Bar -->
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
          <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
          <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
          <li class="nav-item"><a class="nav-link" href="#promo">Promo</a></li>
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

  <!-- WhatsApp button -->
  <a href="https://wa.me/6282236047539" target="_blank" class="whatsapp-float">
    <i class="bi bi-whatsapp"></i>
  </a>
  @php
    $heroImage = $hero && $hero->gambar
        ? asset('uploads/hero/' . $hero->gambar)
        : asset('images/hero-bg1.jpeg');
  @endphp


  <!-- Hero Section -->
  <section id="hero" class="hero" style="background: url('{{ $heroImage }}') no-repeat center center/cover;">
    <div class="container">
      <div class="hero-content">
        <h1>Wijaya Bakery</h1>
        <p class="lead">Roti dan kue terenak dengan resep turun temurun sejak 1990</p>
      </div>
    </div>
  </section>
<!-- About Section -->
<section id="about" class="about-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about-content-card">
                    <div class="section-badge">About Us</div>
                    <h2 class="section-title-about">Tradisi Rasa Sejak 1990</h2>
                    <p class="about-subtitle">Mewarisi resep turun-temurun dengan bahan berkualitas tinggi</p>
                    <div class="about-description">
                        {!! $data->about_deskripsi ?? '<p>Didirikan sejak tahun 1990, Wijaya Bakery telah menjadi bagian dari cerita rasa yang tak terlupakan. Kami menggabungkan resep tradisional dengan sentuhan modern untuk memberikan pengalaman kuliner yang luar biasa.</p>' !!}
                    </div>
                    <div class="about-features">
                        <div class="feature-item">
                            <i class="fas fa-award text-primary"></i>
                            <div class="feature-text">
                                <strong>33+</strong>
                                <span>Tahun Pengalaman</span>
                            </div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-heart text-danger"></i>
                            <div class="feature-text">
                                <strong>10K+</strong>
                                <span>Pelanggan Puas</span>
                            </div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-utensils text-warning"></i>
                            <div class="feature-text">
                                <strong>50+</strong>
                                <span>Variasi Menu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="about-image-container">
                    <img src="{{ asset('images/bakery1.jpeg') }}"
                         alt="Wijaya Bakery"
                         class="about-main-image">
                    <div class="about-image-overlay">
                        <img src="{{ asset('images/bakery2.jpeg') }}"
                             alt="Fresh Bakery"
                             class="about-small-image">
                    </div>
                    <div class="floating-element">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


  <!-- Menu Section -->
  <section id="menu" class="menu-section">
    <div class="container">
      <h2 class="section-title">Menu Kami</h2>
      <p class="section-subtitle">Pilihan roti dan kue segar setiap hari</p>

      <div class="menu-grid">
        @foreach($menus as $menu)
          <!-- Menu Item -->
          <div class="menu-card">
            <div class="menu-image-container">
              <img src="{{ $menu->gambar_menu ? asset('uploads/menu/' . $menu->gambar_menu) : 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=600' }}" alt="{{ $menu->nama_menu }}" class="menu-image">
            </div>
            <div class="menu-content">
              <h3 class="menu-name">
                {{ $menu->nama_menu }}
                @php
                  $menuPromos = \App\Models\Promo::where('status', true)
                    ->where('is_discount_active', true)
                    ->where(function($query) use ($menu) {
                      $query->whereNull('menu_id')->orWhere('menu_id', $menu->id);
                    })
                    ->where('discount_value', '>', 0)
                    ->get();
                  $bestPromo = $menuPromos->first();
                @endphp
                @if($bestPromo)
                  <span class="badge bg-danger ms-1" style="font-size: 0.7em;">
                    <i class="fas fa-percentage me-1"></i>
                    @if($bestPromo->discount_type == 'percentage')
                      {{ $bestPromo->discount_value }}%
                    @else
                      Rp {{ number_format($bestPromo->discount_value, 0, ',', '.') }}
                    @endif
                  </span>
                @endif
              </h3>
              <p class="menu-description">{{ Str::limit($menu->deskripsi_menu, 80) }}</p>
              <div class="menu-price">
                @if($menu->stok > 0)
                  Rp {{ number_format($menu->harga, 0, ',', '.') }}
                  @if($bestPromo && $bestPromo->discount_type == 'percentage' && $bestPromo->min_quantity <= 1)
                    <small class="text-success ms-2">
                      Diskon {{ $bestPromo->discount_value }}%
                    </small>
                  @endif
                @else
                  <span>Stok Kosong</span>
                @endif
              </div>

              <div class="menu-actions">
                @if($menu->stok > 0)
                  @auth
                    <!-- Add to Cart Button -->
                    <button type="button" class="btn btn-add-cart" onclick="showAddToCartModal('{{ $menu->id }}', '{{ $menu->nama_menu }}', '{{ $menu->harga }}', '{{ $menu->stok }}')">
                      <i class="bi bi-cart-plus me-1"></i>Tambah ke Keranjang
                    </button>
                  @else
                    <!-- Login required -->
                    <a href="{{ route('user.login.form') }}" class="btn btn-add-cart">
                      <i class="bi bi-box-arrow-in-right me-1"></i>Login untuk Pesan
                    </a>
                  @endauth
                  <div class="stock-info">Stok: {{ $menu->stok }}</div>
                @else
                  <!-- WhatsApp direct -->
                  @php
                    $waMessage = "Halo, saya ingin memesan menu: {$menu->nama_menu}. Mohon konfirmasi ketersediaan.";
                    $waUrl = "https://wa.me/6283112116135?text=" . urlencode($waMessage);
                  @endphp
                  <a href="{{ $waUrl }}" target="_blank" class="btn btn-order-wa">
                    <i class="bi bi-whatsapp me-1"></i>Pesan via WhatsApp
                  </a>
                  <div class="stock-info">Stok habis</div>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Popular Menu Section -->
  @if($topMenusThisMonth->count() > 0)
  <section id="popular" class="menu-section" style="background-color: var(--sage);">
    <div class="container">
      <h2 class="section-title">Menu Terlaris Bulan Ini</h2>
      <p class="section-subtitle">Menu favorit pelanggan bulan ini</p>

      <div class="menu-grid">
        @foreach($topMenusThisMonth as $menu)
          <!-- Popular Menu Item -->
          <div class="menu-card">
            <div class="menu-image-container">
              <img src="{{ $menu->gambar_menu ? asset('uploads/menu/' . $menu->gambar_menu) : 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=600' }}" alt="{{ $menu->nama_menu }}" class="menu-image">
            </div>
            <div class="menu-content">
              <h3 class="menu-name">{{ $menu->nama_menu }}</h3>
              <p class="menu-description">Terlaris bulan ini</p>
              <div class="menu-price"><i class="fas fa-star text-warning"></i> {{ $menu->total_ordered }} porsi terjual</div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif



  <!-- Promo Section -->
  <section id="promo" class="promo-section">
    <div class="container">
      <h2 class="section-title">Promo Spesial</h2>
      <p class="section-subtitle">Penawaran terbaik untuk Anda</p>

      <div class="row g-4 justify-content-center">
        @php
          $activePromos = \App\Models\Promo::where('status', true)->latest()->limit(6)->get();
        @endphp

        @if($activePromos->count() > 0)
          @foreach($activePromos as $promo)
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="promo-card">
                @if($promo->gambar_promo)
                  <img src="{{ asset('uploads/promo/' . $promo->gambar_promo) }}" alt="{{ $promo->nama_promo }}" class="w-100">
                @else
                  <img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=600" alt="Promo" class="w-100">
                @endif
                <div class="p-3 text-center">
                  <h6 class="mb-2">{{ $promo->nama_promo }}</h6>
                  @if($promo->is_discount_active && $promo->discount_value > 0)
                    <div class="badge bg-danger mb-2">
                      <i class="fas fa-percentage me-1"></i>
                      @if($promo->discount_type == 'percentage')
                        Diskon {{ $promo->discount_value }}%
                      @else
                        Diskon Rp {{ number_format($promo->discount_value, 0, ',', '.') }}
                      @endif
                    </div>
                  @endif
                  <p class="small text-muted mb-0">{!! Str::limit($promo->deskripsi_promo, 100) !!}</p>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <div class="col-12 text-center py-5">
            <i class="fas fa-tags text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
            <h4 class="mt-3 text-muted">Belum ada promo aktif</h4>
            <p class="text-muted">Tunggu promo menarik selanjutnya!</p>
          </div>
        @endif
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="contact-section">
    <div class="container">
      <h2 class="section-title">Hubungi Kami</h2>
      <p class="section-subtitle">Terhubung dengan kami melalui platform favorit Anda</p>
      
      <div class="row g-4 justify-content-center">
        <div class="col-md-4">
          <div class="contact-card card h-100 text-center p-4">
            <div class="contact-icon instagram-icon">
              <i class="bi bi-instagram"></i>
            </div>
            <h5>Instagram</h5>
            <p class="text-muted mb-3">@wijayabakery.id</p>
            <a href="https://www.instagram.com/wijayabakery.id/" target="_blank" class="contact-btn">
              Kunjungi
            </a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="contact-card card h-100 text-center p-4">
            <div class="contact-icon gofood-icon">
              <i class="bi bi-bag-fill"></i>
            </div>
            <h5>GoFood</h5>
            <p class="text-muted mb-3">Pesan via GoFood</p>
            <a href="#" class="contact-btn">Soon</a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="contact-card card h-100 text-center p-4">
            <div class="contact-icon shopee-icon">
              <i class="bi bi-shop"></i>
            </div>
            <h5>ShopeeFood</h5>
            <p class="text-muted mb-3">Pesan via ShopeeFood</p>
            <a href="#" class="contact-btn">Soon</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Partners Section -->
  <section id="sponsors" class="sponsors-section">
    <div class="container">
      <h2 class="section-title">Partner Kami</h2>
      <p class="section-subtitle">Berkolaborasi dengan brand terpercaya</p>
      
      <div class="row g-4 justify-content-center">
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <div class="sponsor-card text-center">
            <div class="py-3">
              <i class="bi bi-building" style="font-size: 2rem; color: var(--brown);"></i>
              <div class="mt-2 small">Partner 1</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-section">
          <h5>Kontak</h5>
          <div class="footer-info">
            <i class="bi bi-geo-alt-fill"></i>
            <span>Dusun Pasar, RT. 016/RW. 004, Desa Bucor Kulon, Kecamatan Pakuniran, Probolinggo</span>
          </div>
          <div class="footer-info">
            <i class="bi bi-envelope-fill"></i>
            <span>wijayabakerybucorkulon@gmail.com</span>
          </div>
          <div class="footer-info">
            <i class="bi bi-telephone-fill"></i>
            <span>+62 822-3604-7539</span>
          </div>
        </div>
        
        <div class="footer-section">
          <h5>Jam Operasional</h5>
          <div class="footer-info">
            <i class="bi bi-clock-fill"></i>
            <div>
              <div>Senin - Jumat: 08:00 - 20:00</div>
              <div>Sabtu - Minggu: 08:00 - 22:00</div>
            </div>
          </div>
        </div>
        
        <div class="footer-section">
          <h5>Ikuti Kami</h5>
          <div class="footer-info">
            <i class="bi bi-instagram"></i>
            <span>@wijayabakery.id</span>
          </div>
        </div>
      </div>
      
      <div class="footer-divider"></div>
      
      <div class="footer-bottom">
        <small>&copy; 2024 Website dibuat oleh Danu Dwi Saputra.</small>
      </div>
    </div>
  </footer>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Add to Cart Modal -->
  <div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #8b5e3c; color: white;">
          <h5 class="modal-title" id="addToCartModalLabel">Tambah ke Keranjang</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="addToCartForm">
          @csrf
          <div class="modal-body">
            <div class="text-center mb-3">
              <img id="modalMenuImage" src="" alt="" class="img-fluid rounded mb-2" style="width: 100px; height: 100px; object-fit: cover;">
              <h5 id="modalMenuName"></h5>
              <p id="modalMenuPrice" class="text-primary fw-bold"></p>
            </div>

            <div class="mb-3">
              <label class="form-label">Jumlah Pesanan</label>
              <div class="row align-items-center">
                <div class="col-4">
                  <button type="button" class="btn btn-outline-secondary w-100" onclick="changeQuantityModal(-1)">-</button>
                </div>
                <div class="col-4">
                  <input type="number" class="form-control text-center" id="modalQuantity" name="quantity" value="1" min="1" max="10">
                </div>
                <div class="col-4">
                  <button type="button" class="btn btn-outline-secondary w-100" onclick="changeQuantityModal(1)">+</button>
                </div>
              </div>
              <div class="form-text">
                <small>Stok tersedia: <span id="modalStock"></span></small>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Total Harga</label>
              <p class="fw-bold text-primary" id="modalTotal"></p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn" style="background-color: #8b5e3c; color: white;">
              <i class="bi bi-cart-plus me-1"></i>Tambah ke Keranjang
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Fungsi untuk update hidden menu_id
    function updateMenuId(selectElement) {
      const row = selectElement.closest('.menu-item-row');
      const hiddenId = row.querySelector('.menu-id-hidden');
      const selected = selectElement.value;

      if (selected) {
        const [menuId] = selected.split('|');
        hiddenId.value = menuId;
      } else {
        hiddenId.value = '';
      }
    }

    // Fungsi untuk update harga saat menu atau jumlah dipilih/diubah
    function updatePrice(selectElement) {
      const selected = selectElement.value;
      const row = selectElement.closest('.menu-item-row');
      const priceInput = row.querySelector('.item-price');
      const hiddenPrice = row.querySelector('.harga-satuan');
      const quantity = row.querySelector('.quantity-input').value || 1;

      if (selected) {
        const [menuId, priceStr] = selected.split('|');
        const price = parseInt(priceStr);
        const itemTotal = price * parseInt(quantity);

        priceInput.value = 'Rp ' + itemTotal.toLocaleString('id-ID');
        hiddenPrice.value = price;
        calculateTotal();
      } else {
        priceInput.value = 'Rp 0';
        hiddenPrice.value = '';
        calculateTotal();
      }
    }

    // Fungsi untuk updating harga saat quantity diubah pada item yang sudah dipilih
    function updateItemPrice(inputElement) {
      const row = inputElement.closest('.menu-item-row');
      const select = row.querySelector('.menu-select');
      if (select.value) {
        updatePrice(select);
      } else {
        calculateTotal();  // Jika belum ada menu dipilih, tetap hitung total dengan yang ada
      }
    }

    // Fungsi untuk menghitung total harga
    function calculateTotal() {
      let total = 0;
      document.querySelectorAll('.menu-item-row').forEach(row => {
        const priceInput = row.querySelector('.item-price');
        const priceText = priceInput.value.replace('Rp ', '').replace(/\./g, '');
        const price = parseInt(priceText) || 0;
        total += price;
      });

      document.getElementById('totalPrice').textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    // Tambah menu item baru
    function addMenuItem() {
      const menuItemsContainer = document.getElementById('menuItems');
      const existingItems = document.querySelectorAll('.menu-item-row');
      const newIndex = existingItems.length;

      const newItem = document.createElement('div');
      newItem.className = 'menu-item-row';
      newItem.setAttribute('data-index', newIndex);
      newItem.innerHTML = `
        <div class="row g-2 align-items-end">
          <div class="col-md-5">
            <select class="form-select menu-select" required onchange="updateMenuId(this); updatePrice(this);">
              <option value="">Pilih Menu</option>
              @foreach($menus as $menu)
                @if($menu->stok > 0)
                  <option value="{{ $menu->id }}|{{ $menu->harga }}">{{ $menu->nama_menu }} - Rp {{ number_format($menu->harga, 0, ',', '.') }}</option>
                @else
                  <option disabled>{{ $menu->nama_menu }} - Stok Kosong</option>
                @endif
              @endforeach
            </select>
            <input type="hidden" name="menu[${newIndex}][menu_id]" class="menu-id-hidden">
          </div>
          <div class="col-md-3">
            <input type="number" name="menu[${newIndex}][jumlah]" class="form-control quantity-input" placeholder="Jumlah" min="1" value="1" required onchange="updateItemPrice(this)">
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control item-price" placeholder="Rp 0" readonly>
            <input type="hidden" name="menu[${newIndex}][harga_satuan]" class="harga-satuan">
          </div>
          <div class="col-md-1">
            <button type="button" class="btn btn-remove-menu w-100" onclick="removeMenuItem(this)">
              <i class="bi bi-trash"></i>
            </button>
          </div>
        </div>
      `;

      menuItemsContainer.appendChild(newItem);

      // Update visibility tombol hapus
      updateRemoveButtons();
    }

    // Hapus menu item
    function removeMenuItem(button) {
      button.closest('.menu-item-row').remove();
      updateRemoveButtons();
      calculateTotal();
      renumberMenuItems();
    }

    // Renumber menu items
    function renumberMenuItems() {
      document.querySelectorAll('.menu-item-row').forEach((row, index) => {
        row.setAttribute('data-index', index);
        const select = row.querySelector('.menu-select');
        const quantity = row.querySelector('.quantity-input');
        const hiddenPrice = row.querySelector('.harga-satuan');
        const hiddenId = row.querySelector('.menu-id-hidden');

        hiddenId.name = `menu[${index}][menu_id]`;
        quantity.name = `menu[${index}][jumlah]`;
        hiddenPrice.name = `menu[${index}][harga_satuan]`;
      });
    }

    // Update visibility tombol hapus
    function updateRemoveButtons() {
      const items = document.querySelectorAll('.menu-item-row');
      items.forEach((item, index) => {
        const removeBtn = item.querySelector('.btn-remove-menu');
        if (items.length > 1) {
          removeBtn.style.display = 'block';
        } else {
          removeBtn.style.display = 'none';
        }
      });
    }

    // Fungsi untuk handle submit pemesanan
    function handleOrderSubmit(event) {
      event.preventDefault();

      const submitButton = document.querySelector('.btn-submit-order');
      const originalText = submitButton.innerHTML;
      submitButton.innerHTML = '<i class="bi bi-hourglass-split"></i> Memproses...';
      submitButton.disabled = true;

      const form = document.getElementById('orderForm');
      const formData = new FormData(form);

      fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success && data.waUrl) {
          // Pesanan berhasil disimpan, redirect ke WhatsApp
          window.location.href = data.waUrl;
        } else {
          alert('Terjadi kesalahan saat menyimpan pesanan: ' + (data.message || 'Unknown error'));
          submitButton.innerHTML = originalText;
          submitButton.disabled = false;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses pemesanan. Silakan coba lagi.');
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
      });
    }

    // Event listener untuk menu pertama
    document.addEventListener('DOMContentLoaded', function() {
      const firstSelect = document.querySelector('.menu-select');
      if (firstSelect) {
        firstSelect.addEventListener('change', function() { updatePrice(this); });
        const firstQuantity = document.querySelector('.quantity-input');
        firstQuantity.addEventListener('input', function() { updateItemPrice(this); });
      }
    });

    // Function to show add to cart modal
    function showAddToCartModal(menuId, menuName, menuPrice, maxStock) {
      const modal = new bootstrap.Modal(document.getElementById('addToCartModal'));

      // Find menu image
      const menuCards = document.querySelectorAll('.menu-card');
      let menuImage = 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=600';
      for (let card of menuCards) {
        const cardName = card.querySelector('.menu-name')?.textContent;
        if (cardName === menuName) {
          const img = card.querySelector('.menu-image');
          if (img) {
            menuImage = img.src;
          }
          break;
        }
      }

      // Set modal content
      document.getElementById('modalMenuImage').src = menuImage;
      document.getElementById('modalMenuName').textContent = menuName;
      document.getElementById('modalMenuPrice').textContent = 'Rp ' + parseInt(menuPrice).toLocaleString('id-ID');
      document.getElementById('modalStock').textContent = maxStock;
      document.getElementById('modalQuantity').max = maxStock;
      document.getElementById('modalQuantity').value = 1;
      updateModalTotal();

      // Set up form submission
      const form = document.getElementById('addToCartForm');
      form.onsubmit = function(e) {
        e.preventDefault();
        addToCart(menuId);
      };

      modal.show();
    }

    // Function to change modal quantity
    function changeQuantityModal(change) {
      const input = document.getElementById('modalQuantity');
      const newValue = parseInt(input.value) + change;

      if (newValue >= 1 && newValue <= parseInt(input.max)) {
        input.value = newValue;
        updateModalTotal();
      }
    }

    // Function to update modal total
    function updateModalTotal() {
      const quantity = parseInt(document.getElementById('modalQuantity').value);
      const priceMatch = document.getElementById('modalMenuPrice').textContent.match(/[\d.,]+/);
      if (priceMatch) {
        const price = parseInt(priceMatch[0].replace(/[.,]/g, ''));
        const total = quantity * price;
        document.getElementById('modalTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
      }
    }

    // Function to add item to cart
    async function addToCart(menuId) {
      const quantity = parseInt(document.getElementById('modalQuantity').value);

      try {
        const response = await fetch('{{ route("cart.add", ":menuId") }}'.replace(':menuId', menuId), {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
          },
          body: JSON.stringify({ quantity: quantity })
        });

        const data = await response.json();

        if (data.success) {
          // Close modal
          const modal = bootstrap.Modal.getInstance(document.getElementById('addToCartModal'));
          modal.hide();

          // Show success message
          showToast('Item berhasil ditambahkan ke keranjang!', 'success');

          // Update cart count in navbar (you might need to reload or update this dynamically)
          // For now, we'll refresh the page to show updated cart count
          setTimeout(() => location.reload(), 1000);
        } else {
          showToast(data.message || 'Terjadi kesalahan', 'error');
        }
      } catch (error) {
        console.error('Error:', error);
        showToast('Terjadi kesalahan saat menambahkan ke keranjang', 'error');
      }
    }

    // Function to show toast notifications
    function showToast(message, type = 'info') {
      // Create toast element
      const toastHTML = `
        <div class="toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0 position-fixed top-0 end-0 m-3" role="alert">
          <div class="d-flex">
            <div class="toast-body">
              <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
              ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
          </div>
        </div>
      `;

      document.body.insertAdjacentHTML('beforeend', toastHTML);

      // Show toast
      const toastElement = document.querySelector('.toast:last-child');
      const toast = new bootstrap.Toast(toastElement);
      toast.show();

      // Remove toast after it's hidden
      toastElement.addEventListener('hidden.bs.toast', () => {
        toastElement.remove();
      });
    }
  </script>

</body>
</html>
