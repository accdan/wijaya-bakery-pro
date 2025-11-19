<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $promo->nama_promo }} - Promotions - Wijaya Bakery</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Inter:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
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
            font-family: "Inter", sans-serif;
            background-color: var(--cream);
            color: var(--text-primary);
        }

        .promo-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
        }

        .promo-details {
            background: var(--warm-white);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-top: -2rem;
            position: relative;
            z-index: 2;
        }

        .discount-highlight {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 2rem;
            border-radius: 16px;
            text-align: center;
        }

        .menu-item-card {
            background: var(--warm-white);
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .menu-item-card:hover {
            transform: translateY(-2px);
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

    <!-- Navbar (simplified version) -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(139, 111, 71, 0.1);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('homepage') }}">
                <img src="{{ asset('image/logo1.png') }}" alt="Wijaya Bakery" width="35" height="35" class="me-2">
                <span class="fw-bold" style="color: var(--brown);">Wijaya Bakery</span>
            </a>
            <div class="navbar-nav ms-auto">
                <a href="{{ route('homepage') }}" class="nav-link">Home</a>
                <a href="{{ route('promotions.index') }}" class="nav-link">Promotions</a>
                <a href="{{ route('homepage') }}#menu" class="nav-link">Menu</a>
                @auth
                    <a href="{{ route('cart.index') }}" class="nav-link">
                        <i class="bi bi-cart"></i>
                        @if(Auth::user()->cartCount() > 0)
                            <span class="badge bg-danger">{{ Auth::user()->cartCount() }}</span>
                        @endif
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Promo Header -->
    <section class="promo-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    @if($promo->gambar_promo)
                        <img src="{{ asset('uploads/promo/' . $promo->gambar_promo) }}" alt="{{ $promo->nama_promo }}" class="img-fluid rounded-3 shadow">
                    @else
                        <div class="bg-white bg-opacity-25 rounded-3 p-5 text-center">
                            <i class="bi bi-tag-fill" style="font-size: 4rem;"></i>
                        </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold mb-3">{{ $promo->nama_promo }}</h1>
                    <p class="lead mb-4">{{ $promo->deskripsi_promo }}</p>

                    @php
                        $display = App\Models\Promo::getDiscountDisplay($promo);
                    @endphp

                    <div class="mb-4">
                        <h3 class="text-warning">{{ $display['discount_text'] }}</h3>
                        <p class="mb-2">{{ $display['rule_description'] }}</p>
                        @if($display['condition_text'])
                            <small class="text-white-50">Conditions: {{ $display['condition_text'] }}</small>
                        @endif
                    </div>

                    @if($promo->valid_until)
                        <div class="alert alert-light text-dark">
                            <i class="bi bi-clock me-2"></i>
                            <strong>Offer expires:</strong> {{ $promo->valid_until->format('l, d F Y') }}
                            ({{ $display['expires_in'] }} remaining)
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Promo Details -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="promo-details mx-auto" style="max-width: 1200px;">
                <div class="card-body p-5">
                    <h3 class="mb-4 text-center">🎯 Products Eligible for This Promotion</h3>

                    @if($applicableMenus->count() > 0)
                        <div class="menu-grid">
                            @foreach($applicableMenus as $item)
                                <div class="menu-item-card">
                                    <div class="p-3">
                                        <h6 class="fw-bold mb-2">{{ $item->nama_menu }}</h6>
                                        <p class="text-muted small mb-3">{{ Str::limit($item->deskripsi_menu, 80) }}</p>

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <strong class="text-primary">Rp {{ number_format($item->harga, 0, ',', '.') }}</strong>
                                            <small class="text-muted">Stok: {{ $item->stok }}</small>
                                        </div>

                                        @if($item->stok > 0)
                                            @auth
                                                <form action="{{ route('promo.add.to.cart', [$promo->id, $item->id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <div class="input-group mb-2">
                                                        <span class="input-group-text">Qty</span>
                                                        <input type="number" name="quantity" class="form-control form-control-sm"
                                                               value="1" min="1" max="{{ $item->stok }}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-success btn-sm w-100">
                                                        <i class="bi bi-cart-plus me-1"></i>Add to Cart with Promo
                                                    </button>
                                                </form>
                                            @else
                                                <div class="alert alert-info py-2 px-3 mb-2">
                                                    <i class="bi bi-info-circle me-1"></i>
                                                    <small>Please <a href="{{ route('user.login.form') }}" class="text-decoration-none">login</a> to add to cart</small>
                                                </div>
                                                <a href="{{ route('user.login.form') }}" class="btn btn-outline-primary btn-sm w-100">
                                                    <i class="bi bi-box-arrow-in-right me-1"></i>Login to Order
                                                </a>
                                            @endauth
                                        @else
                                            <button disabled class="btn btn-secondary btn-sm w-100">
                                                <i class="bi bi-x-circle me-1"></i>Out of Stock
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-emoji-frown" style="font-size: 3rem; color: var(--text-secondary);"></i>
                            <h5 class="mt-3 mb-2">Tidak Ada Produk yang Berlaku untuk Promo Ini</h5>
                            <p class="text-muted">Coba promo lainnya atau lihat menu lengkap kami.</p>
                            <a href="{{ route('homepage') }}#menu" class="btn btn-primary">
                                <i class="bi bi-arrow-left me-2"></i>Lihat Semua Menu
                            </a>
                        </div>
                    @endif

                    <div class="text-center mt-5">
                        <div class="border-top pt-4">
                            <h4 class="mb-3">🎁 Cara Menggunakan Promo</h4>
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="bg-light rounded-circle mx-auto mb-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-tag-fill text-primary" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <h6>Pilih Produk</h6>
                                    <p class="text-muted small">Pilih produk yang berlaku untuk promo ini</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="bg-light rounded-circle mx-auto mb-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-cart-plus-fill text-success" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <h6>Tambah ke Keranjang</h6>
                                    <p class="text-muted small">Klik "Add to Cart with Promo" untuk menambahkan</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="bg-light rounded-circle mx-auto mb-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-credit-card-fill text-warning" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <h6>Checkout & Bayar</h6>
                                    <p class="text-muted small">Promo akan otomatis diterapkan saat checkout</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Promotions -->
    <section class="py-4">
        <div class="container">
            <div class="text-center">
                <a href="{{ route('promotions.index') }}" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-tag me-2"></i>Lihat Semua Promo Lainnya
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer style="background: linear-gradient(135deg, #8b6f47, #5d4e37); color: white; padding: 2rem 0;">
        <div class="container text-center">
            <small>&copy; 2025 Wijaya Bakery. Powered by Laravel & Bootstrap.</small>
        </div>
    </footer>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div id="toastSuccess" class="toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3"
             role="alert" style="z-index: 9999;">
            <div class="d-flex p-3">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div class="toast-body">{{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div id="toastError" class="toast align-items-center text-white bg-danger border-0 position-fixed top-0 end-0 m-3"
             role="alert" style="z-index: 9999;">
            <div class="d-flex p-3">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <div class="toast-body">{{ session('error') }}</div>
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Show toasts on page load
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                const toastSuccess = new bootstrap.Toast(document.getElementById('toastSuccess'));
                toastSuccess.show();
            @endif

            @if(session('error'))
                const toastError = new bootstrap.Toast(document.getElementById('toastError'));
                toastError.show();
            @endif
        });

        // Auto-hide toasts after 5 seconds
        setTimeout(function() {
            const toasts = document.querySelectorAll('.toast');
            toasts.forEach(function(toast) {
                const bsToast = bootstrap.Toast.getInstance(toast);
                if (bsToast) {
                    bsToast.hide();
                }
            });
        }, 5000);
    </script>
</body>
</html>
