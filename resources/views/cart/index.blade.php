<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang Belanja | Wijaya Bakery</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --brown: #8b5e3c;
            --light-brown: #d4b896;
        }
        body {
            background-color: #faf8f5;
        }
        .cart-card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .navbar-custom {
            background-color: var(--brown);
        }
        .btn-brown {
            background-color: var(--brown);
            border-color: var(--brown);
            color: white;
        }
        .btn-brown:hover {
            background-color: #6f4d32;
            border-color: #6f4d32;
            color: white;
        }
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
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
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-light position-relative">
                                <i class="bi bi-cart"></i>
                                @if(Auth::user()->cartCount() > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ Auth::user()->cartCount() }}
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
                        <li class="nav-item"><a class="btn btn-light" href="{{ route('user.register.form') }}">Daftar</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

            <div class="row">
                <div class="col-12">
                    <h1 class="text-center mb-4" style="color: #8b5e3c;">Keranjang Belanja</h1>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($carts->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-cart-x" style="font-size: 4rem; color: #d4b896;"></i>
                            <h3 class="mt-3" style="color: #8b5e3c;">Keranjang Kosong</h3>
                            <p class="text-muted">Belum ada item di keranjang Anda.</p>
                            <a href="/" class="btn btn-primary" style="background-color: #8b5e3c; border-color: #8b5e3c;">Mulai Belanja</a>
                        </div>
                    @else
                        <div class="row">
                            <!-- Cart Items -->
                            <div class="col-lg-8">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header" style="background-color: #8b5e3c; color: white;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Item Keranjang ({{ $carts->sum('quantity') }} item)</h5>
                                            @if($carts->count() > 1)
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                                        <label for="selectAll" class="text-white mb-0 small">Pilih Semua</label>
                                                    </div>
                                                    <button type="button" class="btn btn-outline-light btn-sm" id="deleteSelectedBtn" disabled style="border-color: #dc3545; color: #dc3545;">
                                                        <i class="bi bi-trash me-1"></i>Hapus Terpilih
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @php
                                            $activeDiscounts = \App\Models\Promo::activeDiscounts()->with('menu')->get();
                                        @endphp
                                        @foreach($carts as $cart)
                                        @php
                                            // Calculate discount for this cart item
                                            $itemDiscount = 0;
                                            $applicablePromo = null;
                                            foreach ($activeDiscounts as $discount) {
                                                if ($discount->isApplicable($cart->menu->id, $cart->quantity)) {
                                                    $itemDiscount = $discount->calculateDiscount($cart->menu->harga, $cart->quantity, $cart->menu->id);
                                                    $applicablePromo = $discount;
                                                    break;
                                                }
                                            }
                                            $finalItemPrice = ($cart->quantity * $cart->menu->harga) - $itemDiscount;
                                            $hasDiscount = $itemDiscount > 0;
                                        @endphp
                                        <div class="row align-items-center mb-3 pb-3 border-bottom {{ $hasDiscount ? 'border-warning bg-light' : '' }} cart-item" data-cart-id="{{ $cart->id }}">
                                            <div class="col-auto pe-3">
                                                <input type="checkbox" class="form-check-input cart-checkbox" value="{{ $cart->id }}" style="margin-top: 0.25rem;">
                                            </div>
                                            <div class="col-md-2">
                                                <img src="{{ $cart->menu->gambar_menu ? asset('uploads/menu/' . $cart->menu->gambar_menu) : asset('images/default-menu.png') }}"
                                                     alt="{{ $cart->menu->nama_menu }}"
                                                     class="img-fluid rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="mb-1 {{ $hasDiscount ? 'text-success' : '' }}">
                                                    {{ $cart->menu->nama_menu }}
                                                    @if($hasDiscount)
                                                        <span class="badge bg-danger ms-1">
                                                            <i class="fas fa-percentage me-1"></i>
                                                            @if($applicablePromo->discount_type == 'percentage')
                                                                {{ $applicablePromo->discount_value }}%
                                                            @else
                                                                Rp {{ number_format($applicablePromo->discount_value, 0, ',', '.') }}
                                                            @endif
                                                        </span>
                                                    @endif
                                                </h6>
                                                <small class="text-muted">{{ Str::limit($cart->menu->deskripsi_menu, 50) }}</small>
                                                <div class="row mt-1">
                                                    <div class="col-6">
                                                        <small class="text-muted">Harga:</small>
                                                        <p class="mb-0 text-primary"><s>Rp {{ number_format($cart->menu->harga, 0, ',', '.') }}</s></p>
                                                    </div>
                                                    @if($hasDiscount)
                                                        <div class="col-6">
                                                            <small class="text-muted">Harga Diskon:</small>
                                                            <p class="mb-0 text-success"><strong>Rp {{ number_format($cart->menu->harga - ($applicablePromo->discount_type == 'percentage' ? $cart->menu->harga * $applicablePromo->discount_value / 100 : min($applicablePromo->discount_value / $cart->quantity, $cart->menu->harga)), 0, ',', '.') }}</strong></p>
                                                        </div>
                                                    @endif
                                                </div>
                                                @if($hasDiscount)
                                                    <div class="mt-1">
                                                        <small class="text-success">
                                                            <i class="fas fa-tag me-1"></i>{{ $applicablePromo->nama_promo }} - {{ $applicablePromo->getDiscountDescription() }}
                                                        </small>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <form method="POST" action="{{ route('cart.update', $cart->id) }}" class="d-flex align-items-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="input-group input-group-sm">
                                                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(this, -1)">-</button>
                                                        <input type="number" class="form-control text-center" name="quantity"
                                                               value="{{ $cart->quantity }}" min="1" max="{{ $cart->menu->stok }}"
                                                               onchange="this.form.submit()">
                                                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(this, 1)">+</button>
                                                    </div>
                                                </form>
                                                <small class="text-muted">Stok: {{ $cart->menu->stok }}</small>
                                            </div>
                                            <div class="col-md-2">
                                                @if($hasDiscount)
                                                    <div class="text-end">
                                                        <small class="text-muted">
                                                            <del>Rp {{ number_format($cart->quantity * $cart->menu->harga, 0, ',', '.') }}</del>
                                                        </small>
                                                        <br>
                                                        <strong class="text-success">Rp {{ number_format($finalItemPrice, 0, ',', '.') }}</strong>
                                                        <br>
                                                        <small class="text-success">
                                                            <i class="fas fa-arrow-down me-1"></i>Hemat Rp {{ number_format($itemDiscount, 0, ',', '.') }}
                                                        </small>
                                                    </div>
                                                @else
                                                    <strong>Rp {{ number_format($cart->quantity * $cart->menu->harga, 0, ',', '.') }}</strong>
                                                @endif
                                            </div>
                                            <div class="col-md-1">
                                                <form method="POST" action="{{ route('cart.remove', $cart->id) }}" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Cart Summary -->
                            <div class="col-lg-4">
                                <div class="card shadow-sm sticky-top" style="top: 20px;">
                                    <div class="card-header" style="background-color: #8b5e3c; color: white;">
                                        <h5 class="mb-0">Ringkasan Pembelian</h5>
                                    </div>
                                    <div class="card-body">
                                        @php
                                            $subtotal = $carts->sum(function($cart) {
                                                return $cart->quantity * $cart->menu->harga;
                                            });

                                            // Calculate discounts
                                            $activeDiscounts = \App\Models\Promo::activeDiscounts()->with('menu')->get();
                                            $totalDiscount = 0;
                                            $appliedDiscounts = [];

                                            foreach($carts as $cart) {
                                                $itemPrice = $cart->quantity * $cart->menu->harga;
                                                $itemDiscount = 0;

                                                foreach ($activeDiscounts as $discount) {
                                                    if ($discount->isApplicable($cart->menu->id, $cart->quantity)) {
                                                        $itemDiscount = $discount->calculateDiscount($cart->menu->harga, $cart->quantity, $cart->menu->id);
                                                        if ($itemDiscount > 0) {
                                                            $appliedDiscounts[] = [
                                                                'menu' => $cart->menu->nama_menu,
                                                                'description' => $discount->getDiscountDescription(),
                                                                'amount' => $itemDiscount
                                                            ];
                                                            break;
                                                        }
                                                    }
                                                }

                                                $totalDiscount += $itemDiscount;
                                            }

                                            $finalTotal = $subtotal - $totalDiscount;
                                        @endphp

                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Subtotal (sebelum diskon):</span>
                                            <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                                        </div>

                                        @if($totalDiscount > 0)
                                            <div class="d-flex justify-content-between mb-2 text-danger">
                                                <span>Potongan Diskon:</span>
                                                <strong>- Rp {{ number_format($totalDiscount, 0, ',', '.') }}</strong>
                                            </div>

                                            <div class="alert alert-info alert-dismissible fade show p-2 mb-1" style="font-size: 0.85rem; background-color: rgba(0,123,255,0.1); border: 1px solid rgba(0,123,255,0.2); color: #0056b3;">
                                                <i class="bi bi-lightbulb-fill me-1"></i>
                                                <strong>Anda mendapatkan diskon! </strong>
                                                Detail diskon per item dapat dilihat di bawah ini.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size: 0.7rem;"></button>
                                            </div>
                                        @endif

                                        @if($totalDiscount > 0)
                                            <div class="mb-3">
                                                <h6 class="text-muted mb-2">Detail Diskon per Item:</h6>
                                                <div class="border rounded p-2" style="background-color: #f8f9fa;">
                                                    @foreach($carts as $cart)
                                                        @php
                                                            $itemDiscount = 0;
                                                            foreach ($activeDiscounts as $discount) {
                                                                if ($discount->isApplicable($cart->menu->id, $cart->quantity)) {
                                                                    $itemDiscount = $discount->calculateDiscount($cart->menu->harga, $cart->quantity);
                                                                    break;
                                                                }
                                                            }
                                                        @endphp
                                                        @if($itemDiscount > 0)
                                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                                <small class="text-muted">{{ $cart->menu->nama_menu }} ({{ $cart->quantity }}x)</small>
                                                                <small class="text-success"><i class="fas fa-arrow-down me-1"></i>-Rp {{ number_format($itemDiscount, 0, ',', '.') }}</small>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>Diskon sudah termasuk dalam total pembayaran
                                                </small>
                                            </div>
                                        @endif

                                        <hr class="border-primary">

                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="h5 mb-0" style="color: #8b5e3c;"><strong>Total Pembayaran:</strong></span>
                                            <strong class="h5 mb-0" style="color: #8b5e3c;">Rp {{ number_format($finalTotal, 0, ',', '.') }}</strong>
                                        </div>

                                        @if($totalDiscount > 0)
                                            <div class="alert alert-success py-2 mb-3" style="font-size: 0.9rem;">
                                                <i class="bi bi-check-circle-fill me-2"></i>
                                                <strong>Anda hemat: Rp {{ number_format($totalDiscount, 0, ',', '.') }}!</strong>
                                            </div>
                                        @endif

                                        @if(!empty($appliedDiscounts))
                                            <div class="alert alert-success alert-dismissible">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                <h6><i class="bi bi-percent me-2"></i>Diskon yang Berlaku:</h6>
                                                @foreach($appliedDiscounts as $discount)
                                                    <div class="mb-1">
                                                        <small class="text-success">
                                                            <i class="bi bi-check-circle-fill me-1"></i>
                                                            <strong>{{ $discount['menu'] }}:</strong> {{ $discount['description'] }}
                                                        </small>
                                                    </div>
                                                @endforeach
                                                <hr class="my-2">
                                                <small><strong>Anda hemat: Rp {{ number_format($totalDiscount, 0, ',', '.') }}</strong></small>
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('cart.checkout') }}">
                                            @csrf
                                            <input type="hidden" id="selectedItems" name="selected_items">

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">
                                                    <i class="bi bi-chat-dots me-2"></i>Catatan untuk Pembeli (Opsional)
                                                </label>
                                                <textarea name="catatan_pesanan" class="form-control" rows="3"
                                                          placeholder="Contoh: Mohon dikemas rapi, ada potongan khusus orang tua, dll.&#10;&#10;Saya ingin pesanan diantar ke alamat:&#10;- Prov. Jawa Timur&#10;- Kab. Malang&#10;- Jl. Sudirman No. 123&#10;- Dusun Krasakan&#10;&#10;Patokan: rumah warna hijau dekat tok ABC"
                                                          maxlength="500"></textarea>
                                                <small class="text-muted">
                                                    <i class="bi bi-info-circle me-1"></i>
                                                    Tuliskan pesan khusus atau alamat pengiriman alternatif. Alamat akan otomatis disertakan dari profil Anda.
                                                </small>
                                            </div>

                                            <button type="submit" id="checkoutBtn" class="btn btn-success w-100 mb-2">
                                                <i class="bi bi-check-circle me-2"></i>Checkout & Pesan
                                                <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                                            </button>
                                        </form>

                                        <small class="text-muted">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Pesanan akan dikirim ke WhatsApp untuk konfirmasi
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize checkboxes on page load (default select first item)
    const checkboxes = document.querySelectorAll('.cart-checkbox');
    if (checkboxes.length > 0) {
        checkboxes[0].checked = true; // Select first item by default
        updateSummary();
    }

    // Handle "Select All" checkbox
    const selectAllCheckbox = document.getElementById('selectAll');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.cart-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSummary();
        });
    }

    // Handle individual checkboxes
    document.querySelectorAll('.cart-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const selectAll = document.getElementById('selectAll');
            if (selectAll) {
                const allChecked = document.querySelectorAll('.cart-checkbox:checked').length === document.querySelectorAll('.cart-checkbox').length;
                const someChecked = document.querySelectorAll('.cart-checkbox:checked').length > 0;

                selectAll.checked = allChecked;
                selectAll.indeterminate = someChecked && !allChecked;
            }
            updateSummary();
            if (typeof updateDeleteButton === 'function') {
                updateDeleteButton();
            }
        });
    });

    // Update summary based on selected items
    function updateSummary() {
        const selectedItems = Array.from(document.querySelectorAll('.cart-checkbox:checked')).map(cb => cb.value);
        document.getElementById('selectedItems').value = selectedItems.join(',');

        // Update button text
        const checkoutBtn = document.getElementById('checkoutBtn');
        if (selectedItems.length === 0) {
            checkoutBtn.disabled = true;
            checkoutBtn.innerHTML = '<i class="bi bi-cart-x me-2"></i>Pilih Item Terlebih Dahulu';
        } else {
            checkoutBtn.disabled = false;
            checkoutBtn.innerHTML = `<i class="bi bi-check-circle me-2"></i>Checkout ${selectedItems.length} Item`;
        }
    }
});

