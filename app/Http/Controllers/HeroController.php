<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Helpers\ImageOptimizer;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::all();
        return view('admin.hero.index', compact('heroes'));
    }
    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'required|boolean',
        ]);

        $data = $request->only(['status']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $destinationPath = storage_path('app/public/uploads/hero');
            $filename = ImageOptimizer::processUpload($file, $destinationPath, null, 1200, 85);
            if ($filename) {
                $data['gambar'] = $filename;
            }
        }

        Hero::create($data);

        return redirect()->route('admin.hero.index')->with('success', 'Hero berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $hero = Hero::findOrFail($id);
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, $id)
    {
        $hero = Hero::findOrFail($id);

        $request->validate([
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'required|boolean',
        ]);

        $data = $request->only(['status']);

        if ($request->hasFile('gambar')) {
            $oldPath = storage_path('app/public/uploads/hero/' . $hero->gambar);
            if ($hero->gambar && File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file = $request->file('gambar');
            $destinationPath = storage_path('app/public/uploads/hero');
            $filename = ImageOptimizer::processUpload($file, $destinationPath, null, 1200, 85);
            if ($filename) {
                $data['gambar'] = $filename;
            }
        }

        $hero->update($data);

        return redirect()->route('admin.hero.index')->with('success', 'Hero berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $hero = Hero::findOrFail($id);
        if ($hero->gambar && file_exists(storage_path('app/public/uploads/hero/' . $hero->gambar))) {
            unlink(storage_path('app/public/uploads/hero/' . $hero->gambar));
        }

        $hero->delete();

        return redirect()->route('admin.hero.index')->with('success', 'Hero berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $hero = Hero::findOrFail($id);
        $hero->status = !$hero->status;
        $hero->save();

        $status = $hero->status ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.hero.index')->with('success', "Gambar hero berhasil {$status}!");
    }
}
