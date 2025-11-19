<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use App\Models\Sponsor;
use App\Models\Role;
use App\Models\Kategori;
use App\Models\Menu;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalPeran     = Role::count();
        $totalUser      = User::count();
        $totalKategori  = Kategori::count();
        $totalMenu      = Menu::count();
        $totalPromo     = Promo::count();
        $totalSponsor   = Sponsor::count();
        $lowStockMenus  = Menu::where('stok', '<', 20)->orderBy('stok')->get();

        // Get year and date range from request or use defaults
        $year = $request->get('year', now()->year);
        $startMonth = $request->get('start_month', 1);
        $endMonth = $request->get('end_month', 12);

        // Monthly profit data for the selected year and range
        $monthlyProfitData = $this->getMonthlyProfitData($year, $startMonth, $endMonth);

        // Get parameters for daily sales chart (selected month)
        $salesYear = $request->get('sales_year', now()->year);
        $salesMonth = $request->get('sales_month', now()->month);

        // Daily sales data for the selected month
        $dailySalesData = $this->getDailySalesData($salesYear, $salesMonth);

        // Sales data for the last 30 days (existing feature)
        $salesData = DB::table('pesanan')
            ->select(DB::raw('DATE(created_at) as date, SUM(total_harga) as total'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top ordered menus this month (existing feature)
        $topMenusThisMonth = DB::table('pesanan')
            ->join('menu', 'pesanan.menu_id', '=', 'menu.id')
            ->select('menu.nama_menu', DB::raw('SUM(pesanan.jumlah) as total_ordered'))
            ->where('pesanan.created_at', '>=', now()->startOfMonth())
            ->groupBy('pesanan.menu_id', 'menu.nama_menu')
            ->orderBy('total_ordered', 'desc')
            ->limit(10)
            ->get();

        // Revenue calculations (existing features)
        $revenueMonth = Pesanan::where('created_at', '>=', now()->startOfMonth())->sum('total_harga');
        $revenueYear = Pesanan::where('created_at', '>=', now()->startOfYear())->sum('total_harga');
        $revenueTotal = Pesanan::sum('total_harga');

        // Order counts (existing features)
        $ordersMonth = Pesanan::where('created_at', '>=', now()->startOfMonth())->count();
        $ordersYear = Pesanan::where('created_at', '>=', now()->startOfYear())->count();
        $ordersTotal = Pesanan::count();

        return view('admin.dashboard-admin', compact(
            'totalPeran', 'totalUser', 'totalKategori', 'totalMenu', 'totalPromo', 'totalSponsor',
            'lowStockMenus', 'salesData', 'topMenusThisMonth',
            'revenueMonth', 'revenueYear', 'revenueTotal',
            'ordersMonth', 'ordersYear', 'ordersTotal',
            'monthlyProfitData', 'year', 'startMonth', 'endMonth',
            'dailySalesData', 'salesYear', 'salesMonth'
        ));
    }

    /**
     * Get monthly profit data for a given year and month range
     */
    private function getMonthlyProfitData($year, $startMonth, $endMonth)
    {
        $monthlyData = [];

        for ($month = $startMonth; $month <= $endMonth; $month++) {
            $startDate = \Carbon\Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = \Carbon\Carbon::create($year, $month, 1)->endOfMonth();

            $monthlyData[$month] = [
                'month' => $month,
                'month_name' => \Carbon\Carbon::create($year, $month, 1)->format('M'),
                'revenue' => Pesanan::whereBetween('created_at', [$startDate, $endDate])->sum('total_harga'),
                'orders' => Pesanan::whereBetween('created_at', [$startDate, $endDate])->count(),
            ];
        }

        return $monthlyData;
    }

    /**
     * Get daily sales data for a given year and month
     */
    private function getDailySalesData($year, $month)
    {
        $startDate = \Carbon\Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::create($year, $month, 1)->endOfMonth();

        $dailyData = DB::table('pesanan')
            ->select(DB::raw('DATE(created_at) as date, SUM(total_harga) as total, COUNT(*) as orders'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Fill missing dates with zero values
        $daysInMonth = $startDate->daysInMonth;
        $filledData = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
            $filledData[$date] = isset($dailyData[$date])
                ? [
                    'date' => $date,
                    'total' => (float)$dailyData[$date]->total,
                    'orders' => (int)$dailyData[$date]->orders,
                    'day' => $day
                ]
                : [
                    'date' => $date,
                    'total' => 0,
                    'orders' => 0,
                    'day' => $day
                ];
        }

        return $filledData;
    }
}
