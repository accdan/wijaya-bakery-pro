<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pesanan - Wijaya Bakery</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --brown: #8B4513;
            --dark-brown: #5D3A1A;
            --cream: #FEF9F3;
            --green: #28a745;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream);
            color: #333;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Header */
        .report-header {
            background: linear-gradient(135deg, var(--brown), var(--dark-brown));
            color: white;
            padding: 24px;
            border-radius: 16px;
            text-align: center;
            margin-bottom: 20px;
        }

        .report-header h1 {
            font-size: 1.5rem;
            margin-bottom: 4px;
        }

        .report-header .subtitle {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .report-header .period {
            margin-top: 8px;
            font-size: 0.85rem;
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 16px;
            border-radius: 20px;
            display: inline-block;
        }

        /* Actions */
        .actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-back {
            background: #e9ecef;
            color: #495057;
        }

        .btn-back:hover {
            background: #dee2e6;
        }

        .btn-print {
            background: var(--brown);
            color: white;
        }

        .btn-print:hover {
            background: var(--dark-brown);
        }

        /* Stats */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            padding: 16px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .stat-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--brown);
        }

        .stat-label {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 4px;
        }

        /* Table */
        .orders-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: var(--brown);
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 0.8rem;
            font-weight: 600;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.85rem;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #fafafa;
        }

        .customer-info {
            font-weight: 600;
            color: #333;
        }

        .customer-phone {
            font-size: 0.75rem;
            color: #6c757d;
        }

        .order-total {
            font-weight: 700;
            color: var(--green);
        }

        .order-date {
            font-size: 0.75rem;
            color: #6c757d;
        }

        /* Footer */
        .report-footer {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-size: 0.8rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        /* Print Styles */
        @media print {
            body {
                padding: 0;
                background: white;
            }

            .actions {
                display: none;
            }

            .report-header {
                border-radius: 0;
            }

            .stat-card,
            .orders-table {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }

        @media (max-width: 600px) {
            .stats-row {
                grid-template-columns: 1fr;
            }

            th,
            td {
                padding: 8px;
                font-size: 0.75rem;
            }
        }
    </style>
</head>

<body>
    <div class="report-header">
        <h1>🥐 Wijaya Bakery</h1>
        <div class="subtitle">Laporan Pesanan</div>
        <div class="period">
            @if($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir'))
                {{ \Carbon\Carbon::parse($request->tanggal_mulai)->format('d M Y') }} -
                {{ \Carbon\Carbon::parse($request->tanggal_akhir)->format('d M Y') }}
            @else
                Semua Data
            @endif
        </div>
    </div>

    <div class="actions">
        <a href="{{ route('admin.pesanan.index') }}" class="btn btn-back">← Kembali</a>
        <button class="btn btn-print" onclick="window.print()">🖨️ Cetak</button>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-value">{{ $totalOrders }}</div>
            <div class="stat-label">Total Pesanan</div>
        </div>
        <div class="stat-card">
            <div class="stat-value" style="color: var(--green);">Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </div>
            <div class="stat-label">Total Pendapatan</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ now()->format('d/m/Y') }}</div>
            <div class="stat-label">Tanggal Cetak</div>
        </div>
    </div>

    @if($groupedPesanans->count() > 0)
        <div class="orders-table">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Item</th>
                        <th>Total</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($groupedPesanans as $groupKey => $orders)
                        @php
                            $info = explode('|', $groupKey);
                            $nama = $info[0] ?? '-';
                            $noHp = $info[1] ?? '-';
                            $waktu = $info[2] ?? '-';
                            $groupTotal = $orders->sum('total_harga');
                            $itemCount = $orders->sum('jumlah');
                        @endphp
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <div class="customer-info">{{ $nama }}</div>
                                <div class="customer-phone">{{ $noHp }}</div>
                            </td>
                            <td>{{ $itemCount }} item</td>
                            <td class="order-total">Rp {{ number_format($groupTotal, 0, ',', '.') }}</td>
                            <td class="order-date">{{ \Carbon\Carbon::parse($waktu)->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">📭</div>
            <p>Tidak ada data pesanan untuk periode ini.</p>
        </div>
    @endif

    <div class="report-footer">
        Wijaya Bakery • Laporan dicetak {{ now()->format('d F Y, H:i') }}
    </div>
</body>

</html>