// Add form submission handler for checkout
document.addEventListener('DOMContentLoaded', function() {
    const checkoutForm = document.querySelector('form[action*="checkout"]');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            const selectedItems = document.getElementById('selectedItems').value;
            if (!selectedItems) {
                e.preventDefault();
                showNotification('Silakan pilih setidaknya satu item untuk checkout', 'warning');
                return false;
            }

            // Add loading state
            const checkoutBtn = document.getElementById('checkoutBtn');
            const spinner = checkoutBtn.querySelector('.spinner-border');
            const icon = checkoutBtn.querySelector('i');

            checkoutBtn.disabled = true;
            checkoutBtn.innerHTML = 'Memproses Pesanan...';
            if (spinner) spinner.classList.remove('d-none');
        });
    }
});

function changeQuantity(button, change) {
    const input = button.parentNode.querySelector('input[type="number"]');
    const newValue = parseInt(input.value) + change;

    if (newValue >= 1 && newValue <= parseInt(input.max)) {
        input.value = newValue;
        input.form.submit();
    }
}

// Simple notification popup for adding to cart
function showNotification(message, type = 'success') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification-popup');
    existingNotifications.forEach(notification => notification.remove());

    // Create new notification
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show notification-popup position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);';
    notification.innerHTML = `
        <i class="bi bi-check-circle-fill me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(notification);

    // Auto dismiss after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Update delete button state based on selected items
function updateDeleteButton() {
    const deleteBtn = document.getElementById('deleteSelectedBtn');
    const selectedItems = document.querySelectorAll('.cart-checkbox:checked');

    if (selectedItems.length > 0) {
        deleteBtn.disabled = false;
        deleteBtn.textContent = `Hapus Terpilih (${selectedItems.length})`;
    } else {
        deleteBtn.disabled = true;
        deleteBtn.textContent = 'Hapus Terpilih';
    }
}

// Call updateDeleteButton when page loads
document.addEventListener('DOMContentLoaded', function() {
    updateDeleteButton();
});

// Sequential deletion of selected items
async function deleteSelectedItems() {
    const selectedCheckboxes = document.querySelectorAll('.cart-checkbox:checked');
    const selectedItems = Array.from(selectedCheckboxes).map(cb => cb.value);

    if (selectedItems.length === 0) {
        showNotification('Pilih setidaknya satu item untuk dihapus', 'warning');
        return;
    }

    // Show confirmation dialog
    const confirmed = confirm(`Apakah Anda yakin ingin menghapus ${selectedItems.length} item terpilih?`);
    if (!confirmed) return;

    const deleteBtn = document.getElementById('deleteSelectedBtn');
    const originalText = deleteBtn.textContent;

    // Initialize progress tracking
    let totalItems = selectedItems.length;
    let deletedCount = 0;
    let failedCount = 0;

    // Disable the button and show loading state
    deleteBtn.disabled = true;
    deleteBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Menghapus... (0/' + totalItems + ')';

    try {
        // Process deletions sequentially
        for (let i = 0; i < selectedItems.length; i++) {
            const cartId = selectedItems[i];
            const cartItemElement = document.querySelector(`.cart-item[data-cart-id="${cartId}"]`);

            try {
                // Highlight the item being deleted
                if (cartItemElement) {
                    cartItemElement.style.backgroundColor = '#fff3cd';
                    cartItemElement.style.borderLeft = '4px solid #ffc107';
                }

                // Send delete request
                const response = await fetch(`{{ route('cart.remove', ':cartId') }}`.replace(':cartId', cartId), {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content') })
                });

                if (response.ok) {
                    deletedCount++;

                    // Fade out and remove the element
                    if (cartItemElement) {
                        cartItemElement.style.transition = 'all 0.5s ease';
                        cartItemElement.style.opacity = '0';
                        setTimeout(() => {
                            cartItemElement.remove();

                            // Update UI counters
                            const remainingItems = totalItems - deletedCount - failedCount;
                            deleteBtn.innerHTML = `<i class="bi bi-hourglass-split me-1"></i>Menghapus... (${deletedCount}/${totalItems})`;

                            // Check if all items processed
                            if (deletedCount + failedCount === totalItems) {
                                finishDeletion(deletedCount, failedCount);
                            }
                        }, 500);
                    }
                } else {
                    failedCount++;

                    // Remove highlight from failed item
                    if (cartItemElement) {
                        cartItemElement.style.backgroundColor = '';
                        cartItemElement.style.borderLeft = '';
                    }

                    console.error(`Failed to delete item ${cartId}: ${response.status}`);
                }

            } catch (error) {
                failedCount++;
                console.error(`Error deleting item ${cartId}:`, error);

                // Remove highlight from failed item
                if (cartItemElement) {
                    cartItemElement.style.backgroundColor = '';
                    cartItemElement.style.borderLeft = '';
                }
            }

            // Add small delay between deletions for better UX
            if (i < selectedItems.length - 1) {
                await new Promise(resolve => setTimeout(resolve, 200));
            }
        }

    } catch (error) {
        console.error('Error during batch deletion:', error);
        showNotification('Terjadi kesalahan saat menghapus item', 'error');
        deleteBtn.innerHTML = originalText;
        deleteBtn.disabled = false;
        return;
    }
}

// Finish the deletion process
function finishDeletion(deletedCount, failedCount) {
    const deleteBtn = document.getElementById('deleteSelectedBtn');

    // Update button state
    deleteBtn.innerHTML = '<i class="bi bi-trash me-1"></i>Hapus Terpilih';
    deleteBtn.disabled = true;

    // Update checkboxes and select all
    const selectAllCheckbox = document.getElementById('selectAll');
    if (selectAllCheckbox) {
        selectAllCheckbox.checked = false;
        selectAllCheckbox.indeterminate = false;
    }

    // Update summary and UI
    updateSummary();

    // Show final notification
    if (failedCount === 0) {
        showNotification(`${deletedCount} item berhasil dihapus dari keranjang`, 'success');
    } else if (deletedCount > 0) {
        showNotification(`${deletedCount} item berhasil dihapus, ${failedCount} item gagal dihapus`, 'warning');
    } else {
        showNotification('Gagal menghapus item. Silakan coba lagi', 'error');
    }

    // Refresh page if all items were deleted to update the empty cart state
    const remainingItems = document.querySelectorAll('.cart-item').length;
    if (remainingItems === 0) {
        setTimeout(() => {
            window.location.reload();
        }, 1500);
    }
}

// Attach event listener to delete button
document.addEventListener('DOMContentLoaded', function() {
    const deleteBtn = document.getElementById('deleteSelectedBtn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', deleteSelectedItems);
    }
});

// Make showNotification available globally
window.showNotification = showNotification;
</script>

</body>
</html>
