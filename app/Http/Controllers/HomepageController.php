<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Hero;
use App\Models\Promo;
use App\Models\Sponsor;
use App\Models\AboutNContact;

class HomepageController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->paginate(10); // tampil 8 menu per halaman
        $hero = Hero::where('status', 1)->latest()->first();
        $promos = Promo::where('status', 1)->get();
        $sponsors = Sponsor::all();
        $data = AboutNContact::first();
    
        return view('homepage', compact('menus', 'hero', 'promos', 'sponsors', 'data'));
    }
    

}
