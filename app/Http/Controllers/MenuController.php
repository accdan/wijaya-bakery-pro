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
            'gambar_menu' => 'nullable|image|mimes:jpg,jpeg,png|max:10192',
        ]);

        $data = $request->only(['nama_menu', 'deskripsi_menu', 'prosedur', 'kategori_id']);

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
            'gambar_menu' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $menu->nama_menu = $request->nama_menu;
        $menu->kategori_id = $request->kategori_id;
        $menu->deskripsi_menu = $request->deskripsi_menu;
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
    public function detail($id)
    {
        $menu = Menu::findOrFail($id);
        return view('user.detail-menu', compact('menu'));
    }
    
}
