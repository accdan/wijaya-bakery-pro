<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori::createKategori($request->only('nama_kategori'));

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->updateKategori($request->only('nama_kategori'));

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        // Check if category has menus
        $menuCount = $kategori->menus()->count();

        if ($menuCount > 0) {
            return redirect()
                ->route('admin.kategori.index')
                ->with('error', "Kategori '{$kategori->nama_kategori}' tidak dapat dihapus karena masih memiliki {$menuCount} menu. Hapus atau pindahkan menu terlebih dahulu.");
        }

        // Validate confirmation text
        $request->validate([
            'confirmation' => 'required|in:hapus',
        ], [
            'confirmation.required' => 'Konfirmasi penghapusan diperlukan.',
            'confirmation.in' => 'Anda harus mengetik "hapus" untuk mengkonfirmasi penghapusan.',
        ]);

        $kategori->deleteKategori();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->toggleStatus();

            return response()->json([
                'success' => true,
                'message' => 'Status kategori berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status.'
            ], 500);
        }
    }
}

