<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wijaya Bakery</title>
  <link rel="icon" href="{{ asset('image/logo1.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@300;600;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --cream: #E7EFC7;
      --sage: #AEC8A4;
      --brown: #8A784E;
      --dark-brown: #3B3B1A;
    }

    body {
      font-family: 'Nunito', sans-serif;
      background-color: var(--cream);
      color: var(--dark-brown);
    }

    h1, h2, h3, h4 {
      font-family: 'Pacifico', cursive;
      color: var(--dark-brown);
    }

    .hero {
      background: url('{{ $hero && $hero->gambar ? asset("uploads/hero/" . $hero->gambar) : asset("images/hero-bg1.jpeg") }}') no-repeat center center/cover;
      height: 100vh;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 0 1rem;
      position: relative;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.3);
    }

    .hero h1 {
      font-size: 4.5rem;
      align-self: flex-start;
      margin-left: 5%;
      color: #E7EFC7;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
      position: relative;
      z-index: 1;
    }

    .hero .lead {
      font-size: 1.5rem;
      color: #E7EFC7;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
      position: relative;
      z-index: 1;
      align-self: flex-start;
      margin-left: 5%;
      margin-top: 1rem;
    }

    .about-us, .promo {
      background-color: var(--sage);
    }

    .footer {
      background-color: #3B3B1A;
    }

    .section-title {
      font-size: 2.5rem;
      margin-bottom: 1rem;
    }

    .card-img-top {
      object-fit: cover;
      height: 200px;
    }

    .whatsapp-float {
      position: fixed;
      bottom: 10px;
      right: 15px;
      z-index: 999;
      width: 250px;
      height: 300px;
    }


    .whatsapp-float img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .whatsapp-float:hover {
      transform: scale(1.1);
    }
    section[id] {
      scroll-margin-top: 100px;
    }

    nav {
      position: sticky;
      top: 0;
      background-color: white;
      z-index: 1000;
    }
    .rotate-box {
      transition: transform 0.6s ease-in-out;
      animation: rotateBox 10s infinite linear;
    }

    @keyframes rotateBox {
      0%   { transform: rotateY(0); }
      25%  { transform: rotateY(5deg); }
      50%  { transform: rotateY(0); }
      75%  { transform: rotateY(-5deg); }
      100% { transform: rotateY(0); }
    }
    .text-custom {
    color: var(--dark-brown);
    }
    .about-box {
      background-color: var(--cream);
      border-radius: 10px;
      border: 2px dashed var(--brown);
    }
    .border-custom {
      border: 4px solid var(--brown);
    }
  </style>
</head>
<body>

<!-- Hero -->
@php
    $heroImage = $hero && $hero->gambar
        ? asset('uploads/hero/' . $hero->gambar)
        : asset('images/hero-bg1.jpeg');
@endphp

<section id="hero" class="hero text-center" style="background: url('{{ $heroImage }}') no-repeat center center/cover;">
  <div class="container">
    <h1 class="display-3">Selamat Datang di Wijaya Bakery</h1>
    <p class="lead">Roti dan kue terenak se-Malang Raya 🍰</p>
  </div>
</section>


<!-- About Section -->
<section id="about" class="about-us py-5">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      
      <!-- Gambar di kiri -->
      <div class="col-md-5 mb-4 mb-md-0 text-center">
        <img src="{{ asset('images/bakery1.jpeg') }}" 
             alt="Wijaya Bakery" 
             class="img-fluid rounded shadow border-custom"
             style="width: 300px; height: 320px; object-fit: cover;">
      </div>
      
      <!-- Deskripsi di kanan -->
      <div class="col-md-7 text-center text-md-start">
        <h2 class="section-title text-custom">Tentang Wijaya Bakery</h2>
        <div class="about-box p-4 mb-4">
          {!! $data->about_deskripsi ?? '
            <p>
              Sejak 1990, Wijaya Bakery telah menghadirkan roti dan kue berkualitas tinggi 
              dengan resep turun temurun. Kami menggunakan bahan-bahan pilihan dan dipanggang 
              dengan penuh cinta untuk memberikan pengalaman rasa yang tak terlupakan.
            </p>' 
          !!}
        </div>
      </div>

    </div>
  </div>
</section>


