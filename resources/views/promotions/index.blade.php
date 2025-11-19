<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotions - Wijaya Bakery</title>

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

        .promo-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .promo-card {
            background: var(--warm-white);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .promo-card:hover {
            transform: translateY(-5px);
        }

        .discount-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .promo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .pagination {
            justify-content: center;
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
                <a href="#promotions" class="nav-link active">Promotions</a>
                <a href="{{ route('promotions.index') }}" class="nav-link">All Promotions</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="promo-hero">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">🎉 Special Promotions</h1>
            <p class="lead mb-4">Manfaatkan penawaran spesial untuk produk favorit Anda!</p>
            <a href="#promotions" class="btn btn-light btn-lg px-4 fw-bold">
                <i class="bi bi-arrow-down-circle-fill me-2"></i>
                Lihat Semua Promo
            </a>
        </div>
    </section>

    <!-- Promotions List -->
    <section id="promotions" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="mb-2">Daftar Promo Aktif</h2>
                            <p class="text-muted mb-0">{{ $promos->total() }} promo tersedia</p>
                        </div>
                        <a href="{{ route('homepage') }}#menu" class="btn btn-outline-primary">
                            <i class="bi bi-shop me-2"></i>Lihat Menu
                        </a>
                    </div>

                    @if($promos->count() > 0)
                        <div class="promo-grid">
                            @foreach($promos as $promo)
                                @php
                                    $display = App\Models\Promo::getDiscountDisplay($promo);
                                @endphp

                                <div class="promo-card position-relative" onclick="window.location.href='{{ route('promo.view', $promo->id) }}'">
                                    @if($promo->gambar_promo)
                                        <img src="{{ asset('uploads/promo/' . $promo->gambar_promo) }}" alt="{{ $promo->nama_promo }}" class="img-fluid" style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-primary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <i class="bi bi-tag-fill" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif

                                    <div class="discount-badge">
                                        {{ $display['discount_text'] }}
                                    </div>

                                    <div class="p-4">
                                        <h5 class="fw-bold mb-3" style="color: var(--text-primary);">
                                            {{ Str::limit($promo->nama_promo, 50) }}
                                        </h5>

                                        <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.5;">
                                            {{ Str::limit($promo->deskripsi_promo, 100) }}
                                        </p>

                                        <div class="mb-3">
                                            <span class="badge bg-info text-white mb-2">{{ $display['rule_description'] }}</span>
                                            @if($display['condition_text'])
                                                <small class="text-muted d-block">
                                                    <i class="bi bi-info-circle me-1"></i>{{ $display['condition_text'] }}
                                                </small>
                                            @endif
                                        </div>

                                        @if($promo->valid_until)
                                            <small class="text-danger">
                                                <i class="bi bi-clock me-1"></i>
                                                Berakhir: {{ $promo->valid_until->format('d M Y') }}
                                                ({{ $display['expires_in'] }})
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($promos->hasPages())
                            <div class="mt-5">
                                {{ $promos->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-tag-x" style="font-size: 4rem; color: var(--text-secondary);"></i>
                            <h4 class="mt-3 mb-3">Belum Ada Promo Aktif</h4>
                            <p class="text-muted mb-4">Check back later for exciting promotions!</p>
                            <a href="{{ route('homepage') }}#menu" class="btn btn-primary">
                                <i class="bi bi-arrow-left me-2"></i>Kembali ke Menu
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" style="background: linear-gradient(135deg, var(--brown), var(--dark-brown)); color: white; padding: 2rem 0;">
        <div class="container text-center">
            <small>&copy; 2025 Wijaya Bakery. All rights reserved.</small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
