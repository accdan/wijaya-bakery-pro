{{-- <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wijaya Bakery</title>

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('image/logo1.png') }}">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Fonts -->
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

    /* Hero */
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

    /* Section */
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

    /* Menu */
    .card-img-top {
      object-fit: cover;
      height: 200px;
    }

    /* WhatsApp Float */
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

    /* Scroll Margin */
    section[id] {
      scroll-margin-top: 100px;
    }

    /* Navbar */
    nav {
      position: sticky;
      top: 0;
      background-color: white;
      z-index: 1000;
    }

    /* Promo */
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
    .promo-scroll {
      overflow-x: auto;
      scroll-snap-type: x mandatory;
      padding-bottom: 10px;
    }
    .promo-box img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      cursor: pointer;
      transition: transform 0.3s;
    }
    .modal-promo img {
      width: 100%;
      height: auto;
      object-fit: contain;
      max-height: 90vh;
    }
    .promo-box:hover {
      transform: scale(1.05);
    }
    .promo-scroll::-webkit-scrollbar {
      height: 8px;
    }
    .promo-scroll::-webkit-scrollbar-thumb {
      background: #8A784E;
      border-radius: 4px;
    }
  </style>
</head>
<!-- WhatsApp Floating Button -->
<a href="https://wa.me/6282236047539" target="_blank" class="whatsapp-float">
  <img src="{{ asset('images/whatsapp.png') }}" alt="Chat via WhatsApp">
</a>
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
      <p class="lead">Roti dan kue terenak se-Probolinggo 🍰</p>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="about-us py-5">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        
        <!-- Gambar -->
        <div class="col-md-5 mb-4 mb-md-0 text-center">
          <img src="{{ asset('images/bakery1.jpeg') }}" 
               alt="Wijaya Bakery" 
               class="img-fluid rounded shadow border-custom"
               style="width: 300px; height: 320px; object-fit: cover;">
        </div>
        
        <!-- Deskripsi -->
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

<!-- Menu -->
<section id="menu" class="py-5" style="background-color: #E7EFC7;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title" style="color: #3B3B1A;">Jelajahi Menu Kami</h2>
      <p class="lead" style="color: #8A784E;">Pilih dari berbagai macam roti dan kue lezat kami</p>
    </div>
    
    <div class="row g-3"> <!-- jarak antar card sedikit lebih kecil -->
      @forelse ($menus as $menu)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm" 
               style="border-radius: 12px; overflow: hidden; transition: transform 0.3s;
                      border: 1.5px solid #8A784E; background-color: #AEC8A4;">
            <div style="overflow: hidden; height: 200px;"> <!-- tinggi diperkecil -->
              <img src="{{ $menu->gambar_menu ? asset('uploads/menu/' . $menu->gambar_menu) : asset('image/default.jpg') }}"
                   class="card-img-top w-100 h-100"
                   alt="{{ $menu->nama_menu }}"
                   style="object-fit: cover; transition: transform 0.5s;">
            </div>
            <div class="card-body d-flex flex-column p-2"> <!-- padding diperkecil -->
              <h5 class="card-title fw-bold mb-1" style="color: #3B3B1A; font-size: 0.9rem;">
                {{ $menu->nama_menu }}
              </h5>
            </div>            
          </div>
        </div>
      @empty
        <div class="col">
          <div class="alert alert-info text-center w-100" 
               style="background-color: #AEC8A4; color: #3B3B1A; border: 1.5px solid #8A784E;">
            Belum ada menu yang tersedia.
          </div>
        </div>
      @endforelse
    </div>
  </div>
</section>

