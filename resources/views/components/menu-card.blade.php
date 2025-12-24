@props([
    'menu',
    'showStock' => true,
    'descriptionLimit' => 100
])

@php
    $hasStock = $menu->stok > 0;
    $imageUrl = $menu->gambar_menu 
        ? asset('storage/uploads/menu/' . $menu->gambar_menu) 
        : 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=600';
    
    // WhatsApp message for out-of-stock items
    $waMessage = "Halo, saya ingin memesan menu: {$menu->nama_menu}. Mohon konfirmasi ketersediaan.";
    $waUrl = "https://wa.me/6283112116135?text=" . urlencode($waMessage);
@endphp

<div class="menu-card" 
    @if($hasStock && auth()->check())
        onclick="showAddToCartModal('{{ $menu->id }}', '{{ addslashes($menu->nama_menu) }}', '{{ $menu->harga }}', '{{ $menu->stok }}', '{{ $imageUrl }}')"
    @endif
>
    {{-- Menu Image --}}
    <div class="menu-image-container">
        <img loading="lazy" src="{{ $imageUrl }}" alt="{{ $menu->nama_menu }}" class="menu-image">
    </div>

    {{-- Menu Content --}}
    <div class="menu-content">
        {{-- Menu Name --}}
        <h3 class="menu-name">{{ $menu->nama_menu }}</h3>

        {{-- Description --}}
        <p class="menu-description">{{ Str::limit($menu->deskripsi_menu, $descriptionLimit) }}</p>

        {{-- Price --}}
        <div class="menu-price">
            @if($hasStock)
                Rp {{ number_format($menu->harga, 0, ',', '.') }}
            @else
                <span>Stok Kosong</span>
            @endif
        </div>

        {{-- Actions --}}
        <div class="menu-actions">
            @if($hasStock)
                @auth
                    @if($showStock)
                        <div class="stock-info">Tersedia {{ $menu->stok }}</div>
                    @endif
                @endauth
            @else
                {{-- WhatsApp button for out-of-stock --}}
                <a href="{{ $waUrl }}" target="_blank" class="btn-order-wa" onclick="event.stopPropagation();">
                    <i class="bi bi-whatsapp me-1"></i>Pesan via WhatsApp
                </a>
                <div class="stock-info">Stok habis</div>
            @endif
        </div>
    </div>
</div>




