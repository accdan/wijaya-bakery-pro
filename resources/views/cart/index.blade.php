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
        .btn-brown {
            background-color: var(--brown);
            border-color: var(--brown)
            color: white;
        }
        .btn-brown:hover {
            background-color: #6f4d32;
            border-color: #6f4d32;
            color: white;
        }

        /* Enhanced Mobile Styles for Cart */
        .cart-item-row {
            transition: all 0.2s ease;
        }

        .cart-item-row:hover {
            background-color: rgba(139, 111, 71, 0.02);
        }

        .quantity-input-mobile {
            width: 60px;
            text-align: center;
            border: 2px solid var(--brown);
            border-radius: 6px;
            margin: 0 0.5rem;
        }

        .btn-quantity-mobile {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            border: none;
        }

        .checkout-summary {
            position: sticky;
            top: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            padding: 1.5rem;
        }

        .checkout-btn-mobile {
            min-height: 48px;
            font-size: 1rem;
            font-weight: 600;
        }

        .discount-badge-mobile {
            position: absolute;
            top: 8px;
            left: 8px;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            padding: 0.15rem 0.4rem;
            border-radius: 4px;
            font-size: 0.65rem;
            font-weight: 600;
        }

        /* Better touch targets for mobile */
        @media (max-width: 768px) {
            .btn, .btn-sm, .btn-lg {
                min-height: 44px;
                touch-action: manipulation;
            }

            .form-control, .form-select {
                font-size: 1rem;
                min-height: 44px;
                border-radius: 8px;
            }

            .cart-section-padding {
                padding: 1rem 0;
            }

            .cart-item-mobile {
                border-bottom: 1px solid rgba(139, 111, 71, 0.1);
            }

            .checkout-section-mobile {
                background: var(--light-brown);
                border-radius: 12px 12px 0 0;
                padding: 1.5rem 1rem;
                box-shadow: 0 -4px 16px rgba(0,0,0,0.1);
            }

            .checkout-btn-mobile {
                width: 100%;
                min-height: 50px;
                font-size: 1rem;
                border-radius: 10px;
                background: #25d366;
                border: none;
                color: white;
            }

            .empty-cart-mobile {
                text-align: center;
                padding: 3rem 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('components.navbar')

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
                        <div class="text-center py-5 empty-cart-mobile">
                            <i class="bi bi-cart-x" style="font-size: 4rem; color: #d4b896;"></i>
                            <h3 class="mt-3" style="color: #8b5e3c;">Keranjang Kosong</h3>
                            <p class="text-muted">Belum ada item di keranjang Anda.</p>
                            <a href="/" class="btn btn-primary empty-cart-btn">Mulai Belanja</a>
                        </div>
                    @else
                        <div class="row">
                            <!-- Cart Items -->
                            <div class="col-lg-8">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header" style="background-color: #8b5e3c; color: white;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Item Keranjang ({{ $carts->count() }} item)</h5>
                                            @if($carts->count() > 1)
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                                        <label for="selectAll" class="text-white mb-0 small">Pilih Semua</label>
                                                    </div>
                                                    <button type="button" class="btn btn-outline-light btn-sm" id="deleteSelectedBtn" disabled>
                                                        <i class="bi bi-trash me-1"></i>Hapus Terpilih
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @php
                                            $activeDiscounts = \App\Models\Promo::activeDiscountsToday()->with('menu')->get();
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
                                        <div class="row align-items-center mb-3 pb-3 border-bottom {{ $hasDiscount ? 'border-warning bg-light' : '' }} cart-item cart-item-row" data-cart-id="{{ $cart->id }}">
                                            <div class="col-auto pe-3">
                                                <input type="checkbox" class="form-check-input cart-checkbox" value="{{ $cart->id }}">
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
                                                @if($hasDiscount)
                                                    <div class="mt-1">
                                                        <small class="text-success">
                                                            <i class="fas fa-tag me-1"></i>{{ $applicablePromo->nama_promo }} - Hemat Rp {{ number_format($itemDiscount, 0, ',', '.') }}
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
                                                        <input type="number" name="quantity" class="form-control text-center quantity-input-mobile"
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
                                <div class="card shadow-sm sticky-top checkout-summary">
                                    <div class="card-header" style="background-color: #8b5e3c; color: white;">
                                        <h5 class="mb-0">Ringkasan Pembelian</h5>
                                    </div>
                                    <div class="card-body">
                                        @php
                                            $subtotal = $carts->sum(function($cart) {
                                                return $cart->quantity * $cart->menu->harga;
                                            });

                                            $activeDiscounts = \App\Models\Promo::activeDiscountsToday()->with('menu')->get();
                                            $totalDiscount = 0;

                                            foreach($carts as $cart) {
                                                foreach ($activeDiscounts as $discount) {
                                                    if ($discount->isApplicable($cart->menu->id, $cart->quantity)) {
                                                        $totalDiscount += $discount->calculateDiscount($cart->menu->harga, $cart->quantity, $cart->menu->id);
                                                        break;
                                                    }
                                                }
                                            }

                                            $finalTotal = $subtotal - $totalDiscount;
                                        @endphp

                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Subtotal:</span>
                                            <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                                        </div>

                                        @if($totalDiscount > 0)
                                            <div class="d-flex justify-content-between mb-2 text-danger">
                                                <span>Potongan Diskon:</span>
                                                <strong>- Rp {{ number_format($totalDiscount, 0, ',', '.') }}</strong>
                                            </div>
                                            <hr>
                                            <div class="alert alert-success">
                                                <strong>Anda hemat: Rp {{ number_format($totalDiscount, 0, ',', '.') }}!</strong>
                                            </div>
                                        @endif

                                        <hr class="border-primary">

                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="h5 mb-0" style="color: #8b5e3c;"><strong>Total:</strong></span>
                                            <strong class="h5 mb-0" style="color: #8b5e3c;">Rp {{ number_format($finalTotal, 0, ',', '.') }}</strong>
                                        </div>

                                        <form method="POST" action="{{ route('cart.checkout') }}">
                                            @csrf
                                            <input type="hidden" id="selectedItems" name="selected_items">

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">
                                                    <i class="bi bi-chat-dots me-2"></i>Catatan (Opsional)
                                                </label>
                        <textarea name="catatan_pesanan" class="form-control" rows="3"
                                                          placeholder="Contoh: Mohon dikemas rapi, dll.">{{ $savedOrderNotes }}</textarea>
                                            </div>

                                            <button type="submit" id="checkoutBtn" class="btn btn-success w-100 checkout-btn-mobile">
                                                <i class="bi bi-check-circle me-2"></i>Checkout & Pesan
                                                <span class="spinner-border spinner-border-sm ms-2 d-none"></span>
                                            </button>
                                        </form>

                                        <small class="text-muted mt-2">
                                            <i class="bi bi-whatsapp me-1"></i>
                                            Pesanan akan dikirim ke WhatsApp untuk konfirmasi
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize checkboxes
    const checkboxes = document.querySelectorAll('.cart-checkbox');
    if (checkboxes.length > 0) {
        checkboxes[0].checked = true;
        updateSummary();
    }

    // Handle select all
    const selectAllCheckbox = document.getElementById('selectAll');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.cart-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSummary();
            updateDeleteButton();
        });
    }

    // Handle individual checkboxes
    document.querySelectorAll('.cart-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (selectAllCheckbox) {
                const allChecked = document.querySelectorAll('.cart-checkbox:checked').length === checkboxes.length;
                selectAllCheckbox.checked = allChecked;
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
            checkoutBtn.innerHTML = '<i class="bi bi-cart-x me-2"></i>Pilih Item';
        } else {
            checkoutBtn.disabled = false;
            checkoutBtn.innerHTML = `<i class="bi bi-check-circle me-2"></i>Checkout ${selectedItems.length} Item`;
        }
    }

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

    // Update all quantity forms to include current order notes
    function updateQuantityFormsWithNotes() {
        const orderNotesTextarea = document.querySelector('textarea[name="catatan_pesanan"]');
        const quantityForms = document.querySelectorAll('form[action*="cart.update"]');

        if (orderNotesTextarea && quantityForms.length > 0) {
            const currentNotes = orderNotesTextarea.value;

            quantityForms.forEach(form => {
                // Remove existing hidden input if exists
                const existingInput = form.querySelector('input[name="catatan_pesanan"]');
                if (existingInput) {
                    existingInput.remove();
                }

                // Add current order notes as hidden input
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'catatan_pesanan';
                hiddenInput.value = currentNotes;
                form.appendChild(hiddenInput);
            });
        }
    }

    // Update forms when quantity changes or notes change
    const orderNotesTextarea = document.querySelector('textarea[name="catatan_pesanan"]');
    if (orderNotesTextarea) {
        orderNotesTextarea.addEventListener('input', function() {
            // Add a small delay to avoid too frequent updates
            setTimeout(updateQuantityFormsWithNotes, 100);
        });

        // Initial update
        updateQuantityFormsWithNotes();
    }

    // Form submission handler
    const checkoutForm = document.querySelector('form[action*="checkout"]');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            const selectedItems = document.getElementById('selectedItems').value;
            if (!selectedItems) {
                e.preventDefault();
                alert('Pilih item untuk checkout');
                return false;
            }

            const btn = document.getElementById('checkoutBtn');
            btn.disabled = true;
            btn.innerHTML = 'Memproses...';
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