<!-- Promo -->
@if($promos->where('status', 1)->count())
  <section id="promo-grid" class="py-5" style="background-color: var(--sage);">
    <div class="container">
      <!-- Judul Section -->
      <div class="text-center mb-4">
        <h2 class="fw-bold" style="color: #3B3B1A;">Promo Terbaru</h2>
        <p class="text-muted">Jangan lewatkan promo spesial dari Wijaya Bakery</p>
      </div>

      <!-- Grid Promo Scroll -->
      <div class="d-flex overflow-auto gap-3 p-3">
        @foreach ($promos as $promo)
          <!-- Grid Promo -->
          <div class="promo-box flex-shrink-0 shadow-sm" style="width: 200px; border: 2px solid #8A784E; border-radius: 12px; overflow: hidden; background: #fff;" 
               data-bs-toggle="modal" 
               data-bs-target="#promoModal{{ $promo->id }}">
            <img src="{{ asset('uploads/promo/' . $promo->gambar_promo) }}"
                 alt="{{ $promo->nama_promo }}"
                 class="img-fluid"
                 style="height: 200px; width: 100%; object-fit: cover; cursor: pointer; border-bottom: 2px solid #8A784E;">
            <p class="mt-2 fw-bold text-center" style="color: #3B3B1A;">{{ $promo->nama_promo }}</p>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="promoModal{{ $promo->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content bg-transparent border-0">
                <img src="{{ asset('uploads/promo/' . $promo->gambar_promo) }}"
                     alt="{{ $promo->nama_promo }}"
                     class="modal-promo img-fluid rounded shadow">
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endif


  <!-- Contact -->
  <section id="contact" class="py-5" style="background-color: var(--sage);">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="section-title">Hubungi Kami</h2>
          <p class="lead mb-5">
            Terhubung dengan Wijaya Bakery lewat sosial media atau pesan makanan langsung di platform favoritmu!
          </p>
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
              <a href="https://instagram.com/wijayabakery" target="_blank" 
                 class="btn w-100" style="background-color: var(--brown); color: white;">
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
              <a href="https://gofood.co.id/wijayabakery" target="_blank" 
                 class="btn w-100" style="background-color: var(--brown); color: white;">
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
              <a href="https://shopee.co.id/shopeefood-wijayabakery" target="_blank" 
                 class="btn w-100" style="background-color: var(--brown); color: white;">
                Pesan Sekarang
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Sponsors -->
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
              <div class="card h-100 border-0 shadow-sm" 
                   style="background-color: white; border-radius: 15px; transition: transform 0.3s;">
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
<footer class="footer py-4 text-white" style="background-color: var(--brown);">
  <div class="container text-center">

    <!-- Alamat -->
    <p class="mb-2">
      <i class="bi bi-geo-alt-fill me-2"></i> Jl. Roti Manis No.12, Malang
    </p>

    <!-- Email -->
    <p class="mb-2">
      <i class="bi bi-envelope-fill me-2"></i> info@wijayabakery.com
    </p>

    <!-- Jam Operasional -->
    <p class="mb-2">
      <i class="bi bi-clock-fill me-2"></i> 
      Senin - Jumat: 08:00 - 20:00 <br>
      Sabtu - Minggu: 08:00 - 22:00
    </p>

    <!-- Copyright -->
    <small>&copy; {{ date('Y') }} Wijaya Bakery. Semua Hak Dilindungi.</small>
  </div>
</footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  </body>
  </html>
   --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wijaya Bakery</title>

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('image/logo1.png') }}">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@300;600;800&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/6282236047539" target="_blank" class="whatsapp-float">
  <img src="{{ asset('images/whatsapp.png') }}" alt="Chat via WhatsApp">
</a>

