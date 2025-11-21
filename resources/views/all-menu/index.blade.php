<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Semua Menu | Wijaya Bakery</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
            font-family: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--cream);
            color: var(--text-primary);
            line-height: 1.6;
            padding-top: 80px !important; /* Extra space for fixed navbar */
        }

        /* Page Title */
        .page-title {
            background: linear-gradient(135deg, var(--warm-white), var(--cream));
            padding: 4rem 0 3rem;
            text-align: center;
            border-bottom: 1px solid var(--sage);
            margin-top: 70px; /* Extra space for fixed navbar */
        }

        .page-title h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .page-title p {
            font-size: 1.2rem;
            color: var(--text-secondary);
            margin-bottom: 0;
        }

        /* Filter Section */
        .filter-section {
            background: var(--warm-white);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 600;
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

        /* Menu Grid */
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

        /* Pagination */
        .pagination {
            margin-top: 3rem;
            justify-content: center;
        }

        .pagination .page-link {
            color: var(--brown);
            border-color: rgba(139, 111, 71, 0.3);
            padding: 0.75rem 1rem;
            border-radius: 6px !important;
            margin: 0 0.125rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .pagination .page-link:hover {
            color: var(--dark-brown);
            background-color: var(--sage);
            border-color: var(--sage);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--brown);
            border-color: var(--brown);
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            color: var(--text-secondary);
            background-color: transparent;
            border-color: transparent;
        }

        /* Hide previous and next buttons
        .pagination .page-item:first-child,
        .pagination .page-item:last-child {
            display: none;
        } */

        /* Empty State */
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

        /* Results Info */
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

        /* Mobile */
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
    <section class="py-5" style="background: linear-gradient(135deg, var(--warm-white), var(--cream));">
        <div class="container">
            <h1 class="section-title" style="margin-bottom: 0.5rem;">Semua Menu</h1>
            <p class="section-subtitle">Temukan semua produk roti dan kue favorit Anda</p>
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
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control search-input" id="search" name="search"
                                   placeholder="Cari berdasarkan nama atau deskripsi..."
                                   value="{{ $search }}">
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
                            <option value="harga_asc" {{ $sortBy == 'harga_asc' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="harga_desc" {{ $sortBy == 'harga_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                            <option value="terbaru" {{ $sortBy == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="fas fa-filter me-2"></i>Filter
                        </button>
                        <a href="{{ route('all-menu.index') }}" class="btn btn-secondary">
                            <i class="fas fa-undo me-2"></i>Reset
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
                        <div class="menu-card"
                             @if($menu->stok > 0 && auth()->check())
                                 onclick="showAddToCartModal('{{ $menu->id }}', '{{ $menu->nama_menu }}', '{{ $menu->harga }}', '{{ $menu->stok }}')"
                             @endif>

                            <div class="menu-image-container">
                                <img src="{{ $menu->gambar_menu ? asset('uploads/menu/' . $menu->gambar_menu) : 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=600' }}"
                                     alt="{{ $menu->nama_menu }}" class="menu-image">
                            </div>

                            <div class="menu-content">
                                <h3 class="menu-name">
                                    {{ $menu->nama_menu }}
                                    @php
                                        $bestPromo = $menu->getBestPromotion(1);
                                    @endphp
                                    @if($bestPromo)
                                        @php
                                            $promoDisplay = $menu->getPromotionDisplay(1);
                                        @endphp
                                        <span class="badge bg-danger ms-1" style="font-size: 0.7em;">
                                            <i class="fas fa-percentage me-1"></i>
                                            @if($bestPromo->discount_type == 'percentage' && $promoDisplay)
                                              {{ $promoDisplay['discount_text'] }}
                                            @elseif($bestPromo->discount_type == 'fixed' && $promoDisplay)
                                              {{ $promoDisplay['discount_text'] }}
                                            @else
                                              Promo!
                                            @endif
                                        </span>
                                    @endif
                                </h3>

                                <p class="menu-description">{{ Str::limit($menu->deskripsi_menu, 100) }}</p>

                                <div class="menu-category">
                                    <i class="fas fa-tag me-1"></i>{{ $menu->kategori->nama_kategori }}
                                </div>

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

                                @if($menu->stok > 0)
                                    @auth
                                        <div class="stock-info">Tersedia {{ $menu->stok }}</div>
                                    @else
                                        <div class="text-center mt-2">
                                            <small class="text-muted">Login untuk pesan</small>
                                        </div>
                                    @endauth
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
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $menus->appends(request()->query())->links() }}
                </div>

            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-search text-muted" style="font-size: 4rem;"></i>
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
                            <i class="fas fa-undo me-2"></i>Tampilkan Semua Menu
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <!-- Add to Cart Modal -->
    <div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 320px; position: absolute; top: 50%; left: 20%; transform: translateY(-50%); margin: 0;">
            <div class="modal-content" style="border-radius: 32px; border: none; height: auto; min-height: 480px;">
                <div class="modal-body text-center p-5 d-flex flex-column" style="background: linear-gradient(135deg, #8b6f47, #d4b896); color: white; height: 100%; border-radius: 32px;">
                    <!-- Minimalist Image Container -->
                    <div class="mb-4 flex-shrink-0">
                        <img id="modalMenuImage" src="" alt="" class="rounded-circle mx-auto d-block" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid rgba(255,255,255,0.9); box-shadow: 0 4px 16px rgba(0,0,0,0.1);">
                    </div>

                    <!-- Item Details -->
                    <div class="mb-4 flex-grow-1">
                        <h6 id="modalMenuName" class="fw-bold mb-3" style="font-size: 1.4rem; line-height: 1.3;"></h6>
                        <div class="mb-3">
                            <div class="text-white-50 small mb-1">Harga Satuan</div>
                            <div id="modalMenuPrice" class="fw-semibold" style="font-size: 1.1rem;"></div>
                        </div>
                        <div class="mb-4">
                            <div class="text-white-50 small mb-1">Stok Tersedia</div>
                            <div id="modalStock" class="badge bg-white bg-opacity-25 text-white py-2 px-3 rounded-pill" style="font-size: 0.9rem;"></div>
                        </div>
                    </div>

                    <!-- Quantity Controls -->
                    <form id="addToCartForm" class="flex-shrink-0 w-100">
                        @csrf
                        <div class="d-flex align-items-center justify-content-between mb-4 px-3">
                            <button type="button" class="btn btn-light rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border: none;" onclick="changeQuantityModal(-1)">
                                <i class="bi bi-dash fs-5"></i>
                            </button>

                            <div class="flex-grow-1 mx-3">
                                <div class="bg-white bg-opacity-25 rounded-pill d-flex align-items-center justify-content-center py-2 px-4">
                                    <span class="text-white fw-semibold fs-5" id="modalQuantity">1</span>
                                    <input type="hidden" name="quantity" id="modalQuantityInput" value="1" min="1">
                                </div>
                            </div>

                            <button type="button" class="btn btn-light rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border: none;" onclick="changeQuantityModal(1)">
                                <i class="bi bi-plus fs-5"></i>
                            </button>
                        </div>

                        <!-- Total and Add Button -->
                        <div class="mb-4">
                            <div class="text-white-50 small mb-1">Total Pembayaran</div>
                            <div id="modalTotal" class="fw-bold" style="font-size: 1.3rem;"></div>
                        </div>

                        <button type="submit" class="btn btn-outline-light w-100 py-3 rounded-pill" style="border-color: white; border-width: 2px; color: white; font-weight: 600; font-size: 1rem;">
                            <i class="bi bi-cart-plus-fill me-2"></i>Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        // Function to show add to cart modal
        function showAddToCartModal(menuId, menuName, menuPrice, maxStock) {
            // Check if user is logged in
            @auth
                const modal = new bootstrap.Modal(document.getElementById('addToCartModal'));

                // Find menu image
                const menuCards = document.querySelectorAll('.menu-card');
                let menuImage = 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=600';
                for (let card of menuCards) {
                    const cardName = card.querySelector('.menu-name')?.textContent;
                    if (cardName && cardName.includes(menuName)) {
                        const img = card.querySelector('.menu-image');
                        if (img && img.src) {
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
                document.getElementById('modalQuantity').textContent = '1';
                document.getElementById('modalQuantityInput').value = 1;
                updateModalTotal();

                // Set up form submission
                const form = document.getElementById('addToCartForm');
                form.action = '{{ route("cart.add", ":menuId") }}'.replace(':menuId', menuId);

                modal.show();
            @endauth

            @guest
                // Redirect to login if not authenticated
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
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menambahkan...';
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
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading state when filter form submits
            const filterForm = document.querySelector('.filter-section form');
            if (filterForm) {
                filterForm.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mencari...';
                        submitBtn.disabled = true;
                    }
                });
            }

            // Handle add to cart form submission
            const addToCartForm = document.getElementById('addToCartForm');
            if (addToCartForm) {
                addToCartForm.onsubmit = function(e) {
                    e.preventDefault();
                    const menuId = this.action.split('/').pop();
                    addToCart(menuId);
                };
            }
        });
    </script>
</body>
</html>
