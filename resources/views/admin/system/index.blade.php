<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Settings || Wijaya Bakery Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/image/logo1.png') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
            background-color: #f4f6f9;
        }

        .system-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .system-card .card-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .system-card .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: #343a40;
        }

        .system-card .card-body {
            padding: 1.25rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .status-badge.online {
            background: #d4edda;
            color: #155724;
        }

        .status-badge.maintenance {
            background: #fff3cd;
            color: #856404;
        }

        .backup-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #e9ecef;
            transition: background 0.2s;
        }

        .backup-item:hover {
            background: #f8f9fa;
        }

        .backup-item:last-child {
            border-bottom: none;
        }

        .backup-info {
            flex: 1;
        }

        .backup-name {
            font-weight: 600;
            color: #343a40;
        }

        .backup-meta {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .log-entry {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e9ecef;
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 0.85rem;
        }

        .log-entry:last-child {
            border-bottom: none;
        }

        .log-entry.ERROR {
            background: #fff5f5;
            border-left: 4px solid #dc3545;
        }

        .log-entry.WARNING {
            background: #fffbeb;
            border-left: 4px solid #ffc107;
        }

        .log-entry.INFO {
            background: #f0f9ff;
            border-left: 4px solid #17a2b8;
        }

        .log-time {
            color: #6c757d;
            margin-right: 0.5rem;
        }

        .log-level {
            font-weight: 700;
            margin-right: 0.5rem;
        }

        .log-level.ERROR {
            color: #dc3545;
        }

        .log-level.WARNING {
            color: #ffc107;
        }

        .log-level.INFO {
            color: #17a2b8;
        }

        .log-message {
            color: #343a40;
            word-break: break-word;
        }

        .log-stack {
            margin-top: 0.5rem;
            padding: 0.5rem;
            background: #f8f9fa;
            border-radius: 4px;
            font-size: 0.8rem;
            max-height: 150px;
            overflow-y: auto;
            white-space: pre-wrap;
            color: #6c757d;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .btn-action {
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .quick-stat {
            text-align: center;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .quick-stat .value {
            font-size: 2rem;
            font-weight: 700;
            color: #343a40;
        }

        .quick-stat .label {
            font-size: 0.875rem;
            color: #6c757d;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('include.navbarSistem')
        @include('include.sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">

            <!-- Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="font-weight: 600;">System Settings</h1>
                            <p class="text-muted mb-0">Kelola maintenance mode, backup, dan error logs</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">System</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Row 1: Maintenance Mode & Quick Stats -->
                    <div class="row">
                        <!-- Maintenance Mode -->
                        <div class="col-lg-6 mb-4">
                            <div class="system-card h-100">
                                <div class="card-header">
                                    <h5><i class="fas fa-tools mr-2"></i>Maintenance Mode</h5>
                                    <span class="status-badge {{ $maintenanceMode ? 'maintenance' : 'online' }}">
                                        <i
                                            class="fas {{ $maintenanceMode ? 'fa-wrench' : 'fa-check-circle' }} mr-2"></i>
                                        {{ $maintenanceMode ? 'Maintenance' : 'Online' }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted mb-4">
                                        {{ $maintenanceMode
    ? 'Website sedang dalam mode maintenance. Pengunjung akan melihat halaman maintenance.'
    : 'Website berjalan normal dan dapat diakses oleh semua pengunjung.' 
                                        }}
                                    </p>
                                    <form action="{{ url('mng-system/maintenance') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn {{ $maintenanceMode ? 'btn-success' : 'btn-warning' }} btn-action btn-block">
                                            <i class="fas {{ $maintenanceMode ? 'fa-globe' : 'fa-tools' }} mr-2"></i>
                                            {{ $maintenanceMode ? 'Aktifkan Website' : 'Aktifkan Maintenance Mode' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Database Backup -->
                        <div class="col-lg-6 mb-4">
                            <div class="system-card h-100">
                                <div class="card-header">
                                    <h5><i class="fas fa-database mr-2"></i>Database Backup</h5>
                                    <form action="{{ url('mng-system/backup') }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm btn-action">
                                            <i class="fas fa-plus mr-1"></i> Buat Backup
                                        </button>
                                    </form>
                                </div>
                                <div class="card-body p-0" style="max-height: 300px; overflow-y: auto;">
                                    @if($backups->count() > 0)
                                        @foreach($backups as $backup)
                                            <div class="backup-item">
                                                <div class="backup-info">
                                                    <div class="backup-name">
                                                        <i class="fas fa-file-archive text-primary mr-2"></i>
                                                        {{ $backup['name'] }}
                                                    </div>
                                                    <div class="backup-meta">
                                                        {{ $backup['size'] }} • {{ $backup['date'] }}
                                                    </div>
                                                </div>
                                                <div class="backup-actions">
                                                    <a href="{{ url('mng-system/backup/download/' . $backup['name']) }}"
                                                        class="btn btn-sm btn-outline-primary mr-1" title="Download">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <form action="{{ url('mng-system/backup/delete/' . $backup['name']) }}"
                                                        method="POST" style="display: inline;"
                                                        onsubmit="return confirm('Hapus backup ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="empty-state">
                                            <i class="fas fa-database"></i>
                                            <p>Belum ada backup database.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Error Logs -->
                    <div class="row">
                        <div class="col-12">
                            <div class="system-card">
                                <div class="card-header">
                                    <h5><i class="fas fa-bug mr-2"></i>Error Logs</h5>
                                    <form action="{{ url('mng-system/logs/clear') }}" method="POST" style="margin: 0;"
                                        onsubmit="return confirm('Hapus semua log? Aksi ini tidak dapat dibatalkan.')">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm btn-action">
                                            <i class="fas fa-trash mr-1"></i> Clear Logs
                                        </button>
                                    </form>
                                </div>
                                <div class="card-body p-0" style="max-height: 500px; overflow-y: auto;">
                                    @if(count($errorLogs) > 0)
                                        @foreach($errorLogs as $log)
                                            <div class="log-entry {{ $log['level'] }}">
                                                <span class="log-time">{{ $log['datetime'] }}</span>
                                                <span class="log-level {{ $log['level'] }}">{{ $log['level'] }}</span>
                                                <span class="log-message">{{ Str::limit($log['message'], 200) }}</span>
                                                @if(!empty($log['stack']))
                                                    <details>
                                                        <summary class="text-muted" style="cursor: pointer; font-size: 0.8rem;">
                                                            Show Stack Trace
                                                        </summary>
                                                        <div class="log-stack">{{ $log['stack'] }}</div>
                                                    </details>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="empty-state">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <p>Tidak ada error log. Sistem berjalan dengan baik!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>

        @include('include.footerSistem')
    </div>

    @include('services.ToastModal')

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>