<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna || Wijaya Bakery</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/logo1.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background: #f4f6f9;
        }

        .page-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
        }

        .page-header {
            background: white;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-add {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-add:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            color: white;
        }

        /* Search bar */
        .search-bar {
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .search-input {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            width: 100%;
            max-width: 300px;
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
        }

        /* User grid */
        .user-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1rem;
            padding: 1.5rem;
        }

        .user-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.2s;
            border: 1px solid #e9ecef;
        }

        .user-card:hover {
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .user-avatar {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.25rem;
            color: white;
            flex-shrink: 0;
        }

        .avatar-admin {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .avatar-kasir {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .avatar-owner {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .avatar-default {
            background: linear-gradient(135deg, #6b7280, #4b5563);
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-email {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-phone {
            font-size: 0.8rem;
            color: #adb5bd;
        }

        .role-badge {
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .role-admin {
            background: #fef2f2;
            color: #dc2626;
        }

        .role-kasir {
            background: #f0fdf4;
            color: #16a34a;
        }

        .role-owner {
            background: #eff6ff;
            color: #2563eb;
        }

        .role-default {
            background: #f3f4f6;
            color: #4b5563;
        }

        .user-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-action.view {
            background: #e0f2fe;
            color: #0284c7;
        }

        .btn-action.edit {
            background: #fef3c7;
            color: #d97706;
        }

        .btn-action.delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-action:hover {
            transform: scale(1.1);
        }

        /* Stats bar */
        .stats-bar {
            display: flex;
            gap: 2rem;
            padding: 1rem 1.5rem;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .stat-label {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        /* Modal */
        .modal-content {
            border: none;
            border-radius: 12px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('include.navbarSistem')
        @include('include.sidebar')

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="font-weight: 600;">Kelola Pengguna</h1>
                            <p class="text-muted mb-0">Manajemen User & Admin</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Pengguna</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="page-card">
                        <!-- Stats -->
                        @php
                            $adminCount = $users->filter(fn($u) => $u->role && $u->role->role_name == 'admin')->count();
                            $userCount = $users->count() - $adminCount;
                        @endphp
                        <div class="stats-bar">
                            <div class="stat-item">
                                <div class="stat-value">{{ $users->count() }}</div>
                                <div class="stat-label">Total Pengguna</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">{{ $adminCount }}</div>
                                <div class="stat-label">Admin</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">{{ $userCount }}</div>
                                <div class="stat-label">User Biasa</div>
                            </div>
                        </div>

                        <div class="page-header">
                            <div style="position: relative;">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" class="search-input" id="searchInput" placeholder="Cari pengguna...">
                            </div>
                            <a href="{{ route('admin.user.create') }}" class="btn btn-add">
                                <i class="fas fa-plus mr-2"></i>Tambah Pengguna
                            </a>
                        </div>

                        @if($users->count() > 0)
                            <div class="user-grid" id="userGrid">
                                @foreach($users as $user)
                                    @php
                                        $roleName = $user->role->role_name ?? 'user';
                                        $avatarClass = match ($roleName) {
                                            'admin' => 'avatar-admin',
                                            'kasir' => 'avatar-kasir',
                                            'owner' => 'avatar-owner',
                                            default => 'avatar-default',
                                        };
                                        $roleClass = match ($roleName) {
                                            'admin' => 'role-admin',
                                            'kasir' => 'role-kasir',
                                            'owner' => 'role-owner',
                                            default => 'role-default',
                                        };
                                        $initial = strtoupper(substr($user->name, 0, 1));
                                    @endphp
                                    <div class="user-card" data-name="{{ strtolower($user->name) }}"
                                        data-email="{{ strtolower($user->email) }}">
                                        <div class="user-avatar {{ $avatarClass }}">{{ $initial }}</div>
                                        <div class="user-info">
                                            <div class="user-name">{{ $user->name }}</div>
                                            <div class="user-email">{{ $user->email }}</div>
                                            <div class="user-phone">
                                                <i class="fas fa-phone-alt mr-1"></i>{{ $user->no_telepon ?? '-' }}
                                            </div>
                                        </div>
                                        <span class="role-badge {{ $roleClass }}">{{ ucfirst($roleName) }}</span>
                                        <div class="user-actions">
                                            <a href="{{ route('admin.user.show', $user->id) }}" class="btn-action view"
                                                title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn-action edit"
                                                title="Edit">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn-action delete" data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $user->id }}" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <h5>Belum ada pengguna</h5>
                                <p>Tambahkan pengguna baru untuk memulai</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pengguna ini?</p>
                </div>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('services.ToastModal')
    @include('services.LogoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function () {
            // Search functionality
            $('#searchInput').on('input', function () {
                const query = $(this).val().toLowerCase();
                $('.user-card').each(function () {
                    const name = $(this).data('name');
                    const email = $(this).data('email');
                    $(this).toggle(name.includes(query) || email.includes(query));
                });
            });

            // Delete modal
            $('.delete').click(function () {
                const id = $(this).data('id');
                $('#deleteForm').attr('action', '{{ url("mng-user") }}/' + id);
            });

            @if(session('success') || session('error'))
                $('#toastNotification').toast({ delay: 3000 }).toast('show');
            @endif
        });
    </script>
</body>

</html>



