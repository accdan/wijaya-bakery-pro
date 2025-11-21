<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('kategori')->orderBy('created_at', 'desc')->get();
        return view('admin.menu.index', compact('menus'));
    }

    public function publicIndex(Request $request)
    {
        // Get query parameters
        $search = $request->get('search');
        $kategori = $request->get('kategori');
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        // Start query with relationships
        $query = Menu::with('kategori');

        // Apply search filter
        if ($search) {
            $query->where('nama_menu', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi_menu', 'like', '%' . $search . '%');
        }

        // Apply category filter
        if ($kategori) {
            $query->where('kategori_id', $kategori);
        }

        // Only show menus with stock > 0
        $query->where('stok', '>', 0);

        // Apply sorting
        switch ($sortBy) {
            case 'nama':
                $query->orderBy('nama_menu', $sortDirection);
                break;
            case 'harga_asc':
                $query->orderBy('harga', 'asc');
                break;
            case 'harga_desc':
                $query->orderBy('harga', 'desc');
                break;
            case 'terbaru':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('nama_menu', 'asc');
        }

        // Paginate results
        $menus = $query->paginate(12)->withQueryString();

        // Get all categories for filter dropdown
        $kategoris = Kategori::all();

        return view('menu.index', compact('menus', 'kategoris', 'search', 'kategori', 'sortBy', 'sortDirection'));
    }

    public function allMenuIndex(Request $request)
    {
        // Get query parameters
        $search = $request->get('search');
        $kategori = $request->get('kategori');
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        // Start query with relationships
        $query = Menu::with('kategori');

        // Apply search filter
        if ($search) {
            $query->where('nama_menu', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi_menu', 'like', '%' . $search . '%');
        }

        // Apply category filter
        if ($kategori) {
            $query->where('kategori_id', $kategori);
        }

        // Only show menus with stock > 0
        $query->where('stok', '>', 0);

        // Apply sorting
        switch ($sortBy) {
            case 'nama':
                $query->orderBy('nama_menu', $sortDirection);
                break;
            case 'harga_asc':
                $query->orderBy('harga', 'asc');
                break;
            case 'harga_desc':
                $query->orderBy('harga', 'desc');
                break;
            case 'terbaru':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('nama_menu', 'asc');
        }

        // Paginate results
        $menus = $query->paginate(12)->withQueryString();

        // Get all categories for filter dropdown
        $kategoris = Kategori::all();

        return view('all-menu.index', compact('menus', 'kategoris', 'search', 'kategori', 'sortBy', 'sortDirection'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.menu.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'deskripsi_menu' => 'nullable|string',
            'prosedur' => 'nullable|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar_menu' => 'nullable|image|mimes:jpg,jpeg,png|max:10192',
        ]);

        $data = $request->only([
            'nama_menu',
            'deskripsi_menu',
            'prosedur',
            'kategori_id',
            'harga',
            'stok'
        ]);


        if ($request->hasFile('gambar_menu')) {
            $file = $request->file('gambar_menu');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/menu'), $filename);
            $data['gambar_menu'] = $filename;
        }

        $menu = new Menu($data);
        $menu->id = (string) \Illuminate\Support\Str::uuid();
        $menu->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.menu.edit', compact('menu', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
    
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'deskripsi_menu' => 'nullable|string',
            'prosedur' => 'nullable|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar_menu' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $menu->nama_menu = $request->nama_menu;
        $menu->kategori_id = $request->kategori_id;
        $menu->deskripsi_menu = $request->deskripsi_menu;
        $menu->harga = $request->harga;
        $menu->stok = $request->stok;
        $menu->prosedur = $request->prosedur;
    
        // Cek jika ada input hasil crop dari cropper
        if ($request->filled('cropped_image')) {
            $imageData = $request->input('cropped_image');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
    
            $imageName = time() . '_cropped.png';
            $imagePath = public_path('uploads/menu/' . $imageName);
    
            // Hapus gambar lama
            if ($menu->gambar_menu && file_exists(public_path('uploads/menu/' . $menu->gambar_menu))) {
                unlink(public_path('uploads/menu/' . $menu->gambar_menu));
            }
    
            // Simpan gambar baru hasil crop
            file_put_contents($imagePath, base64_decode($imageData));
            $menu->gambar_menu = $imageName;
        }
        // Jika tidak ada crop, tapi ada upload biasa
        elseif ($request->hasFile('gambar_menu')) {
            if ($menu->gambar_menu && file_exists(public_path('uploads/menu/' . $menu->gambar_menu))) {
                unlink(public_path('uploads/menu/' . $menu->gambar_menu));
            }
    
            $file = $request->file('gambar_menu');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/menu'), $filename);
            $menu->gambar_menu = $filename;
        }
    
        $menu->save();
    
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }
    


    public function show($id)
    {
        $menu = Menu::with(['kategori'])->findOrFail($id);
        return view('admin.menu.show', compact('menu'));
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->deleteMenu();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus.');
    }

}
