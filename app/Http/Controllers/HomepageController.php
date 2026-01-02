<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Hero;
use App\Models\Sponsor;
use App\Models\AboutNContact;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class HomepageController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->paginate(15);

        // Cache hero, sponsors, and about data for 30 minutes (1800 seconds)
        $hero = Cache::remember('homepage_hero', 1800, function () {
            return Hero::where('status', 1)->latest()->first();
        });

        $sponsors = Cache::remember('homepage_sponsors', 1800, function () {
            return Sponsor::where('status', 1)->get();
        });

        $data = Cache::remember('homepage_about', 1800, function () {
            return AboutNContact::first();
        });

        // Cache top ordered menus for 1 hour (3600 seconds) - updates less frequently
        $topMenusThisMonth = Cache::remember('homepage_top_menus_' . now()->format('Y-m'), 3600, function () {
            return DB::table('pesanan')
                ->join('menu', 'pesanan.menu_id', '=', 'menu.id')
                ->select('menu.nama_menu', 'menu.gambar_menu', DB::raw('SUM(pesanan.jumlah) as total_ordered'))
                ->where('pesanan.created_at', '>=', now()->startOfMonth())
                ->where('menu.stok', '>', 0)
                ->groupBy('pesanan.menu_id', 'menu.nama_menu', 'menu.gambar_menu')
                ->orderBy('total_ordered', 'desc')
                ->limit(5)
                ->get();
        });

        return view('homepage', compact('menus', 'hero', 'sponsors', 'data', 'topMenusThisMonth'));
    }
}

