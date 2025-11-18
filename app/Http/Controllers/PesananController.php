<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with('menu');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pemesan', 'LIKE', '%' . $search . '%')
                  ->orWhere('no_hp', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('menu', function($menuQuery) use ($search) {
                      $menuQuery->where('nama_menu', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        // Date range filter
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai)
                  ->whereDate('created_at', '<=', $request->tanggal_akhir);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        // Valid sort columns
        $validSortColumns = ['created_at', 'nama_pemesan', 'total_harga'];
        if (in_array($sortBy, $validSortColumns)) {
            $query->orderBy($sortBy, $sortDirection);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $pesanans = $query->get()->groupBy(function($item) {
            return $item->nama_pemesan . '|' . $item->no_hp . '|' . $item->created_at->format('Y-m-d H:i');
        });

        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.pesanan.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'menu_id' => 'required|exists:menu,id',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        $pesanan = new Pesanan([
            'nama_pemesan' => $request->nama_pemesan,
            'no_hp' => $request->no_hp,
            'menu_id' => $request->menu_id,
            'harga_satuan' => $request->harga_satuan,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->harga_satuan * $request->jumlah,
            'catatan' => $request->catatan,
        ]);

        $pesanan->save();

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pesanan = Pesanan::with('menu')->findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $menus = Menu::all();
        return view('admin.pesanan.edit', compact('pesanan', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'menu_id' => 'required|exists:menu,id',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        $total_harga = $request->harga_satuan * $request->jumlah;

        $pesanan->update([
            'nama_pemesan' => $request->nama_pemesan,
            'no_hp' => $request->no_hp,
            'menu_id' => $request->menu_id,
            'harga_satuan' => $request->harga_satuan,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil dihapus!');
    }

    public function storeFromUser(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'menu' => 'required|array|min:1',
            'menu.*.menu_id' => 'required|exists:menu,id',
            'menu.*.harga_satuan' => 'required|numeric|min:0',
            'menu.*.jumlah' => 'required|integer|min:1',
        ]);

        // Check stock availability
        $errors = [];
        foreach ($request->menu as $item) {
            $menu = Menu::find($item['menu_id']);
            if (!$menu) {
                $errors[] = "Menu dengan ID {$item['menu_id']} tidak ditemukan";
            } elseif ($menu->stok < $item['jumlah']) {
                $errors[] = "Stok {$menu->nama_menu} tidak mencukupi (tersisa {$menu->stok})";
            }
        }

        if (!empty($errors)) {
            $message = implode(', ', $errors);
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $message], 400);
            } else {
                return redirect()->back()->withErrors(['stock' => $message]);
            }
        }

        $nama_pemesan = $request->nama_pemesan;
        $no_hp = $request->no_hp;
        $total_pesanan = 0;
        $pesanans = [];

        DB::transaction(function () use ($request, &$nama_pemesan, &$no_hp, &$total_pesanan, &$pesanans) {
            foreach ($request->menu as $item) {
                $harga_satuan = $item['harga_satuan'];
                $jumlah = $item['jumlah'];
                $total_harga = $harga_satuan * $jumlah;

                $pesanan = Pesanan::create([
                    'nama_pemesan' => $nama_pemesan,
                    'no_hp' => $no_hp,
                    'menu_id' => $item['menu_id'],
                    'harga_satuan' => $harga_satuan,
                    'jumlah' => $jumlah,
                    'total_harga' => $total_harga,
                ]);

                // Decrease stock
                $menu = Menu::find($item['menu_id']);
                $menu->decrement('stok', $jumlah);

                $pesanans[] = $pesanan->load('menu'); // Load relation on each
                $total_pesanan += $total_harga;
            }
        });

        // Prepare WhatsApp message outside transaction
        $waMessage = "*PESANAN BARU*\n\n";
        $waMessage .= "Nama: $nama_pemesan\n";
        $waMessage .= "No. Telp: $no_hp\n\n";
        $waMessage .= "*Detail Pesanan:*\n";

        foreach ($pesanans as $index => $p) {
            $waMessage .= ($index + 1) . ". " . $p->menu->nama_menu . "\n";
            $waMessage .= "   Jumlah: " . $p->jumlah . " x Rp " . number_format($p->harga_satuan, 0, ',', '.') . "\n";
            $waMessage .= "   Subtotal: Rp " . number_format($p->total_harga, 0, ',', '.') . "\n\n";
        }

        $waMessage .= "*Total: Rp " . number_format($total_pesanan, 0, ',', '.') . "*";

        // Redirect to WhatsApp URL
        $waNumber = '6285853849466';
        $waUrl = "https://wa.me/{$waNumber}?text=" . urlencode($waMessage);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'waUrl' => $waUrl,
                'message' => 'Pesanan berhasil disimpan!'
            ]);
        } else {
            return redirect($waUrl);
        }
    }
}
