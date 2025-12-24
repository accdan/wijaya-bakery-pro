<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Semua Menu | Wijaya Bakery</title>

    <!-- Preconnect -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Menu Card Shared Styles -->
    <link rel="stylesheet" href="{{ asset('css/menu-card.css') }}">

    <style>
        /* ==================== CSS VARIABLES ==================== */
        :root {
            --cream: #faf8f5;
            --warm-white: #ffffff;
            --sage: #d4b896;
            --brown: #8b6f47;
            --dark-brown: #5d4e37;
            --text-primary: #4a3f35;
            --text-secondary: #6b5b4f;
        }

        /* ==================== BASE STYLES ==================== */
        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--cream);
            color: var(--text-primary);
            line-height: 1.6;
            padding-top: 80px !important;
        }

        /* ==================== PAGE HEADER ==================== */
        .page-header {
            background: linear-gradient(135deg, #8B4513 0%, #5D3A1A 100%);
            padding: 5rem 0 4rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.75rem;
            position: relative;
            z-index: 1;
        }

        .page-header p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.85);
            position: relative;
            z-index: 1;
        }

        .page-header .breadcrumb-nav {
            position: relative;
            z-index: 1;
            margin-bottom: 1rem;
        }

        .page-header .breadcrumb-nav a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .page-header .breadcrumb-nav a:hover {
            color: white;
        }

        .page-header .breadcrumb-nav span {
            color: rgba(255, 255, 255, 0.5);
            margin: 0 0.5rem;
        }

        /* ==================== FILTER SECTION ==================== */
        .filter-section {
            background: var(--warm-white);
            border-radius: 16px;
            padding: 1.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            margin-top: -3rem;
            position: relative;
            z-index: 10;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border: 2px solid var(--sage);
            border-radius: 8px;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--brown);
            box-shadow: 0 0 0 0.2rem rgba(139, 111, 71, 0.15);
        }

        /* ==================== BUTTONS ==================== */
        .btn-primary {
            background-color: var(--brown);
            border-color: var(--brown);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: var(--dark-brown);
            border-color: var(--dark-brown);
        }

        .btn-secondary {
            background-color: var(--sage);
            color: var(--text-primary);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-secondary:hover {
            background-color: var(--brown);
            color: white;
        }

        /* ==================== MENU GRID ==================== */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .menu-card {
            background: var(--warm-white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            position: relative;
            border: 2px solid transparent;
        }

        .menu-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            border-color: rgba(139, 111, 71, 0.2);
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
        }

        .menu-content {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            flex-grow: 1;
        }

        .menu-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1.3;
            margin: 0;
        }

        .menu-description {
            font-size: 0.85rem;
            color: var(--text-secondary);
            line-height: 1.4;
            flex-grow: 1;
            margin: 0;
        }

        .menu-price {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--brown);
            margin: 0.5rem 0;
        }

        .menu-category {
            display: inline-block;
            background: rgba(139, 111, 71, 0.1);
            color: var(--brown);
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .stock-info {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-top: auto;
        }

        /* ==================== PAGINATION ==================== */
        .pagination {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .pagination .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0.5rem;
            border-radius: 8px;
            border: 2px solid transparent;
            background: var(--warm-white);
            color: var(--brown);
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            text-decoration: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .pagination .page-link:hover {
            background: var(--sage);
            color: var(--brown);
            border-color: var(--brown);
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .pagination .page-item.active .page-link {
            background: var(--brown);
            color: white;
            border-color: var(--brown);
            font-weight: 600;
        }

        .pagination .page-item.disabled .page-link {
            color: var(--text-secondary);
            background: var(--cream);
            border-color: transparent;
            opacity: 0.6;
            cursor: not-allowed;
        }

        .pagination .page-item.prev .page-link,
        .pagination .page-item.next .page-link {
            font-weight: 600;
        }

        /* ==================== EMPTY STATE ==================== */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--sage);
            margin-bottom: 1rem;
        }

        .empty-state h4 {
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }

        /* ==================== RESULTS INFO ==================== */
        .results-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .filter-badges span {
            display: inline-block;
            background: rgba(139, 111, 71, 0.1);
            color: var(--brown);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-right: 0.5rem;
        }

        /* ==================== MOBILE RESPONSIVE ==================== */
        @media (max-width: 768px) {
            .page-title h1 {
                font-size: 2rem;
            }

            .filter-section {
                padding: 1.5rem;
            }

            .menu-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 1rem;
            }

            .menu-card {
                border-radius: 10px;
            }

            .menu-content {
                padding: 0.75rem;
            }

            .menu-name {
                font-size: 1rem;
            }

            .menu-price {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="breadcrumb-nav">
                <a href="/">Beranda</a>
                <span>›</span>
                <a href="{{ route('all-menu.index') }}">Menu</a>
            </div>
            <h1>🥐 Katalog Menu</h1>
            <p>Temukan semua produk roti dan kue favorit Anda</p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-4">
        <div class="container">
            <div class="filter-section">
                <form method="GET" action="{{ route('all-menu.index') }}" class="row g-3 align-items-end">

                    <!-- Search Input -->
                    <div class="col-md-4">
                        <label for="search" class="form-label fw-bold">Cari Menu</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control search-input" id="search" name="search"
                                placeholder="Cari berdasarkan nama atau deskripsi..." value="{{ $search }}">
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="col-md-2">
                        <label for="kategori" class="form-label fw-bold">Kategori</label>
                        <select class="form-select select-input" id="kategori" name="kategori">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}" {{ $kategori == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort Filter -->
                    <div class="col-md-2">
                        <label for="sort" class="form-label fw-bold">Urutkan</label>
                        <select class="form-select select-input" id="sort" name="sort">
                            <option value="nama" {{ $sortBy == 'nama' ? 'selected' : '' }}>Nama A-Z</option>
                            <option value="harga_asc" {{ $sortBy == 'harga_asc' ? 'selected' : '' }}>Harga Terendah
                            </option>
                            <option value="harga_desc" {{ $sortBy == 'harga_desc' ? 'selected' : '' }}>Harga Tertinggi
                            </option>
                            <option value="terbaru" {{ $sortBy == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="bi bi-funnel me-2"></i>Filter
                        </button>
                        <a href="{{ route('all-menu.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Menu Grid -->
    <section class="py-5">
        <div class="container">
            @if($menus->count() > 0)
                <!-- Results Info -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="text-muted">
                        Menampilkan {{ $menus->firstItem() }}-{{ $menus->lastItem() }} dari {{ $menus->total() }} menu
                    </div>
                    @if($search || $kategori)
                        <div>
                            @if($search)
                                <span class="badge bg-primary me-2">Pencarian: "{{ $search }}"</span>
                            @endif
                            @if($kategori)
                                <span class="badge bg-info">
                                    Kategori: {{ $kategoris->where('id', $kategori)->first()->nama_kategori ?? '' }}
                                </span>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Menu Cards -->
                <div class="menu-grid">
                    @foreach($menus as $menu)
                        <x-menu-card :menu="$menu" :descriptionLimit="100" />
                    @endforeach
                </div>

                <!-- Simple Pagination - Exact Like Image -->
                @if($menus->hasPages())
                    <div class="d-flex justify-content-between align-items-center my-5 px-3"
                        style="max-width: 500px; margin-left: auto; margin-right: auto;">

                        <!-- Left: Page Info -->
                        <div style="color: #6b5b4f; font-size: 0.95rem;">
                            Halaman <strong>{{ $menus->currentPage() }}</strong> dari <strong>{{ $menus->lastPage() }}</strong>
                        </div>

                        <!-- Center: Navigation -->
                        <div class="d-flex align-items-center gap-2">
                            <!-- Previous Button -->
                            @if($menus->onFirstPage())
                                <button class="btn btn-sm" disabled
                                    style="background: transparent; border: none; color: #ccc; cursor: not-allowed;">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                            @else
                                <a href="{{ $menus->previousPageUrl() }}" class="btn btn-sm"
                                    style="background: transparent; border: none; color: var(--brown);">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            @endif

                            <!-- Current Page Badge -->
                            <span class="badge"
                                style="background-color: var(--brown); color: white; font-size: 0.95rem; padding: 0.5rem 0.75rem; border-radius: 8px; min-width: 36px;">
                                {{ $menus->currentPage() }}
                            </span>

                            <!-- Next Button -->
                            @if($menus->hasMorePages())
                                <a href="{{ $menus->nextPageUrl() }}" class="btn btn-sm"
                                    style="background: transparent; border: none; color: var(--brown);">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            @else
                                <button class="btn btn-sm" disabled
                                    style="background: transparent; border: none; color: #ccc; cursor: not-allowed;">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            @endif
                        </div>

                        <!-- Right: Total Items -->
                        <div style="color: #6b5b4f; font-size: 0.95rem;">
                            Total: <strong>{{ $menus->total() }}</strong> menu
                        </div>
                    </div>
                @endif

            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-search text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="mb-3">Menu Tidak Ditemukan</h4>
                    <p class="text-muted mb-4">
                        Tidak ada menu yang sesuai dengan kriteria pencarian Anda.
                        @if($search || $kategori)
                            Silakan coba kata kunci pencarian yang berbeda atau hapus filter.
                        @endif
                    </p>
                    @if($search || $kategori)
                        <a href="{{ route('all-menu.index') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-counterclockwise me-2"></i>Tampilkan Semua Menu
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <!-- Modern Simple Add to Cart Modal -->
    <div class="modal fade" id="addToCartModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 340px;">
            <div class="modal-content"
                style="border-radius: 20px; border: none; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">

                <!-- Clean Header with Image -->
                <div style="background: #faf8f5; padding: 1.5rem; text-align: center; position: relative;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        style="position: absolute; top: 12px; right: 12px; opacity: 0.5;"></button>
                    <img loading="lazy" id="modalMenuImage" src="" alt=""
                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <h5 id="modalMenuName" class="mt-3 mb-1"
                        style="font-weight: 600; color: #3d2914; font-size: 1.1rem;"></h5>
                    <div id="modalMenuPrice" style="color: #8B4513; font-weight: 700; font-size: 1.15rem;"></div>
                </div>

                <!-- Simple Body -->
                <div style="padding: 1.25rem 1.5rem;">
                    <!-- Stock Info -->
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding: 0.75rem; background: #f8f6f4; border-radius: 10px;">
                        <span style="color: #6b5b4f; font-size: 0.85rem;">Stok tersedia</span>
                        <span id="modalStock" style="font-weight: 600; color: #3d2914;"></span>
                    </div>

                    <!-- Quantity Selector -->
                    <form id="addToCartForm">
                        @csrf
                        <div
                            style="display: flex; align-items: center; justify-content: center; gap: 1rem; margin-bottom: 1rem;">
                            <button type="button" onclick="changeQuantityModal(-1)"
                                style="width: 40px; height: 40px; border-radius: 10px; border: 1px solid #e0d8d0; background: white; cursor: pointer; font-size: 1.2rem; color: #8B4513; display: flex; align-items: center; justify-content: center;">−</button>
                            <span id="modalQuantity"
                                style="font-size: 1.5rem; font-weight: 700; color: #3d2914; min-width: 40px; text-align: center;">1</span>
                            <input type="hidden" name="quantity" id="modalQuantityInput" value="1">
                            <button type="button" onclick="changeQuantityModal(1)"
                                style="width: 40px; height: 40px; border-radius: 10px; border: 1px solid #e0d8d0; background: white; cursor: pointer; font-size: 1.2rem; color: #8B4513; display: flex; align-items: center; justify-content: center;">+</button>
                        </div>

                        <!-- Total -->
                        <div style="text-align: center; margin-bottom: 1rem;">
                            <span style="color: #6b5b4f; font-size: 0.8rem;">Total</span>
                            <div id="modalTotal" style="font-size: 1.4rem; font-weight: 700; color: #8B4513;"></div>
                        </div>

                        <!-- Add Button -->
                        <button type="submit"
                            style="width: 100%; padding: 0.875rem; background: linear-gradient(135deg, #8B4513, #5D3A1A); color: white; border: none; border-radius: 12px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;"
                            onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 20px rgba(139,69,19,0.3)';"
                            onmouseout="this.style.transform='none'; this.style.boxShadow='none';">
                            🛒 Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        // ==================== MODAL FUNCTIONS ====================
        // Show add to cart modal with menu details
        function showAddToCartModal(menuId, menuName, menuPrice, maxStock, menuImage) {
            @auth
                                    const modal = new bootstrap.Modal(document.getElementById('addToCartModal'));

                // Set modal content
                document.getElementById('modalMenuImage').src = menuImage;
                document.getElementById('modalMenuName').textContent = menuName;
                document.getElementById('modalMenuPrice').textContent = 'Rp ' + parseInt(menuPrice).toLocaleString('id-ID');
                document.getElementById('modalStock').textContent = maxStock;
                document.getElementById('modalQuantity').textContent = '1';
                document.getElementById('modalQuantityInput').value = 1;
                updateModalTotal();

                // Set form action
                const form = document.getElementById('addToCartForm');
                form.action = '{{ route("cart.add", ":menuId") }}'.replace(':menuId', menuId);

                modal.show();
            @endauth

            @guest
                window.location.href = '{{ route("user.login.form") }}';
            @endguest
        }

        // Function to change modal quantity
        function changeQuantityModal(change) {
            const quantitySpan = document.getElementById('modalQuantity');
            const quantityInput = document.getElementById('modalQuantityInput');
            const currentValue = parseInt(quantitySpan.textContent) || 1;
            const maxStock = parseInt(document.getElementById('modalStock').textContent.replace(/\D/g, '')) || 999;
            const newValue = currentValue + change;

            if (newValue >= 1 && newValue <= maxStock) {
                quantitySpan.textContent = newValue;
                quantityInput.value = newValue;
                updateModalTotal();
            }
        }

        // Function to update modal total
        function updateModalTotal() {
            const quantity = parseInt(document.getElementById('modalQuantity').textContent) || 1;
            const priceText = document.getElementById('modalMenuPrice').textContent;
            const priceMatch = priceText.match(/[\d.,]+/);
            if (priceMatch) {
                const price = parseInt(priceMatch[0].replace(/[.,]/g, ''));
                const total = quantity * price;
                document.getElementById('modalTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
            }
        }

        // Function to add item to cart
        async function addToCart(menuId) {
            const quantity = parseInt(document.getElementById('modalQuantityInput').value);

            const form = document.getElementById('addToCartForm');
            const formData = new FormData(form);
            formData.set('quantity', quantity);

            // Disable button and show loading
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spin me-2"></i>Menambahkan...';
            submitBtn.disabled = true;

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addToCartModal'));
                    if (modal) modal.hide();

                    // Show success message
                    showToast('✅ Item berhasil ditambahkan ke keranjang!', 'success');

                    // Optional: Update cart count in navbar
                    updateCartCount(quantity);

                    // Reload page after 1.5 seconds
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showToast('❌ ' + (data.message || 'Terjadi kesalahan'), 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('❌ Terjadi kesalahan saat menambahkan ke keranjang', 'error');
            } finally {
                // Re-enable button
                setTimeout(() => {
                    if (submitBtn) {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                }, 1000);
            }
        }

        // Function to update cart count (if navbar has cart counter)
        function updateCartCount(quantity) {
            const cartCountElement = document.getElementById('cart-count');
            if (cartCountElement) {
                const currentCount = parseInt(cartCountElement.textContent) || 0;
                cartCountElement.textContent = currentCount + quantity;
            }
        }

        // Function to show toast notifications
        function showToast(message, type = 'info') {
            // Remove any existing toasts
            const existingToasts = document.querySelectorAll('.toast');
            existingToasts.forEach(toast => {
                toast.remove();
            });

            const toastHTML = `
                <div class="toast align-items-center text-white border-0 position-fixed top-50 start-50 translate-middle show" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 9999; min-width: 300px; box-shadow: 0 4px 20px rgba(0,0,0,0.3); background: ${type === 'success' ? '#198754' : '#dc3545'} !important;">
                    <div class="d-flex p-3">
                        <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-3 fs-4"></i>
                        <div class="toast-body fw-bold">${message}</div>
                        <button type="button" class="btn-close btn-close-white ms-3" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', toastHTML);

            const toastElement = document.querySelector('.toast:last-child');
            toastElement.style.display = 'block';

            // Auto-hide after 3 seconds
            setTimeout(() => {
                if (toastElement) {
                    toastElement.style.opacity = '0';
                    setTimeout(() => toastElement.remove(), 300);
                }
            }, 3000);
        }

        // Manual form submission for filters (no auto-submit)
        document.addEventListener('DOMContentLoaded', function () {
            // Add loading state when filter form submits
            const filterForm = document.querySelector('.filter-section form');
            if (filterForm) {
                filterForm.addEventListener('submit', function (e) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spin me-2"></i>Mencari...';
                        submitBtn.disabled = true;
                    }
                });
            }

            // Handle add to cart form submission
            const addToCartForm = document.getElementById('addToCartForm');
            if (addToCartForm) {
                addToCartForm.onsubmit = function (e) {
                    e.preventDefault();
                    const menuId = this.action.split('/').pop();
                    addToCart(menuId);
                };
            }
        });
    </script>
</body>

</html>