// Batch delete function
async function deleteSelectedItems() {
    const selectedCheckboxes = document.querySelectorAll('.cart-checkbox:checked');
    const selectedItems = Array.from(selectedCheckboxes).map(cb => cb.value);

    if (selectedItems.length === 0) {
        alert('Pilih item untuk dihapus');
        return;
    }

    if (!confirm(`Hapus ${selectedItems.length} item terpilih?`)) return;

    const deleteBtn = document.getElementById('deleteSelectedBtn');

    try {
        deleteBtn.disabled = true;
        deleteBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Menghapus...';

        for (const cartId of selectedItems) {
            const response = await fetch(`{{ route('cart.remove', ':cartId') }}`.replace(':cartId', cartId), {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                document.querySelector(`[data-cart-id="${cartId}"]`).remove();
            }
        }

        alert(`${selectedItems.length} item berhasil dihapus`);
        location.reload();

    } catch (error) {
        alert('Terjadi kesalahan');
        deleteBtn.disabled = false;
        deleteBtn.innerHTML = '<i class="bi bi-trash me-1"></i>Hapus Terpilih';
    }
}

// Attach delete event
document.addEventListener('DOMContentLoaded', function() {
    const deleteBtn = document.getElementById('deleteSelectedBtn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', deleteSelectedItems);
    }
});
</script>

</body>
</html>