<body>
  @php
    $heroImage = $hero && $hero->gambar
        ? asset('uploads/hero/' . $hero->gambar)
        : asset('images/hero-bg1.jpeg');
  @endphp

  <!-- Hero -->
  <section id="hero" class="hero text-center" style="background: url('{{ $heroImage }}') no-repeat center center/cover;">
    <div class="container">
      <h1 class="display-3">Selamat Datang di Wijaya Bakery</h1>
      <p class="lead">Roti dan kue terenak se-Probolinggo 🍰</p>
    </div>
  </section>

  <!-- About -->
  <section id="about" class="about-us py-5">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-5 mb-4 mb-md-0 text-center">
          <img src="{{ asset('images/bakery1.jpeg') }}" 
               alt="Wijaya Bakery" 
               class="img-fluid rounded shadow border-custom"
               style="width: 300px; height: 320px; object-fit: cover;">
        </div>
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

  <!-- Menu -->
  <section id="menu" class="py-5" style="background-color: #E7EFC7;">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="section-title" style="color: #3B3B1A;">Jelajahi Menu Kami</h2>
        <p class="lead" style="color: #8A784E;">Pilih dari berbagai macam roti dan kue lezat kami</p>
      </div>
      <div class="row g-3">
        @forelse ($menus as $menu)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm" 
                 style="border-radius: 12px; overflow: hidden; transition: transform 0.3s;
                        border: 1.5px solid #8A784E; background-color: #AEC8A4;">
              <div style="overflow: hidden; height: 200px;">
                <img src="{{ $menu->gambar_menu ? asset('uploads/menu/' . $menu->gambar_menu) : asset('image/default.jpg') }}"
                     class="card-img-top w-100 h-100"
                     alt="{{ $menu->nama_menu }}">
              </div>
              <div class="card-body d-flex flex-column p-2">
                <h5 class="card-title fw-bold mb-1" style="color: #3B3B1A; font-size: 0.9rem;">
                  {{ $menu->nama_menu }}
                </h5>
              </div>            
            </div>
          </div>
        @empty
          <div class="col">
            <div class="alert alert-info text-center w-100" 
                 style="background-color: #AEC8A4; color: #3B3B1A; border: 1.5px solid #8A784E;">
              Belum ada menu yang tersedia.
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Promo -->
  @if($promos->where('status', 1)->count())
    <section id="promo-grid" class="py-5" style="background-color: var(--sage);">
      <div class="container">
        <div class="text-center mb-4">
          <h2 class="fw-bold" style="color: #3B3B1A;">Promo Terbaru</h2>
          <p class="text-muted">Jangan lewatkan promo spesial dari Wijaya Bakery</p>
        </div>
        <div class="d-flex overflow-auto gap-3 p-3">
          @foreach ($promos as $promo)
            <div class="promo-box flex-shrink-0 shadow-sm" style="width: 200px; border: 2px solid #8A784E; border-radius: 12px; overflow: hidden; background: #fff;" 
                 data-bs-toggle="modal" 
                 data-bs-target="#promoModal{{ $promo->id }}">
              <img src="{{ asset('uploads/promo/' . $promo->gambar_promo) }}"
                   alt="{{ $promo->nama_promo }}"
                   class="img-fluid"
                   style="height: 200px; width: 100%; object-fit: cover; cursor: pointer; border-bottom: 2px solid #8A784E;">
              <p class="mt-2 fw-bold text-center" style="color: #3B3B1A;">{{ $promo->nama_promo }}</p>
            </div>
            <div class="modal fade" id="promoModal{{ $promo->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-transparent border-0">
                  <img src="{{ asset('uploads/promo/' . $promo->gambar_promo) }}"
                       alt="{{ $promo->nama_promo }}"
                       class="modal-promo img-fluid rounded shadow">
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- Contact -->
  <section id="contact" class="py-5" style="background-color: var(--sage);">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="section-title">Hubungi Kami</h2>
          <p class="lead mb-5">
            Terhubung dengan Wijaya Bakery lewat sosial media atau pesan makanan langsung di platform favoritmu!
          </p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
          <div class="card h-100 border-0 shadow text-center" style="background-color: var(--cream); border-radius: 15px;">
            <div class="card-body p-4">
              <i class="bi bi-instagram" style="font-size: 2.5rem; color: #E4405F;"></i>
              <h5 class="mt-3 mb-2" style="color: var(--dark-brown);">Instagram</h5>
              <p class="mb-3">@wijayabakery</p>
              <a href="https://instagram.com/wijayabakery" target="_blank" 
                 class="btn w-100" style="background-color: var(--brown); color: white;">
                Kunjungi
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card h-100 border-0 shadow text-center" style="background-color: var(--cream); border-radius: 15px;">
            <div class="card-body p-4">
              <i class="bi bi-bag-fill" style="font-size: 2.5rem; color: #D0021B;"></i>
              <h5 class="mt-3 mb-2" style="color: var(--dark-brown);">GoFood</h5>
              <p class="mb-3">Pesan via GoFood</p>
              <a href="https://gofood.co.id/wijayabakery" target="_blank" 
                 class="btn w-100" style="background-color: var(--brown); color: white;">
                Pesan Sekarang
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card h-100 border-0 shadow text-center" style="background-color: var(--cream); border-radius: 15px;">
            <div class="card-body p-4">
              <i class="bi bi-shop" style="font-size: 2.5rem; color: #FF5722;"></i>
              <h5 class="mt-3 mb-2" style="color: var(--dark-brown);">ShopeeFood</h5>
              <p class="mb-3">Pesan via ShopeeFood</p>
              <a href="https://shopee.co.id/shopeefood-wijayabakery" target="_blank" 
                 class="btn w-100" style="background-color: var(--brown); color: white;">
                Pesan Sekarang
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Sponsors -->
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
  <footer class="footer py-4 text-white" style="background-color: var(--brown);">
    <div class="container text-center">
      <p class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i> Jl. Roti Manis No.12, Malang</p>
      <p class="mb-2"><i class="bi bi-envelope-fill me-2"></i> info@wijayabakery.com</p>
      <p class="mb-2"><i class="bi bi-clock-fill me-2"></i> Senin - Jumat: 08:00 - 20:00 <br> Sabtu - Minggu: 08:00 - 22:00</p>
      <small>&copy; {{ date('Y') }} Wijaya Bakery. Semua Hak Dilindungi.</small>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
