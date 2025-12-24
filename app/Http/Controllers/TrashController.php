<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;
use App\Models\Sponsor;
use App\Models\Pesanan;

class TrashController extends Controller
{
    /**
     * Display trash items
     */
    public function index(Request $request)
    {
        $type = $request->get('type', 'menu');

        $trashedItems = collect();

        switch ($type) {
            case 'menu':
                $trashedItems = Menu::onlyTrashed()->with('kategori')->orderBy('deleted_at', 'desc')->get();
                break;
            case 'kategori':
                $trashedItems = Kategori::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
                break;
            case 'sponsor':
                $trashedItems = Sponsor::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
                break;
            case 'pesanan':
                $trashedItems = Pesanan::onlyTrashed()->with('menu')->orderBy('deleted_at', 'desc')->get();
                break;
        }

        // Get counts for all types
        $counts = [
            'menu' => Menu::onlyTrashed()->count(),
            'kategori' => Kategori::onlyTrashed()->count(),
            'sponsor' => Sponsor::onlyTrashed()->count(),
            'pesanan' => Pesanan::onlyTrashed()->count(),
        ];

        return view('admin.trash.index', compact('trashedItems', 'type', 'counts'));
    }

    /**
     * Restore a soft-deleted item
     */
    public function restore(Request $request, $type, $id)
    {
        try {
            $item = $this->getModel($type)->onlyTrashed()->findOrFail($id);
            $item->restore();

            return redirect()->back()->with('success', ucfirst($type) . ' berhasil dipulihkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memulihkan item: ' . $e->getMessage());
        }
    }

    /**
     * Permanently delete an item
     */
    public function forceDelete(Request $request, $type, $id)
    {
        try {
            $item = $this->getModel($type)->onlyTrashed()->findOrFail($id);

            // Delete associated files if any
            if ($type === 'menu' && $item->gambar_menu) {
                $path = storage_path('app/public/uploads/menu/' . $item->gambar_menu);
                if (file_exists($path)) {
                    unlink($path);
                }
            } elseif ($type === 'sponsor' && $item->logo_sponsor) {
                $path = storage_path('app/public/uploads/sponsor/' . $item->logo_sponsor);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $item->forceDelete();

            return redirect()->back()->with('success', ucfirst($type) . ' dihapus permanen.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus item: ' . $e->getMessage());
        }
    }

    /**
     * Restore all items of a type
     */
    public function restoreAll(Request $request, $type)
    {
        try {
            $this->getModel($type)->onlyTrashed()->restore();

            return redirect()->back()->with('success', 'Semua ' . $type . ' berhasil dipulihkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memulihkan: ' . $e->getMessage());
        }
    }

    /**
     * Empty trash for a type (delete all permanently)
     */
    public function emptyTrash(Request $request, $type)
    {
        try {
            $items = $this->getModel($type)->onlyTrashed()->get();

            foreach ($items as $item) {
                // Delete associated files
                if ($type === 'menu' && $item->gambar_menu) {
                    $path = storage_path('app/public/uploads/menu/' . $item->gambar_menu);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                } elseif ($type === 'sponsor' && $item->logo_sponsor) {
                    $path = storage_path('app/public/uploads/sponsor/' . $item->logo_sponsor);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }

                $item->forceDelete();
            }

            return redirect()->back()->with('success', 'Trash ' . $type . ' berhasil dikosongkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengosongkan trash: ' . $e->getMessage());
        }
    }

    /**
     * Get model instance by type
     */
    private function getModel($type)
    {
        switch ($type) {
            case 'menu':
                return new Menu();
            case 'kategori':
                return new Kategori();
            case 'sponsor':
                return new Sponsor();
            case 'pesanan':
                return new Pesanan();
            default:
                abort(404, 'Invalid type');
        }
    }
}