<!-- Explore More -->
<section id="menu" class="py-5" style="background-color: #E7EFC7;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title" style="color: #3B3B1A;">Jelajahi Menu Kami</h2>
      <p class="lead" style="color: #8A784E;">Pilih dari berbagai macam roti dan kue lezat kami</p>
    </div>
    
    <div class="row g-4">
      @forelse ($menus as $menu)
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100 border-0 shadow" style="border-radius: 15px; overflow: hidden; transition: transform 0.3s; border: 2px solid #8A784E;">
          <div style="overflow: hidden; height: 230px;">
            <img src="{{ $menu->gambar_menu ? asset('uploads/menu/' . $menu->gambar_menu) : asset('image/default.jpg') }}"
                 class="card-img-top w-100 h-100"
                 alt="{{ $menu->nama_menu }}"
                 style="object-fit: cover; transition: transform 0.5s;">
          </div>
          <div class="card-body d-flex flex-column" style="background-color: #AEC8A4;">
            <h5 class="card-title fw-bold" style="color: #3B3B1A;">{{ $menu->nama_menu }}</h5>
            <p class="card-text mb-3" style="color: #3B3B1A;">{{ \Illuminate\Support\Str::limit($menu->deskripsi_menu, 80) }}</p>
            <div class="mt-auto">
              <button class="btn w-100" style="background-color: #8A784E; color: white; border: none; font-weight: 600;">Lihat Detail</button>
            </div>
          </div>
        </div>
      </div>
      @empty
          <div class="col">
              <div class="alert alert-info text-center w-100" style="background-color: #AEC8A4; color: #3B3B1A; border: 1px solid #8A784E;">
                  Belum ada menu yang tersedia.
              </div>
          </div>
      @endforelse
    </div>
  </div>
</section>

