<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use App\Models\Menu;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::all();
        return view('admin.promo.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_promo'          => 'required|string|max:255',
            'deskripsi_promo'     => 'nullable|string',
            'gambar_promo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'              => 'required|boolean',
            'menu_id'             => 'nullable|exists:menu,id',
            'min_quantity'        => 'required|integer|min:1',
            'discount_type'       => 'required|in:fixed,percentage,buy_one_get_one,free_shipping',
            'discount_value'      => 'required|numeric|min:0',
            'is_discount_active'  => 'boolean',
            // Advanced Discount Rules Validation
            'discount_rule'       => 'nullable|in:single_menu,multiple_menus,category_only,price_range,all_items',
            'kategori_id'         => 'nullable|exists:kategori,id',
            'price_min'           => 'nullable|numeric|min:0',
            'price_max'           => 'nullable|numeric|min:0',
            'selected_menus'      => 'nullable|array',
            'selected_menus.*'    => 'exists:menu,id',
            'valid_until'         => 'nullable|date|after:now',
            'max_discount_uses'   => 'nullable|integer|min:1',
            'apply_to_cart_total' => 'boolean',
        ]);

        // Additional validation for percentage discount
        if ($request->discount_type === 'percentage' && $request->discount_value > 100) {
            return back()->withErrors(['discount_value' => 'Persentase diskon tidak boleh lebih dari 100%'])->withInput();
        }

        // Additional validation for price range
        if ($request->price_min && $request->price_max && $request->price_min >= $request->price_max) {
            return back()->withErrors(['price_min' => 'Minimum price must be less than maximum price'])->withInput();
        }

        // Collect all allowed fields
        $data = $request->only([
            'nama_promo', 'deskripsi_promo', 'status', 'menu_id',
            'min_quantity', 'discount_type', 'discount_value', 'is_discount_active',
            // Advanced discount fields
            'kategori_id', 'price_min', 'price_max', 'discount_rule',
            'valid_until', 'max_discount_uses', 'apply_to_cart_total'
        ]);

        // Set default value for discount_rule if not set
        $data['discount_rule'] = $data['discount_rule'] ?? 'all_items';

        // Handle image upload
        if ($request->hasFile('gambar_promo')) {
            $file = $request->file('gambar_promo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/promo'), $filename);
            $data['gambar_promo'] = $filename;
        }

        // Create the promo
        $promo = Promo::create($data);

        // Handle multiple menus selection (if using multiple_menus rule)
        if ($request->discount_rule === 'multiple_menus' && $request->has('selected_menus')) {
            $promo->menus()->attach($request->selected_menus);
        }

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $promo = Promo::findOrFail($id);
        return view('admin.promo.edit', compact('promo'));
    }

    public function update(Request $request, $id)
    {
        $promo = Promo::findOrFail($id);

        $request->validate([
            'nama_promo'          => 'required|string|max:255',
            'deskripsi_promo'     => 'nullable|string',
            'gambar_promo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'status'              => 'required|boolean',
            'menu_id'             => 'nullable|exists:menu,id',
            'min_quantity'        => 'required|integer|min:1',
            'discount_type'       => 'required|in:fixed,percentage,buy_one_get_one,free_shipping',
            'discount_value'      => 'required|numeric|min:0',
            'is_discount_active'  => 'boolean',
            // Advanced Discount Rules Validation
            'discount_rule'       => 'nullable|in:single_menu,multiple_menus,category_only,price_range,all_items',
            'kategori_id'         => 'nullable|exists:kategori,id',
            'price_min'           => 'nullable|numeric|min:0',
            'price_max'           => 'nullable|numeric|min:0',
            'selected_menus'      => 'nullable|array',
            'selected_menus.*'    => 'exists:menu,id',
            'valid_until'         => 'nullable|date|after:now',
            'max_discount_uses'   => 'nullable|integer|min:1',
            'apply_to_cart_total' => 'boolean',
        ]);

        // Additional validation for percentage discount
        if ($request->discount_type === 'percentage' && $request->discount_value > 100) {
            return back()->withErrors(['discount_value' => 'Persentase diskon tidak boleh lebih dari 100%'])->withInput();
        }

        // Additional validation for price range
        if ($request->price_min && $request->price_max && $request->price_min >= $request->price_max) {
            return back()->withErrors(['price_min' => 'Minimum price must be less than maximum price'])->withInput();
        }

        // Collect all allowed fields
        $data = $request->only([
            'nama_promo', 'deskripsi_promo', 'status', 'menu_id',
            'min_quantity', 'discount_type', 'discount_value', 'is_discount_active',
            // Advanced discount fields
            'kategori_id', 'price_min', 'price_max', 'discount_rule',
            'valid_until', 'max_discount_uses', 'apply_to_cart_total'
        ]);

        // Set default value for discount_rule if not set
        $data['discount_rule'] = $data['discount_rule'] ?? 'all_items';

        // Handle image upload (existing code)
        if ($request->filled('cropped_gambar_promo')) {
            $imageData = $request->input('cropped_gambar_promo');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $imageName = time() . '_promo.png';

            $savePath = public_path('uploads/promo/' . $imageName);

            // Delete old image
            if ($promo->gambar_promo && file_exists(public_path('uploads/promo/' . $promo->gambar_promo))) {
                unlink(public_path('uploads/promo/' . $promo->gambar_promo));
            }

            // Save cropped image
            file_put_contents($savePath, base64_decode($imageData));
            $data['gambar_promo'] = $imageName;
        }
        elseif ($request->hasFile('gambar_promo')) {
            if ($promo->gambar_promo && file_exists(public_path('uploads/promo/' . $promo->gambar_promo))) {
                unlink(public_path('uploads/promo/' . $promo->gambar_promo));
            }

            $file = $request->file('gambar_promo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/promo'), $filename);
            $data['gambar_promo'] = $filename;
        }

        $promo->update($data);

        // Handle multiple menus selection (sync only if using multiple_menus rule)
        if ($request->discount_rule === 'multiple_menus') {
            // First detach all current menus, then attach new ones
            $promo->menus()->detach();

            if ($request->has('selected_menus')) {
                $promo->menus()->attach($request->selected_menus);
            }
        } else {
            // If not using multiple_menus rule, clear relationships
            $promo->menus()->detach();
        }

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil diperbarui!');
    }
    

    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);

        $path = public_path('uploads/promo/' . $promo->gambar);
        if ($promo->gambar_promo && File::exists($path)) {
            File::delete($path);
        }

        // Delete pivot table relationships
        $promo->menus()->detach();

        $promo->delete();

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil dihapus.');
    }

    /**
     * Frontend: Display all active promotions
     */
    public function frontendIndex()
    {
        $promos = Promo::activeDiscounts()
            ->with(['menu', 'kategori', 'menus'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('promotions.index', compact('promos'));
    }

    /**
     * Frontend: Display specific promotion details with applicable menus
     */
    public function frontendShow($id)
    {
        $promo = Promo::activeDiscounts()
            ->with(['menu', 'kategori', 'menus'])
            ->findOrFail($id);

        // Get applicable menus based on discount rule
        $applicableMenus = $this->getApplicableMenus($promo);

        return view('promotions.show', compact('promo', 'applicableMenus'));
    }

    /**
     * Frontend: Add item to cart from promotion
     */
    public function addToCartFromPromo(Request $request, $promoId, $menuId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Verify promo is active and menu is applicable
        $promo = Promo::activeDiscounts()->findOrFail($promoId);

        if (!$this->isMenuApplicable($promo, $menuId)) {
            return back()->with('error', 'Menu tidak berlaku untuk promo ini.');
        }

        // Add to cart using existing cart logic
        $cartController = app(CartController::class);
        $request->merge(['quantity' => $request->quantity]);

        try {
            $cartController->addToCart($request, $menuId);
            return redirect()->route('cart.index')->with('success', 'Item berhasil ditambahkan ke keranjang dengan promo!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan item ke keranjang.');
        }
    }

    /**
     * Get applicable menus for a promo based on its discount rule
     */
    private function getApplicableMenus(Promo $promo)
    {
        switch ($promo->discount_rule) {
            case 'single_menu':
                return $promo->menu ? collect([$promo->menu]) : collect([]);

            case 'multiple_menus':
                return $promo->menus;

            case 'category_only':
                return $promo->kategori ? $promo->kategori->menus : collect([]);

            case 'price_range':
                return Menu::whereBetween('harga', [$promo->price_min, $promo->price_max])->get();

            case 'all_items':
            default:
                return Menu::all();
        }
    }

    /**
     * Check if a menu is applicable for a promo
     */
    private function isMenuApplicable(Promo $promo, $menuId)
    {
        $menu = Menu::find($menuId);
        if (!$menu) return false;

        switch ($promo->discount_rule) {
            case 'single_menu':
                return $promo->menu_id == $menuId;

            case 'multiple_menus':
                return $promo->menus()->where('menu_id', $menuId)->exists();

            case 'category_only':
                return $promo->kategori_id && $menu->kategori_id == $promo->kategori_id;

            case 'price_range':
                return $menu->harga >= $promo->price_min && $menu->harga <= $promo->price_max;

            case 'all_items':
            default:
                return true;
        }
    }


}
