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

  <!-- Updated fonts for better minimalist aesthetic -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
  @php
    $heroImage = $hero && $hero->gambar
        ? asset('uploads/hero/' . $hero->gambar)
        : asset('images/hero-bg1.jpeg');
  @endphp

  <!-- Simplified WhatsApp button with icon only -->
  <a href="https://wa.me/6283112116135" target="_blank" class="whatsapp-float">
    <i class="bi bi-whatsapp"></i>
  </a>

  <!-- Cleaner hero section with better content structure -->
  <section id="hero" class="hero" style="background: url('{{ $heroImage }}') no-repeat center center/cover;">
    <div class="container">
      <div class="hero-content">
        <h1>Wijaya Bakery</h1>
        <p class="lead">Roti dan kue terenak dengan resep turun temurun sejak 1990</p>
      </div>
    </div>
  </section>

  <!-- Simplified about section with better layout -->
  <section id="about" class="about-section section-padding">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-5">
          <img src="{{ asset('images/bakery1.jpeg') }}" 
               alt="Wijaya Bakery" 
               class="img-fluid about-image">
        </div>
        <div class="col-lg-7">
          <h2 class="section-title text-start">Tentang Kami</h2>
          <div class="about-content">
            {!! $data->about_deskripsi ?? '
              <p>
                Sejak 1990, Wijaya Bakery telah menghadirkan roti dan kue berkualitas tinggi 
                dengan resep turun temurun. Kami menggunakan bahan-bahan pilihan dan dipanggang 
                dengan penuh cinta untuk memberikan pengalaman rasa yang tak terlupakan.
              </p>
              <p>
                Setiap produk kami dibuat dengan dedikasi tinggi untuk memberikan kelezatan 
                yang autentik dan kualitas terbaik bagi pelanggan tercinta.
              </p>' 
            !!}
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Updated menu section with automatic sliding pagination -->
  <section id="menu" class="menu-section section-padding">
    <div class="container">
      <h2 class="section-title">Menu Kami</h2>
      <p class="section-subtitle">Pilihan roti dan kue segar setiap hari</p>

      <div class="menu-carousel-container">
        <div class="menu-carousel" id="menuCarousel">
          @php
            $menuChunks = $menus->chunk(8);
          @endphp
          
          @foreach($menuChunks as $index => $menuChunk)
            <div class="menu-page {{ $index === 0 ? 'active' : '' }}">
              <div class="row g-4 justify-content-center">
                @foreach($menuChunk as $menu)
                  <div class="col-6 col-md-4 col-lg-3">
                    <div class="menu-card">
                      <div class="menu-img">
                        <img src="{{ $menu->gambar_menu ? asset('uploads/menu/' . $menu->gambar_menu) : asset('image/default.jpg') }}"
                             alt="{{ $menu->nama_menu }}">
                      </div>
                      <div class="menu-body">
                        <h5>{{ $menu->nama_menu }}</h5>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>

        @if($menuChunks->count() > 1)
          <!-- Pagination dots -->
          <div class="menu-pagination">
            @foreach($menuChunks as $index => $chunk)
              <button class="pagination-dot {{ $index === 0 ? 'active' : '' }}" 
                      onclick="showMenuPage({{ $index }})"></button>
            @endforeach
          </div>

          <!-- Navigation arrows -->
          <button class="carousel-nav prev" onclick="prevMenuPage()">
            <i class="bi bi-chevron-left"></i>
          </button>
          <button class="carousel-nav next" onclick="nextMenuPage()">
            <i class="bi bi-chevron-right"></i>
          </button>
        @endif
      </div>
    </div>
  </section>

  <!-- Cleaner promo section -->
  @if($promos->where('status', 1)->count())
    <section id="promo" class="promo-section section-padding">
      <div class="container">
        <h2 class="section-title">Promo Spesial</h2>
        <p class="section-subtitle">Penawaran terbaik untuk Anda</p>
        
        <div class="row g-4 justify-content-center">
          @foreach ($promos as $promo)
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="promo-card" 
                   data-bs-toggle="modal" 
                   data-bs-target="#promoModal{{ $promo->id }}"
                   style="cursor: pointer;">
                <img src="{{ asset('uploads/promo/' . $promo->gambar_promo) }}"
                     alt="{{ $promo->nama_promo }}"
                     class="w-100">
                <div class="p-3 text-center">
                  <h6 class="mb-0">{{ $promo->nama_promo }}</h6>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="promoModal{{ $promo->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-transparent border-0">
                  <div class="modal-body p-0">
                    <img src="{{ asset('uploads/promo/' . $promo->gambar_promo) }}"
                         alt="{{ $promo->nama_promo }}"
                         class="w-100 rounded shadow">
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- Simplified contact section -->
  <section id="contact" class="contact-section section-padding">
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
            <p class="text-muted mb-3">@wijayabakery</p>
            <a href="https://instagram.com/wijayabakery" target="_blank" class="contact-btn">
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
            <a href="https://gofood.co.id/wijayabakery" target="_blank" class="contact-btn">
              Pesan Sekarang
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="contact-card card h-100 text-center p-4">
            <div class="contact-icon shopee-icon">
              <i class="bi bi-shop"></i>
            </div>
            <h5>ShopeeFood</h5>
            <p class="text-muted mb-3">Pesan via ShopeeFood</p>
            <a href="https://shopee.co.id/shopeefood-wijayabakery" target="_blank" class="contact-btn">
              Pesan Sekarang
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Simplified sponsors section -->
  @if($sponsors->count())
    <section id="sponsors" class="sponsors-section section-padding">
      <div class="container">
        <h2 class="section-title">Partner Kami</h2>
        <p class="section-subtitle">Berkolaborasi dengan brand terpercaya</p>
        
        <div class="row g-4 justify-content-center">
          @foreach($sponsors as $sponsor)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
              <div class="sponsor-card text-center">
                @if($sponsor->logo_sponsor)
                  <img src="{{ asset('uploads/sponsor/' . $sponsor->logo_sponsor) }}" 
                       class="img-fluid" 
                       alt="{{ $sponsor->nama_sponsor }}">
                @else
                  <div class="py-3">
                    <i class="bi bi-building" style="font-size: 2rem; color: var(--brown);"></i>
                    <div class="mt-2 small">{{ $sponsor->nama_sponsor }}</div>
                  </div>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- Modern, organized footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-section">
          <h5>Kontak</h5>
          <div class="footer-info">
            <i class="bi bi-geo-alt-fill"></i>
            <span>Jl. Roti Manis No.12, Malang</span>
          </div>
          <div class="footer-info">
            <i class="bi bi-envelope-fill"></i>
            <span>info@wijayabakery.com</span>
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
            <span>@wijayabakery</span>
          </div>
          <div class="footer-info">
            <i class="bi bi-facebook"></i>
            <span>Wijaya Bakery Official</span>
          </div>
        </div>
      </div>
      
      <div class="footer-divider"></div>
      
      <div class="footer-bottom">
        <small>&copy; {{ date('Y') }} Wijaya Bakery. Semua Hak Dilindungi.</small>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Simplified pagination scroll script -->
  <script>
    let currentMenuPage = 0;
    const totalMenuPages = {{ $menuChunks->count() }};
    let autoSlideInterval;

    function showMenuPage(pageIndex) {
      const pages = document.querySelectorAll('.menu-page');
      const dots = document.querySelectorAll('.pagination-dot');
      
      // Hide all pages
      pages.forEach(page => page.classList.remove('active'));
      dots.forEach(dot => dot.classList.remove('active'));
      
      // Show selected page
      if (pages[pageIndex]) {
        pages[pageIndex].classList.add('active');
        dots[pageIndex].classList.add('active');
      }
      
      currentMenuPage = pageIndex;
    }

    function nextMenuPage() {
      const nextPage = (currentMenuPage + 1) % totalMenuPages;
      showMenuPage(nextPage);
    }

    function prevMenuPage() {
      const prevPage = (currentMenuPage - 1 + totalMenuPages) % totalMenuPages;
      showMenuPage(prevPage);
    }

    function startAutoSlide() {
      if (totalMenuPages > 1) {
        autoSlideInterval = setInterval(nextMenuPage, 5000); // Auto slide every 5 seconds
      }
    }

    function stopAutoSlide() {
      clearInterval(autoSlideInterval);
    }

    // Initialize auto slide when page loads
    document.addEventListener('DOMContentLoaded', function() {
      startAutoSlide();
      
      // Pause auto slide on hover
      const carousel = document.getElementById('menuCarousel');
      if (carousel) {
        carousel.addEventListener('mouseenter', stopAutoSlide);
        carousel.addEventListener('mouseleave', startAutoSlide);
      }
    });

    // Existing pagination scroll script
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".pagination a").forEach(function (link) {
            link.addEventListener("click", function (e) {
                setTimeout(() => {
                    const section = document.querySelector("#menu");
                    if (section) {
                        section.scrollIntoView({ 
                            behavior: "smooth", 
                            block: "center" 
                        });
                    }
                }, 300);
            });
        });
    });
  </script>
</body>
</html>
