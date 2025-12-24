<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang Belanja | Wijaya Bakery</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/logo1.png') }}">
    
    <!-- Preconnect -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bakery-cream: #FDF8F3;
            --bakery-brown: #8B4513;
            --bakery-dark-brown: #5D3A1A;
            --bakery-golden: #D4A574;
            --bakery-warm: #F5EBD9;
            --bakery-peach: #FAF3EB;
            --text-primary: #3D2914;
            --text-secondary: #8B7355;
            --shadow-sm: 0 2px 8px rgba(139, 69, 19, 0.08);
            --shadow-md: 0 4px 16px rgba(139, 69, 19, 0.12);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bakery-cream);
            min-height: 100vh;
            margin: 0;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
            color: var(--text-primary);
        }

        /* Simple Page header with navbar offset */
        .page-header {
            background: var(--bakery-cream);
            padding: 5rem 0 1rem;
            margin-bottom: 1rem;
        }

        .page-header h1 {
            color: var(--bakery-brown);
            font-size: 1.35rem;
            margin: 0;
        }

        .page-header p {
            color: var(--text-secondary);
            margin: 0.5rem 0 0;
            font-size: 0.8rem;
        }

        .breadcrumb-custom {
            display: flex;
            gap: 0.5rem;
            font-size: 0.8rem;
        }

        .breadcrumb-custom a {
            color: var(--text-secondary);
            text-decoration: none;
        }

        .breadcrumb-custom a:hover { color: var(--bakery-brown); }

        .breadcrumb-custom .active {
            color: var(--bakery-brown);
            font-weight: 500;
        }

        /* Cart container */
        .cart-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 1rem 2rem;
        }

        /* Minimalist Cart card */
        .cart-card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .cart-header {
            background: var(--bakery-peach);
            padding: 1rem 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(139, 69, 19, 0.08);
        }

        .cart-header h5 {
            color: var(--bakery-brown);
            margin: 0;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .cart-body { padding: 0; }

        /* Minimalist Cart item */
        .cart-item {
            display: flex;
            align-items: center;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(139, 69, 19, 0.06);
            transition: all 0.2s ease;
            gap: 1rem;
        }

        .cart-item:hover { background: var(--bakery-peach); }
        .cart-item:last-child { border-bottom: none; }

        .item-checkbox {
            width: 18px;
            height: 18px;
            accent-color: var(--bakery-brown);
            cursor: pointer;
        }

        .item-image {
            width: 64px;
            height: 64px;
            border-radius: 10px;
            object-fit: cover;
            background: var(--bakery-warm);
            flex-shrink: 0;
        }

        .item-details { flex: 1; min-width: 0; }

        .item-name {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.15rem;
            font-size: 0.9rem;
        }

        .item-desc {
            font-size: 0.75rem;
            color: var(--text-secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .item-stock {
            font-size: 0.7rem;
            color: #5D8A4D;
            margin-top: 0.15rem;
        }

        /* Compact Quantity control */
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            background: var(--bakery-peach);
            border-radius: 8px;
            padding: 0.25rem;
        }

        .qty-btn {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            border: none;
            background: white;
            color: var(--bakery-brown);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .qty-btn:hover {
            background: var(--bakery-brown);
            color: white;
        }

        .qty-input {
            width: 36px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
        }

        .qty-input:focus { outline: none; }

        /* Compact Item price */
        .item-price {
            text-align: right;
            min-width: 100px;
        }

        .item-price .price {
            font-weight: 700;
            color: var(--bakery-brown);
            font-size: 0.95rem;
        }

        .item-price .unit-price {
            font-size: 0.7rem;
            color: var(--text-secondary);
        }

        /* Minimalist Delete button */
        .btn-delete {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            background: transparent;
            color: #c0a080;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s;
        }

        .btn-delete:hover {
            background: #fee;
            color: #dc3545;
        }

        /* Coklat Summary card */
        .summary-card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 1rem;
            overflow: hidden;
        }

        .summary-header {
            background: linear-gradient(135deg, var(--bakery-brown), var(--bakery-dark-brown));
            color: white;
            padding: 1rem 1.25rem;
        }

        .summary-header h5 {
            color: white;
            margin: 0;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .summary-body { padding: 1.25rem; }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            padding-top: 0.75rem;
            border-top: 1px solid rgba(139, 69, 19, 0.1);
            margin-top: 0.5rem;
        }

        .summary-total span {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--text-primary);
        }

        .summary-total .total-price { color: var(--bakery-brown); }

        /* Compact Notes */
        .notes-section { margin-top: 1rem; }

        .notes-section label {
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 0.375rem;
            display: block;
            font-size: 0.8rem;
        }

        .notes-section textarea {
            width: 100%;
            border: 1px solid rgba(139, 69, 19, 0.15);
            border-radius: 10px;
            padding: 0.625rem;
            resize: none;
            font-family: inherit;
            font-size: 0.8rem;
            transition: border-color 0.2s;
        }

        .notes-section textarea:focus {
            border-color: var(--bakery-golden);
            outline: none;
        }

        /* Bakery Checkout button */
        .btn-checkout {
            width: 100%;
            background: linear-gradient(135deg, var(--bakery-brown), var(--bakery-dark-brown));
            border: none;
            color: white;
            padding: 0.875rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 1rem;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-checkout:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-checkout:disabled {
            background: #ddd;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .wa-note {
            text-align: center;
            margin-top: 0.75rem;
            font-size: 0.7rem;
            color: var(--text-secondary);
        }

        /* Minimalist Empty cart */
        .empty-cart {
            text-align: center;
            padding: 3rem 1.5rem;
        }

        .empty-cart-icon {
            font-size: 3.5rem;
            color: var(--bakery-golden);
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-cart h3 {
            color: var(--text-primary);
            margin-bottom: 0.25rem;
            font-size: 1.25rem;
        }

        .empty-cart p {
            color: var(--text-secondary);
            margin-bottom: 1.25rem;
            font-size: 0.875rem;
        }

        .btn-shop {
            background: linear-gradient(135deg, var(--bakery-brown), var(--bakery-dark-brown));
            color: white;
            padding: 0.625rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.25s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-shop:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        /* Compact Select all bar */
        .select-all-bar {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            background: var(--bakery-cream);
            border-bottom: 1px solid rgba(139, 69, 19, 0.06);
        }

        .select-all-bar label {
            margin: 0;
            font-size: 0.8rem;
            color: var(--text-secondary);
            cursor: pointer;
        }

        .btn-delete-selected {
            background: transparent;
            border: 1px solid rgba(139, 69, 19, 0.15);
            color: var(--text-secondary);
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            margin-left: auto;
            cursor: pointer;
            transition: all 0.15s;
        }

        .btn-delete-selected:hover {
            background: #fee;
            border-color: #dc3545;
            color: #dc3545;
        }

        .btn-delete-selected:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* Smooth animations */
        .cart-item, .qty-btn, .btn-delete, .btn-checkout, .btn-shop {
            transition: all 0.2s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cart-item {
                flex-wrap: wrap;
                gap: 0.75rem;
                padding: 0.875rem 1rem;
            }

            .item-image { width: 56px; height: 56px; }

            .item-details {
                order: 2;
                flex-basis: calc(100% - 80px);
            }

            .quantity-control { order: 3; }
            .item-price { order: 4; min-width: auto; text-align: left; }
            .btn-delete { order: 5; }
            .item-checkbox { order: 1; }

            .summary-card { position: static; margin-top: 1rem; }
        }
    </style>
</head>
<body>
    @include('components.navbar')

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>🛒 Keranjang Belanja</h1>
            <p>Kelola pesanan Anda sebelum checkout</p>
        </div>
    </div>

    <div class="cart-container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($carts->isEmpty())
            <div class="cart-card">
                <div class="empty-cart">
                    <div class="empty-cart-icon">
                        <i class="bi bi-cart-x"></i>
                    </div>
                    <h3>Keranjang Masih Kosong</h3>
                    <p>Belum ada item di keranjang Anda. Yuk, mulai belanja!</p>
                    <a href="/#menu" class="btn-shop">
                        <i class="bi bi-shop"></i>Lihat Menu
                    </a>
                </div>
            </div>
        @else
            <div class="row g-4">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="cart-card">
                        <div class="cart-header">
                            <h5><i class="bi bi-bag me-2"></i>Item Keranjang ({{ $carts->count() }} item)</h5>
                        </div>
                        
                        @if($carts->count() > 1)
                            <div class="select-all-bar">
                                <input type="checkbox" id="selectAll" class="item-checkbox">
                                <label for="selectAll">Pilih Semua</label>
                                <button type="button" class="btn-delete-selected" id="deleteSelectedBtn" disabled>
                                    <i class="bi bi-trash me-1"></i>Hapus Terpilih
                                </button>
                            </div>
                        @endif
                        
                        <div class="cart-body">
                            @foreach($carts as $cart)
                                <div class="cart-item" data-cart-id="{{ $cart->id }}">
                                    <input type="checkbox" class="item-checkbox cart-checkbox" value="{{ $cart->id }}">
                                    
                                    <img loading="lazy" src="{{ $cart->menu->gambar_menu ? asset('storage/uploads/menu/' . $cart->menu->gambar_menu) : asset('storage/images/default-menu.png') }}"
                                         alt="{{ $cart->menu->nama_menu }}" class="item-image">
                                    
                                    <div class="item-details">
                                        <div class="item-name">{{ $cart->menu->nama_menu }}</div>
                                        <div class="item-desc">{{ Str::limit($cart->menu->deskripsi_menu, 60) }}</div>
                                        <div class="item-stock"><i class="bi bi-check-circle me-1"></i>Stok: {{ $cart->menu->stok }}</div>
                                    </div>
                                    
                                    <form method="POST" action="{{ route('cart.update', $cart->id) }}" class="quantity-control">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" class="qty-btn" onclick="changeQuantity(this, -1)">−</button>
                                        <input type="number" name="quantity" class="qty-input"
                                               value="{{ $cart->quantity }}" min="1" max="{{ $cart->menu->stok }}"
                                               onchange="this.form.submit()">
                                        <button type="button" class="qty-btn" onclick="changeQuantity(this, 1)">+</button>
                                    </form>
                                    
                                    <div class="item-price">
                                        <div class="price">Rp {{ number_format($cart->quantity * $cart->menu->harga, 0, ',', '.') }}</div>
                                        <div class="unit-price">@ Rp {{ number_format($cart->menu->harga, 0, ',', '.') }}</div>
                                    </div>
                                    
                                    <form method="POST" action="{{ route('cart.remove', $cart->id) }}"
                                          onsubmit="return confirm('Hapus item ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Summary -->
                <div class="col-lg-4">
                    <div class="summary-card">
                        <div class="summary-header">
                            <h5><i class="bi bi-receipt me-2"></i>Ringkasan</h5>
                        </div>
                        <div class="summary-body">
                            @php
                                $subtotal = $carts->sum(function ($cart) {
                                    return $cart->quantity * $cart->menu->harga;
                                });
                            @endphp

                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="summary-total">
                                <span>Total</span>
                                <span class="total-price">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>

                            <form method="POST" action="{{ route('cart.checkout') }}">
                                @csrf
                                <input type="hidden" id="selectedItems" name="selected_items">
                                
                                <div class="notes-section">
                                    <label><i class="bi bi-chat-text me-1"></i>Catatan Pesanan</label>
                                    <textarea name="catatan_pesanan" rows="3"
                                        placeholder="Contoh: Mohon dikemas rapi, jangan terlalu manis, dll.">{{ $savedOrderNotes }}</textarea>
                                </div>

                                <button type="submit" class="btn-checkout" id="checkoutBtn">
                                    <i class="bi bi-whatsapp"></i>
                                    <span>Checkout via WhatsApp</span>
                                </button>
                            </form>

                            <div class="wa-note">
                                <i class="bi bi-info-circle me-1"></i>
                                Pesanan akan dikirim ke WhatsApp untuk konfirmasi
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.cart-checkbox');
            
            // Auto-select first item
            if (checkboxes.length > 0) {
                checkboxes[0].checked = true;
                updateSummary();
            }

            // Select all functionality
            const selectAllCheckbox = document.getElementById('selectAll');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    checkboxes.forEach(cb => cb.checked = this.checked);
                    updateSummary();
                    updateDeleteButton();
                });
            }

            // Individual checkbox change
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (selectAllCheckbox) {
                        selectAllCheckbox.checked = document.querySelectorAll('.cart-checkbox:checked').length === checkboxes.length;
                    }
                    updateSummary();
                    updateDeleteButton();
                });
            });

            function updateSummary() {
                const selectedItems = Array.from(document.querySelectorAll('.cart-checkbox:checked')).map(cb => cb.value);
                document.getElementById('selectedItems').value = selectedItems.join(',');

                const checkoutBtn = document.getElementById('checkoutBtn');
                if (selectedItems.length === 0) {
                    checkoutBtn.disabled = true;
                    checkoutBtn.innerHTML = '<i class="bi bi-cart-x"></i><span>Pilih Item Dulu</span>';
                } else {
                    checkoutBtn.disabled = false;
                    checkoutBtn.innerHTML = `<i class="bi bi-whatsapp"></i><span>Checkout ${selectedItems.length} Item</span>`;
                }
            }

            function updateDeleteButton() {
                const deleteBtn = document.getElementById('deleteSelectedBtn');
                if (!deleteBtn) return;
                
                const selectedCount = document.querySelectorAll('.cart-checkbox:checked').length;
                deleteBtn.disabled = selectedCount === 0;
                deleteBtn.innerHTML = selectedCount > 0 
                    ? `<i class="bi bi-trash me-1"></i>Hapus (${selectedCount})`
                    : '<i class="bi bi-trash me-1"></i>Hapus Terpilih';
            }

            // Form submission
            const checkoutForm = document.querySelector('form[action*="checkout"]');
            if (checkoutForm) {
                checkoutForm.addEventListener('submit', function(e) {
                    if (!document.getElementById('selectedItems').value) {
                        e.preventDefault();
                        alert('Pilih item untuk checkout');
                        return false;
                    }
                    document.getElementById('checkoutBtn').disabled = true;
                    document.getElementById('checkoutBtn').innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
                });
            }

            updateDeleteButton();
        });

        function changeQuantity(button, change) {
            const input = button.parentNode.querySelector('input[type="number"]');
            const newValue = parseInt(input.value) + change;
            if (newValue >= 1 && newValue <= parseInt(input.max)) {
                input.value = newValue;
                input.form.submit();
            }
        }

        // Batch delete
        document.getElementById('deleteSelectedBtn')?.addEventListener('click', async function() {
            const selectedItems = Array.from(document.querySelectorAll('.cart-checkbox:checked')).map(cb => cb.value);
            if (selectedItems.length === 0 || !confirm(`Hapus ${selectedItems.length} item terpilih?`)) return;

            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Menghapus...';

            try {
                for (const cartId of selectedItems) {
                    await fetch(`{{ route('cart.remove', ':cartId') }}`.replace(':cartId', cartId), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });
                }
                location.reload();
            } catch (error) {
                alert('Terjadi kesalahan');
                this.disabled = false;
                this.innerHTML = '<i class="bi bi-trash me-1"></i>Hapus Terpilih';
            }
        });
    </script>
</body>
</html>



