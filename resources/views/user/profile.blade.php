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
                    <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
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
                                    <form method="POST" action="{{ route('user.profile.update.address') }}">
                                        @csrf
                                        @method('PATCH')

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Provinsi</label>
                                                    <input type="text" class="form-control" name="province" placeholder="Contoh: Jawa Timur"
                                                           value="{{ old('province', $user->province) }}">
                                                    @error('province')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Kabupaten/Kota</label>
                                                    <input type="text" class="form-control" name="regency" placeholder="Contoh: Kabupaten Malang"
                                                           value="{{ old('regency', $user->regency) }}">
                                                    @error('regency')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Jalan</label>
                                                    <input type="text" class="form-control" name="street" placeholder="Contoh: Jl. Sudirman No. 123"
                                                           value="{{ old('street', $user->street) }}">
                                                    @error('street')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Dusun/Kampung</label>
                                                    <input type="text" class="form-control" name="hamlet" placeholder="Contoh: Dusun Krasakan"
                                                           value="{{ old('hamlet', $user->hamlet) }}">
                                                    @error('hamlet')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
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
                                            @endphp
                                            <div class="card mb-3">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">
                                                        <i class="bi bi-calendar me-2"></i>
                                                        Pesanan {{ $orderDate->format('d M Y, H:i') }}
                                                    </h6>
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle me-1"></i>Selesai
                                                    </span>
                                                </div>
                                                <div class="card-body">
                                                    @php
                                                        $totalOrderPrice = 0;
                                                    @endphp
                                                    @foreach($orderItems as $item)
                                                        <div class="row align-items-center mb-2 pb-2 border-bottom">
                                                            <div class="col-md-2">
                                                                @if($item->menu)
                                                                    <img src="{{ asset('uploads/menu/' . $item->menu->gambar_menu) }}"
                                                                         alt="{{ $item->menu->nama_menu }}"
                                                                         class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                                                @endif
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6 class="mb-0">{{ $item->menu->nama_menu ?? 'Menu tidak ditemukan' }}</h6>
                                                                <small class="text-muted">{{ $item->menu->deskripsi_menu ? Str::limit($item->menu->deskripsi_menu, 50) : '' }}</small>
                                                            </div>
                                                            <div class="col-md-2 text-center">
                                                                <span class="badge bg-secondary">{{ $item->jumlah }}x</span>
                                                            </div>
                                                            <div class="col-md-2 text-end">
                                                                <strong>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</strong>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $totalOrderPrice += $item->total_harga;
                                                        @endphp
                                                    @endforeach
                                                    <div class="row mt-3">
                                                        <div class="col-12 text-end">
                                                            <strong class="text-primary">Total: Rp {{ number_format($totalOrderPrice, 0, ',', '.') }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center py-4">
                                            <i class="bi bi-receipt text-muted" style="font-size: 3rem;"></i>
                                            <p class="text-muted mt-2">Belum ada riwayat pesanan</p>
                                            <a href="/" class="btn btn-primary">Pesan Sekarang</a>
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

</body>
</html>
