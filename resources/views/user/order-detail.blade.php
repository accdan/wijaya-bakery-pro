<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Pesanan | Wijaya Bakery</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --brown: #8b5e3c;
            --light-brown: #d4b896;
        }
        body {
            background-color: #faf8f5;
        }
        .navbar-custom {
            background-color: var(--brown);
        }
        .discount-badge {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('image/logo1.png') }}" alt="Wijaya Bakery" width="35" height="35" class="me-2">
                <span>Wijaya Bakery</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    @auth
                        <li class="nav-item me-2">
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-light">
                                <i class="bi bi-cart"></i>
                                @if(\App\Models\Cart::where('user_id', Auth::user()->id)->sum('quantity') > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ \App\Models\Cart::where('user_id', Auth::user()->id)->sum('quantity') }}
                                    </span>
                                @endif
                                Keranjang
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="btn btn-outline-light me-2" href="{{ route('user.login.form') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid py-4" style="background-color: #faf8f5; min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Back Button -->
                    <div class="mb-3">
                        <a href="{{ route('user.profile') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Profile
                        </a>
                    </div>

                    <!-- Order Header -->
                    <div class="card mb-4">
                        <div class="card-header" style="background-color: #8b5e3c; color: white;">
                            <h4 class="mb-0">
                                <i class="bi bi-receipt me-2"></i>
                                Detail Pesanan {{ $orderDate->format('d M Y, H:i') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Order ID:</strong> #{{ substr($timestamp, -8) }}</p>
                                    <p><strong>Tanggal:</strong> {{ $orderDate->format('l, d F Y') }}</p>
                                    <p><strong>Pukul:</strong> {{ $orderDate->format('H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Status:</strong>
                                        <span class="badge bg-success">Selesai</span>
                                    </p>
                                    <p><strong>Pembayaran:</strong>
                                        <span class="badge bg-info">COD</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-cart me-2"></i>Detail Item</h5>
                        </div>
                        <div class="card-body">
                            @foreach($orderItems as $index => $item)
                                <div class="row align-items-center mb-3 pb-3 {{ $loop->last ? '' : 'border-bottom' }}">
                                    <div class="col-auto">
                                        <div class="position-relative">
                                            @if($item->menu && $item->menu->gambar_menu)
                                                <img src="{{ asset('uploads/menu/' . $item->menu->gambar_menu) }}"
                                                     alt="{{ $item->menu->nama_menu }}"
                                                     class="img-fluid rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                     style="width: 60px; height: 60px;">
                                                    <i class="bi bi-image text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col">
                                        <h6 class="mb-1">{{ $item->menu->nama_menu ?? 'Menu tidak ditemukan' }}</h6>
                                        <p class="text-muted small mb-1">{{ $item->menu->deskripsi_menu ? Str::limit($item->menu->deskripsi_menu, 60) : '' }}</p>
                                        <small class="text-muted">
                                            <i class="bi bi-tag me-1"></i>
                                            @if($item->harga_satuan)
                                                Rp {{ number_format($item->harga_satuan, 0, ',', '.') }} x {{ $item->jumlah }}
                                            @endif
                                        </small>

                                        @if($item->promo || ($item->promo_id && $item->discount_amount))
                                            <br>
                                            <span class="discount-badge me-2">
                                                <i class="bi bi-tag-fill me-1"></i>
                                                Promo: {{ $item->promo ? $item->promo->nama_promo : 'Diskon Applied' }}
                                                @if($item->discount_type === 'percentage')
                                                    ({{ $item->discount_value }}% off)
                                                @elseif($item->discount_type === 'fixed')
                                                    (Rp {{ number_format($item->discount_value, 0, ',', '.') }} off)
                                                @endif
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-auto text-end">
                                        <div class="h5 mb-1">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</div>
                                        @if($item->discount_amount && $item->discount_amount > 0)
                                            <small class="text-muted">
                                                <s>Rp {{ number_format($item->total_harga + ($item->discount_amount ?? 0), 0, ',', '.') }}</s>
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-calculator me-2"></i>Rincian Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-2"><strong>Subtotal:</strong></p>
                                    @if($discountTotal > 0)
                                        <p class="mb-2"><strong>Diskon:</strong></p>
                                    @endif
                                </div>
                                <div class="col-sm-6 text-end">
                                    <p class="mb-2">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                                    @if($discountTotal > 0)
                                        <p class="mb-2 text-success">- Rp {{ number_format($discountTotal, 0, ',', '.') }}</p>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4 class="mb-0"><strong>Total Pembayaran:</strong></h4>
                                </div>
                                <div class="col-sm-6 text-end">
                                    <h4 class="mb-0 text-primary">Rp {{ number_format($finalTotal, 0, ',', '.') }}</h4>
                                </div>
                            </div>

                            @if($discountTotal > 0)
                                <div class="alert alert-success mt-3" role="alert">
                                    <i class="bi bi-trophy-fill me-2"></i>
                                    <strong>Selamat!</strong> Anda berhasil menghemat Rp {{ number_format($discountTotal, 0, ',', '.') }} dengan promo.
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4 d-flex gap-2 justify-content-center">
                        <a href="#orderItems" class="btn btn-outline-primary">
                            <i class="bi bi-info-circle me-2"></i>Lihat Detail Item
                        </a>
                        <a href="#payment" class="btn btn-outline-success">
                            <i class="bi bi-receipt me-2"></i>Lihat Invoice (Coming Soon)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>
