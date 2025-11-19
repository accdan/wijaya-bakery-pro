<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profil Saya | Wijaya Bakery</title>

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
        .profile-card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
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
                        <li class="nav-item"><a class="btn btn-light" href="{{ route('user.register.form') }}">Daftar</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content with Tabs -->
    <div class="container-fluid py-5" style="background-color: #faf8f5; min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow">
                        <div class="card-header" style="background-color: #8b5e3c; color: white;">
                            <h4 class="mb-0"><i class="bi bi-person-circle me-2"></i>Dashboard Pengguna</h4>
                        </div>
                        <div class="card-body p-0">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                                        <i class="bi bi-person me-2"></i>Profil Saya
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab" aria-controls="address" aria-selected="false">
                                        <i class="bi bi-geo-alt me-2"></i>Alamat Pengiriman
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="cart-tab" data-bs-toggle="tab" data-bs-target="#cart" type="button" role="tab" aria-controls="cart" aria-selected="false">
                                        <i class="bi bi-cart me-2"></i>Keranjang
                                        @if($cartCount > 0)
                                            <span class="badge bg-danger ms-1">{{ $cartCount }}</span>
                                        @endif
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false">
                                        <i class="bi bi-clock-history me-2"></i>Riwayat Pesanan
                                        @if($orders->count() > 0)
                                            <span class="badge bg-info ms-1">{{ $orders->count() }}</span>
                                        @endif
                                    </button>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content p-4" id="profileTabsContent">
                                <!-- Profile Tab -->
                                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show">
                                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif

                                    <h5 class="mb-3">Biodata Pengguna</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Nama Lengkap</label>
                                                <p class="form-control-plaintext">{{ $user->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Username</label>
                                                <p class="form-control-plaintext">{{ $user->username }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Email</label>
                                                <p class="form-control-plaintext">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">No. Telepon</label>
                                                <p class="form-control-plaintext">{{ $user->no_telepon ?: '-' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Tanggal Bergabung</label>
                                        <p class="form-control-plaintext">{{ $user->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>

                                <!-- Address Tab -->
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show">
                                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif

                                    <h5 class="mb-3">Alamat Pengiriman</h5>
                                    <form method="POST" action="{{ route('user.profile.update.address') }}" id="addressForm">
                                        @csrf
                                        @method('PATCH')

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Provinsi</label>
                                                    <select class="form-select" name="province" id="provinceSelect">
                                                        <option value="">Pilih Provinsi</option>
                                                        @php
                                                            $regionService = new \App\Services\IndonesiaRegionService();
                                                            $provinces = $regionService->getProvinces();
                                                        @endphp
                                                        @foreach($provinces as $province)
                                                            <option value="{{ $province['id'] }}" data-name="{{ $province['name'] }}" {{ old('province', $user->province) == $province['name'] ? 'selected' : '' }}>
                                                                {{ $province['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('province')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Kabupaten/Kota</label>
                                                    <select class="form-select" name="regency" id="regencySelect">
                                                        <option value="">Pilih Kabupaten/Kota</option>
                                                    </select>
                                                    @error('regency')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Kecamatan</label>
                                                    <select class="form-select" name="district" id="districtSelect">
                                                        <option value="">Pilih Kecamatan</option>
                                                    </select>
                                                    <input type="hidden" name="street" id="streetHidden">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Kelurahan/Desa</label>
                                                    <select class="form-select" name="hamlet" id="villageSelect">
                                                        <option value="">Pilih Kelurahan/Desa</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Catatan Tambahan (Opsional)</label>
                                            <textarea class="form-control" name="address_notes" rows="3"
                                                      placeholder="Contoh: Patokan rumah warna hijau, dekat Toko ABC, dll.">{{ old('address_notes', $user->address_notes) }}</textarea>
                                            @error('address_notes')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            @if($user->province || $user->regency || $user->street || $user->hamlet)
                                                <div class="alert alert-info">
                                                    <h6><i class="bi bi-geo-alt me-2"></i>Alamat Lengkap:</h6>
                                                    <p class="mb-0">
                                                        {{ $user->province ? 'Prov. ' . $user->province : '' }}
                                                        {{ $user->regency ? ', ' . $user->regency : '' }}
                                                        {{ $user->street ? ', ' . $user->street : '' }}
                                                        {{ $user->hamlet ? ', ' . $user->hamlet : '' }}
                                                        @if($user->address_notes)
                                                            <br><small class="text-muted">{{ $user->address_notes }}</small>
                                                        @endif
                                                    </p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn" style="background-color: #8b5e3c; color: white;">
                                                <i class="bi bi-save me-2"></i>Update Alamat
                                            </button>
                                            <a href="{{ route('user.profile') }}" class="btn btn-secondary">
                                                <i class="bi bi-x me-2"></i>Batal
                                            </a>
                                        </div>
                                    </form>
                                </div>

                                <!-- Cart Tab -->
                                <div class="tab-pane fade" id="cart" role="tabpanel" aria-labelledby="cart-tab">
                                    <h5 class="mb-3">Keranjang Belanja</h5>
                                    @if($cartCount > 0)
                                        <p class="text-muted">Anda memiliki {{ $cartCount }} item di keranjang.</p>
                                        <div class="text-center">
                                            <a href="{{ route('cart.index') }}" class="btn" style="background-color: #8b5e3c; color: white;">
                                                <i class="bi bi-cart me-2"></i>Lihat Keranjang Lengkap
                                            </a>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i>
                                            <p class="text-muted mt-2">Keranjang Anda masih kosong</p>
                                            <a href="/" class="btn btn-primary">Lihat Menu</a>
                                        </div>
                                    @endif
                                </div>

                                <!-- Orders Tab -->
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <h5 class="mb-3">Riwayat Pesanan</h5>
                                    @if($orders->count() > 0)
                                        @foreach($orders as $timestamp => $orderItems)
                                            @php
                                                $firstItem = $orderItems->first();
                                                $orderDate = \Carbon\Carbon::parse($timestamp);
                                                $totalOrderPrice = $orderItems->sum('total_harga');
                                                $totalDiscount = $orderItems->sum(fn($item) => $item->discount_amount ?? 0);
                                                $finalPrice = $orderItems->sum(fn($item) => $item->final_price ?? $item->total_harga);
                                                $hasDiscount = $totalDiscount > 0;
                                            @endphp
                                            <div class="card mb-3 order-card" style="cursor: pointer;" onclick="window.location.href='{{ route('user.order.detail', $timestamp) }}'">
                                                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                                                    <h6 class="mb-0 text-primary">
                                                        <i class="bi bi-calendar me-2"></i>
                                                        Pesanan {{ $orderDate->format('d M Y, H:i') }}
                                                    </h6>
                                                    <div class="d-flex gap-2">
                                                        @if($hasDiscount)
                                                            <span class="badge bg-danger">
                                                                <i class="bi bi-tag-fill me-1"></i>Diskon Applied
                                                            </span>
                                                        @endif
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle me-1"></i>Selesai
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <!-- Order Summary -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-8">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <strong class="me-3">{{ $orderItems->count() }} item{{ $orderItems->count() > 1 ? 's' : '' }}</strong>
                                                                @if($hasDiscount)
                                                                    <small class="text-success">
                                                                        <i class="bi bi-arrow-down-circle me-1"></i>
                                                                        Hemat Rp {{ number_format($totalDiscount, 0, ',', '.') }}
                                                                    </small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 text-end">
                                                            @if($hasDiscount)
                                                                <div class="text-muted small">
                                                                    <s>Rp {{ number_format($totalOrderPrice, 0, ',', '.') }}</s>
                                                                </div>
                                                                <div class="h4 mb-0 text-primary">
                                                                    <strong>Rp {{ number_format($finalPrice, 0, ',', '.') }}</strong>
                                                                </div>
                                                            @else
                                                                <div class="h4 mb-0 text-primary">
                                                                    <strong>Rp {{ number_format($totalOrderPrice, 0, ',', '.') }}</strong>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Order Items Preview -->
                                                    @foreach($orderItems->take(3) as $item)
                                                        <div class="row align-items-center mb-2 pb-2 {{ $loop->last ? '' : 'border-bottom' }} small">
                                                            <div class="col-auto">
                                                                @if($item->menu && $item->menu->gambar_menu)
                                                                    <img src="{{ asset('uploads/menu/' . $item->menu->gambar_menu) }}"
                                                                         alt="{{ $item->menu->nama_menu }}"
                                                                         class="img-fluid rounded" style="width: 35px; height: 35px; object-fit: cover;">
                                                                @else
                                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                                         style="width: 35px; height: 35px;">
                                                                        <i class="bi bi-image text-muted" style="font-size: 10px;"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="col">
                                                                <span class="fw-medium">
                                                                    {{ $item->menu->nama_menu ?? 'Menu tidak ditemukan' }}
                                                                    @if($item->discount_amount && $item->discount_amount > 0)
                                                                        <span class="badge bg-danger ms-1" style="font-size: 8px;">
                                                                            <i class="bi bi-tag-fill"></i>
                                                                        </span>
                                                                    @endif
                                                                </span>
                                                                <small class="text-muted d-block">
                                                                    {{ $item->jumlah }}x @ Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                                                </small>
                                                            </div>
                                                            <div class="col-auto text-end">
                                                                <small class="fw-bold">
                                                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    @if($orderItems->count() > 3)
                                                        <div class="text-center mt-2">
                                                            <small class="text-muted">
                                                                dan {{ $orderItems->count() - 3 }} item lainnya...
                                                            </small>
                                                        </div>
                                                    @endif

                                                    <!-- Click to View Details -->
                                                    <div class="text-center mt-3">
                                                        <span class="text-primary small fw-medium">
                                                            <i class="bi bi-eye me-1"></i>Klik untuk lihat detail lengkap
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Summary Stats -->
                                        <div class="card bg-light border-0">
                                            <div class="card-body text-center">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h4 class="text-primary mb-1">{{ $orders->count() }}</h4>
                                                        <small class="text-muted">Total Pesanan</small>
                                                    </div>
                                                    <div class="col-md-4">
                                                        @php
                                                            $totalAllOrders = $orders->flatten()->sum('total_harga');
                                                            $totalAllDiscounts = $orders->flatten()->sum(fn($item) => $item->discount_amount ?? 0);
                                                        @endphp
                                                        <h4 class="text-success mb-1">Rp {{ number_format($totalAllOrders - $totalAllDiscounts, 0, ',', '.') }}</h4>
                                                        <small class="text-muted">Total Pembelanjaan</small>
                                                    </div>
                                                    <div class="col-md-4">
                                                        @php
                                                            $discountOrders = collect($orders)->filter(function($orderItems) {
                                                                return $orderItems->sum(fn($item) => $item->discount_amount ?? 0) > 0;
                                                            })->count();
                                                        @endphp
                                                        <h4 class="text-warning mb-1">{{ $discountOrders }}</h4>
                                                        <small class="text-muted">Pesanan Diskon</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <div class="mb-4">
                                                <i class="bi bi-receipt text-muted" style="font-size: 4rem;"></i>
                                            </div>
                                            <h5 class="mb-3">Belum Ada Riwayat Pesanan</h5>
                                            <p class="text-muted mb-4">Mulai berbelanja untuk melihat riwayat pesanan Anda di sini.</p>
                                            <a href="/" class="btn btn-primary">
                                                <i class="bi bi-shop me-2"></i>Mulai Berbelanja
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <a href="/" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Region API JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const provinceSelect = document.getElementById('provinceSelect');
    const regencySelect = document.getElementById('regencySelect');
    const districtSelect = document.getElementById('districtSelect');
    const villageSelect = document.getElementById('villageSelect');

    // User data for pre-population
    const userData = {
        province: '{{ $user->province }}',
        regency: '{{ $user->regency }}',
        district: '{{ $user->street }}',
        village: '{{ $user->hamlet }}'
    };

    let selectedProvinceId = null;

    // Province change handler
    provinceSelect.addEventListener('change', function() {
        const provinceId = this.value;
        selectedProvinceId = provinceId;

        resetOptions(regencySelect, 'Pilih Kabupaten/Kota');
        resetOptions(districtSelect, 'Pilih Kecamatan');
        resetOptions(villageSelect, 'Pilih Kelurahan/Desa');

        if (provinceId) {
            loadRegencies(provinceId);
        }
    });

    // Regency change handler
    regencySelect.addEventListener('change', function() {
        const regencyName = this.value;
        const selectedOption = this.options[this.selectedIndex];
        const regencyId = selectedOption ? selectedOption.getAttribute('data-id') : null;

        resetOptions(districtSelect, 'Pilih Kecamatan');
        resetOptions(villageSelect, 'Pilih Kelurahan/Desa');

        if (regencyId) {
            loadDistricts(regencyId);
        }
    });

    // District change handler
    districtSelect.addEventListener('change', function() {
        const districtName = this.value;
        const selectedOption = this.options[this.selectedIndex];
        const districtId = selectedOption ? selectedOption.getAttribute('data-id') : null;

        resetOptions(villageSelect, 'Pilih Kelurahan/Desa');

        if (districtId) {
            loadVillages(districtId);
        }
    });

    // Helper function to reset select options
    function resetOptions(selectElement, defaultText) {
        selectElement.innerHTML = `<option value="">${defaultText}</option>`;
    }

    // Load regencies for selected province
    function loadRegencies(provinceId) {
        fetch(`/api/regencies/${provinceId}`)
            .then(response => response.json())
            .then(data => {
                resetOptions(regencySelect, 'Pilih Kabupaten/Kota');
                data.forEach(regency => {
                    const option = document.createElement('option');
                    option.value = regency.name;
                    option.textContent = regency.name;
                    option.setAttribute('data-id', regency.id);
                    // Pre-select if it matches user data
                    if (userData.regency === regency.name) {
                        option.selected = true;
                    }
                    regencySelect.appendChild(option);
                });

                // If user has regency data, trigger change to load districts
                if (userData.regency) {
                    setTimeout(() => {
                        regencySelect.dispatchEvent(new Event('change'));
                    }, 100);
                }
            })
            .catch(error => console.error('Error loading regencies:', error));
    }

    // Load districts for selected regency
    function loadDistricts(regencyId) {
        fetch(`/api/districts/${regencyId}`)
            .then(response => response.json())
            .then(data => {
                resetOptions(districtSelect, 'Pilih Kecamatan');
                data.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.name;
                    option.textContent = district.name;
                    option.setAttribute('data-id', district.id);
                    // Pre-select if it matches user data
                    if (userData.district === district.name) {
                        option.selected = true;
                    }
                    districtSelect.appendChild(option);
                });

                // If user has district data, trigger change to load villages
                if (userData.district) {
                    setTimeout(() => {
                        districtSelect.dispatchEvent(new Event('change'));
                    }, 100);
                }
            })
            .catch(error => console.error('Error loading districts:', error));
    }

    // Load villages for selected district
    function loadVillages(districtId) {
        fetch(`/api/villages/${districtId}`)
            .then(response => response.json())
            .then(data => {
                resetOptions(villageSelect, 'Pilih Kelurahan/Desa');
                data.forEach(village => {
                    const option = document.createElement('option');
                    option.value = village.name;
                    option.textContent = village.name;
                    // Villages don't need IDs since they're the final level
                    if (userData.village === village.name) {
                        option.selected = true;
                    }
                    villageSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error loading villages:', error));
    }

    // Pre-load user's existing data on page load
    if (userData.province) {
        // Find the province ID by name and select it
        const matchingOption = Array.from(provinceSelect.options).find(option =>
            option.textContent === userData.province
        );
        if (matchingOption) {
            matchingOption.selected = true;
            provinceSelect.dispatchEvent(new Event('change'));
        }
    }
});
</script>

</body>
</html>
