<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Hero;
use App\Models\Sponsor;
use App\Models\AboutNContact;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->paginate(15);
        $hero = Hero::where('status', 1)->latest()->first();
        $sponsors = Sponsor::where('status', 1)->get();
        $data = AboutNContact::first();

        // Top ordered menus this month
        $topMenusThisMonth = DB::table('pesanan')
            ->join('menu', 'pesanan.menu_id', '=', 'menu.id')
            ->select('menu.nama_menu', 'menu.gambar_menu', DB::raw('SUM(pesanan.jumlah) as total_ordered'))
            ->where('pesanan.created_at', '>=', now()->startOfMonth())
            ->where('menu.stok', '>', 0)
            ->groupBy('pesanan.menu_id', 'menu.nama_menu', 'menu.gambar_menu')
            ->orderBy('total_ordered', 'desc')
            ->limit(5)
            ->get();

        return view('homepage', compact('menus', 'hero', 'sponsors', 'data', 'topMenusThisMonth'));
    }
}

