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
    public function index()
    {
        $totalPeran     = Role::count();
        $totalUser      = User::count();
        $totalKategori  = Kategori::count();
        $totalMenu      = Menu::count();
        $totalPromo     = Promo::count();
        $totalSponsor   = Sponsor::count();
        $lowStockMenus  = Menu::where('stok', '<', 20)->orderBy('stok')->get();

        // Sales data for the last 30 days
        $salesData = DB::table('pesanan')
            ->select(DB::raw('DATE(created_at) as date, SUM(total_harga) as total'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top ordered menus this month
        $topMenusThisMonth = DB::table('pesanan')
            ->join('menu', 'pesanan.menu_id', '=', 'menu.id')
            ->select('menu.nama_menu', DB::raw('SUM(pesanan.jumlah) as total_ordered'))
            ->where('pesanan.created_at', '>=', now()->startOfMonth())
            ->groupBy('pesanan.menu_id', 'menu.nama_menu')
            ->orderBy('total_ordered', 'desc')
            ->limit(10)
            ->get();

        // Revenue calculations
        $revenueMonth = Pesanan::where('created_at', '>=', now()->startOfMonth())->sum('total_harga');
        $revenueYear = Pesanan::where('created_at', '>=', now()->startOfYear())->sum('total_harga');
        $revenueTotal = Pesanan::sum('total_harga');

        // Order counts
        $ordersMonth = Pesanan::where('created_at', '>=', now()->startOfMonth())->count();
        $ordersYear = Pesanan::where('created_at', '>=', now()->startOfYear())->count();
        $ordersTotal = Pesanan::count();

        return view('admin.dashboard-admin', compact(
            'totalPeran', 'totalUser', 'totalKategori', 'totalMenu', 'totalPromo', 'totalSponsor',
            'lowStockMenus', 'salesData', 'topMenusThisMonth',
            'revenueMonth', 'revenueYear', 'revenueTotal',
            'ordersMonth', 'ordersYear', 'ordersTotal'
        ));
    }
}