@if($promos->where('status', 1)->count())
<section id="promo-grid" class="py-5 text-center bg-light">
  <div class="container">
    <h2 class="section-title">Promo Terbaru</h2>
    <div class="row justify-content-center">
      @foreach($promos->where('status', 1)->take(4) as $index => $promo)
      <div class="col-6 col-md-3 mb-4">
        <div class="promo-box rotate-box">
          <img src="{{ asset('uploads/promo/' . $promo->gambar_promo) }}"
               alt="{{ $promo->nama_promo }}"
               class="img-fluid rounded shadow-sm"
               style="height: 200px; width: 100%; object-fit: cover;">
          <p class="mt-2 fw-bold">{{ $promo->nama_promo }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif


<<!-- Hubungi Kami (Sosial Media) -->
<section id="contact" class="py-5" style="background-color: var(--sage);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h2 class="section-title">Hubungi Kami</h2>
        <p class="lead mb-5">Terhubung dengan Wijaya Bakery lewat sosial media atau pesan makanan langsung di platform favoritmu!</p>
      </div>
    </div>
    
    <div class="row justify-content-center">
      <!-- Instagram -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 border-0 shadow text-center" style="background-color: var(--cream); border-radius: 15px;">
          <div class="card-body p-4">
            <i class="bi bi-instagram" style="font-size: 2.5rem; color: #E4405F;"></i>
            <h5 class="mt-3 mb-2" style="color: var(--dark-brown);">Instagram</h5>
            <p class="mb-3">@wijayabakery</p>
            <a href="https://instagram.com/wijayabakery" target="_blank" class="btn w-100" style="background-color: var(--brown); color: white;">
              Kunjungi
            </a>
          </div>
        </div>
      </div>

      <!-- GoFood -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 border-0 shadow text-center" style="background-color: var(--cream); border-radius: 15px;">
          <div class="card-body p-4">
            <i class="bi bi-bag-fill" style="font-size: 2.5rem; color: #D0021B;"></i>
            <h5 class="mt-3 mb-2" style="color: var(--dark-brown);">GoFood</h5>
            <p class="mb-3">Pesan via GoFood</p>
            <a href="https://gofood.co.id/wijayabakery" target="_blank" class="btn w-100" style="background-color: var(--brown); color: white;">
              Pesan Sekarang
            </a>
          </div>
        </div>
      </div>

      <!-- ShopeeFood -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 border-0 shadow text-center" style="background-color: var(--cream); border-radius: 15px;">
          <div class="card-body p-4">
            <i class="bi bi-shop" style="font-size: 2.5rem; color: #FF5722;"></i>
            <h5 class="mt-3 mb-2" style="color: var(--dark-brown);">ShopeeFood</h5>
            <p class="mb-3">Pesan via ShopeeFood</p>
            <a href="https://shopee.co.id/shopeefood-wijayabakery" target="_blank" class="btn w-100" style="background-color: var(--brown); color: white;">
              Pesan Sekarang
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Sponsor List -->
@if($sponsors->count())
<section id="sponsors" class="py-5" style="background-color: var(--cream);">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title">Partner Kami</h2>
      <p class="lead">Berkolaborasi dengan brand-brand terbaik</p>
    </div>
    
    <div class="row justify-content-center g-4">
      @foreach($sponsors as $sponsor)
      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <div class="card h-100 border-0 shadow-sm" style="background-color: white; border-radius: 15px; transition: transform 0.3s;">
          <div class="card-body d-flex align-items-center justify-content-center p-3">
            @if($sponsor->logo_sponsor)
              <img src="{{ asset('uploads/sponsor/' . $sponsor->logo_sponsor) }}" 
                   class="img-fluid" 
                   alt="{{ $sponsor->nama_sponsor }}"
                   style="max-height: 80px; width: auto; filter: grayscale(100%) opacity(80%); transition: filter 0.3s;">
            @else
              <div class="text-center py-3" style="color: var(--brown);">
                <i class="bi bi-building" style="font-size: 2rem;"></i>
                <div class="mt-2 small">{{ $sponsor->nama_sponsor }}</div>
              </div>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif
<!-- Footer -->
<footer class="footer py-5 text-white" style="background-color: #3B3B1A;">
  <div class="container">
    <div class="row g-4">
      <!-- Contact Info -->
      <div class="col-lg-4 mb-4">
        <div class="d-flex align-items-center mb-3">
          <img src="{{ asset('image/logo1.png') }}" alt="Wijaya Bakery Logo" width="40" height="40" class="me-2">
          <h4 class="m-0" style="font-family: 'Pacifico', cursive;">Wijaya Bakery</h4>
        </div>
        <p class="mb-3">
          <i class="bi bi-geo-alt-fill me-2"></i>
          Jl. Roti Manis No.12, Malang
        </p>
        <p class="mb-3">
          <i class="bi bi-telephone-fill me-2"></i>
          (0341) 123-456
        </p>
        <p class="mb-3">
          <i class="bi bi-envelope-fill me-2"></i>
          info@wijayabakery.com
        </p>
        <div class="social-icons mt-4">
          <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
          <a href="#" class="text-white me-3"><i class="bi bi-twitter-x"></i></a>
        </div>
      </div>

      <!-- Opening Hours -->
      <div class="col-lg-4 mb-4">
        <h5 class="mb-4">Jam Operasional</h5>
        <ul class="list-unstyled">
          <li class="mb-2 d-flex justify-content-between">
            <span>Senin - Jumat</span>
            <span>08:00 - 20:00</span>
          </li>
          <li class="mb-2 d-flex justify-content-between">
            <span>Sabtu - Minggu</span>
            <span>09:00 - 22:00</span>
          </li>
        </ul>
        <div class="mt-4">
          <h5 class="mb-3">Produk Terbaru</h5>
          <div class="d-flex mb-3">
            <img src="{{ asset('images/bakery1.jpeg') }}" alt="New Product" width="80" class="rounded me-3">
            <div>
              <h6 class="mb-1">Roti Sourdough</h6>
              <small>Dibuat dengan ragi alami</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Google Maps -->
      <div class="col-lg-4 mb-4">
        <h5 class="mb-3">Lokasi Kami</h5>
        <div class="ratio ratio-16x9 rounded overflow-hidden shadow">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31660.44115470185!2d112.71922230720519!3d-7.291346199559281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbbe1837258d%3A0x6de4060b6596563f!2sTaman%20Bungkul!5e0!3m2!1sid!2sid!4v1750739264134!5m2!1sid!2sid" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>

    <hr class="mt-4 mb-4" style="border-color: rgba(255,255,255,0.1);">

    <!-- Copyright -->
    <div class="text-center pt-2">
      <p class="mb-0">
        &copy; 2025 Wijaya Bakery. All rights reserved. | 
        <a href="#" class="text-white text-decoration-none">Privacy Policy</a> | 
        <a href="#" class="text-white text-decoration-none">Terms of Service</a>
      </p>
    </div>
  </div>
</footer>


<!-- WhatsApp Button -->
<a href="https://wa.me/6281234567890" target="_blank" class="whatsapp-float">
  <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" width="50" height="50">
</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS Smooth Scroll -->
<script>
  document.querySelectorAll('.scroll-link').forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        targetElement.scrollIntoView({
          behavior: 'smooth'
          
        });
      }
    });
  });
</script>

</body>
</html>