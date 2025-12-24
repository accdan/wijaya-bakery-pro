<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Peran || Wijaya Bakery</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/logo1.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Source Sans Pro', sans-serif; background: #f4f6f9; }
        
        .page-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            border: none;
            overflow: hidden;
        }
        
        .page-header {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            padding: 1.5rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-header h5 {
            margin: 0;
            font-weight: 600;
        }
        
        .btn-add {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-add:hover {
            background: rgba(255,255,255,0.3);
            color: white;
        }
        
        /* Role grid */
        .role-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1rem;
            padding: 1.5rem;
        }
        
        .role-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 2px solid #e9ecef;
            transition: all 0.2s;
            position: relative;
        }
        
        .role-card:hover {
            border-color: #8b5cf6;
            box-shadow: 0 4px 16px rgba(139, 92, 246, 0.15);
        }
        
        .role-card.active {
            border-color: #22c55e;
        }
        
        .role-card.inactive {
            opacity: 0.6;
        }
        
        .role-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }
        
        .role-icon.admin { background: linear-gradient(135deg, #fef2f2, #fee2e2); color: #dc2626; }
        .role-icon.kasir { background: linear-gradient(135deg, #f0fdf4, #dcfce7); color: #16a34a; }
        .role-icon.owner { background: linear-gradient(135deg, #eff6ff, #dbeafe); color: #2563eb; }
        .role-icon.default { background: linear-gradient(135deg, #f3f4f6, #e5e7eb); color: #4b5563; }
        
        .role-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 0.25rem;
            text-transform: capitalize;
        }
        
        .role-desc {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }
        
        /* Toggle switch */
        .status-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .status-label {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .switch {
            position: relative;
            width: 48px;
            height: 26px;
        }
        
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background: #ccc;
            border-radius: 26px;
            transition: 0.3s;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background: white;
            border-radius: 50%;
            transition: 0.3s;
        }
        
        input:checked + .slider {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }
        
        input:checked + .slider:before {
            transform: translateX(22px);
        }
        
        /* Actions */
        .role-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-action {
            flex: 1;
            padding: 0.5rem;
            border-radius: 8px;
            border: none;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
            text-decoration: none;
            cursor: pointer;
        }
        
        .btn-action.edit { background: #fef3c7; color: #d97706; }
        .btn-action.delete { background: #fee2e2; color: #dc2626; }
        .btn-action:hover { transform: translateY(-1px); }
        
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
        .modal-content { border: none; border-radius: 12px; }
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
                            <h1 class="m-0" style="font-weight: 600;">Kelola Peran</h1>
                            <p class="text-muted mb-0">Manajemen hak akses sistem</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Peran</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="page-card">
                        <div class="page-header">
                            <div>
                                <h5><i class="fas fa-user-tag mr-2"></i>Daftar Peran</h5>
                                <small style="opacity: 0.8;">{{ $roles->count() }} peran tersedia</small>
                            </div>
                            <a href="{{ route('admin.role.create') }}" class="btn btn-add">
                                <i class="fas fa-plus mr-2"></i>Tambah Peran
                            </a>
                        </div>
                        
                        @if($roles->count() > 0)
                            <div class="role-grid">
                                @foreach($roles as $role)
                                    @php
                                        $iconClass = match(strtolower($role->role_name)) {
                                            'admin' => 'admin',
                                            'kasir' => 'kasir',
                                            'owner' => 'owner',
                                            default => 'default',
                                        };
                                        $icon = match(strtolower($role->role_name)) {
                                            'admin' => 'fa-user-shield',
                                            'kasir' => 'fa-cash-register',
                                            'owner' => 'fa-crown',
                                            default => 'fa-user',
                                        };
                                    @endphp
                                    <div class="role-card {{ $role->role_status ? 'active' : 'inactive' }}">
                                        <div class="role-icon {{ $iconClass }}">
                                            <i class="fas {{ $icon }}"></i>
                                        </div>
                                        <div class="role-name">{{ $role->role_name }}</div>
                                        <div class="role-desc">{{ $role->role_description ?? 'Tidak ada deskripsi' }}</div>
                                        
                                        <div class="status-toggle">
                                            <span class="status-label">Status Aktif</span>
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status" 
                                                       data-id="{{ $role->id }}" 
                                                       {{ $role->role_status ? 'checked' : '' }}>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        
                                        <div class="role-actions">
                                            <a href="{{ route('admin.role.edit', $role->id) }}" class="btn-action edit">
                                                <i class="fas fa-pen"></i>Edit
                                            </a>
                                            <button class="btn-action delete" data-toggle="modal" data-target="#deleteModal"
                                                    data-id="{{ $role->id }}">
                                                <i class="fas fa-trash"></i>Hapus
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-user-tag"></i>
                                <h5>Belum ada peran</h5>
                                <p>Tambahkan peran baru untuk mengatur hak akses</p>
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
                    <p>Apakah Anda yakin ingin menghapus peran ini?</p>
                    <p class="text-muted small">Pengguna dengan peran ini mungkin kehilangan akses.</p>
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
        $(document).ready(function() {
            // Toggle status
            $('.toggle-status').change(function() {
                const id = $(this).data('id');
                const status = $(this).prop('checked') ? 1 : 0;
                const card = $(this).closest('.role-card');
                
                $.post('{{ url("mng-role") }}/' + id + '/toggle-status', {
                    _token: '{{ csrf_token() }}',
                    role_status: status
                }, function(res) {
                    if (res.success) {
                        card.toggleClass('active', status === 1);
                        card.toggleClass('inactive', status === 0);
                    }
                }).fail(function() {
                    alert('Gagal mengubah status');
                });
            });
            
            // Delete modal
            $('.delete').click(function() {
                const id = $(this).data('id');
                $('#deleteForm').attr('action', '{{ url("mng-role") }}/' + id);
            });
            
            @if(session('success') || session('error'))
                $('#toastNotification').toast({ delay: 3000 }).toast('show');
            @endif
        });
    </script>
</body>
</html>




