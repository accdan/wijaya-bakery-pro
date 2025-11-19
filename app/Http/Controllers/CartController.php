<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('menu')->where('user_id', Auth::user()->id)->get();
        return view('cart.index', compact('carts'));
    }

    public function addToCart(Request $request, $menuId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        try {
            $menu = Menu::findOrFail($menuId);

            // Check stock
            $existingCart = Cart::where('user_id', Auth::user()->id)->where('menu_id', $menuId)->first();

            if ($existingCart) {
                $newQuantity = $existingCart->quantity + $request->quantity;
                if ($newQuantity > $menu->stok) {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Jumlah total melebihi stok yang tersedia. Stok tersedia: ' . $menu->stok
                        ], 400);
                    }
                    return back()->with('error', 'Jumlah total melebihi stok yang tersedia');
                }
                $existingCart->update(['quantity' => $newQuantity]);
            } else {
                if ($request->quantity > $menu->stok) {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Jumlah melebihi stok yang tersedia. Stok tersedia: ' . $menu->stok
                        ], 400);
                    }
                    return back()->with('error', 'Jumlah melebihi stok yang tersedia');
                }
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'menu_id' => $menuId,
                    'quantity' => $request->quantity
                ]);
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item berhasil ditambahkan ke keranjang!'
                ]);
            }

            return back()->with('success', 'Menu berhasil ditambahkan ke keranjang');

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menambahkan ke keranjang'
                ], 500);
            }
            return back()->with('error', 'Terjadi kesalahan sistem');
        }
    }

    public function updateCart(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('id', $cartId)->where('user_id', Auth::user()->id)->firstOrFail();

        if ($request->quantity > $cart->menu->stok) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia');
        }

        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Jumlah berhasil diperbarui');
    }

    public function removeFromCart($cartId)
    {
        $cart = Cart::where('id', $cartId)->where('user_id', Auth::user()->id)->firstOrFail();
        $cart->delete();

        return back()->with('success', 'Menu berhasil dihapus dari keranjang');
    }

    public function removeMultipleFromCart(Request $request)
    {
        $request->validate([
            'cart_ids' => 'required|array|min:1',
            'cart_ids.*' => 'required|integer|exists:carts,id'
        ]);

        $cartIds = $request->cart_ids;
        $userId = Auth::user()->id;

        // Verify all carts belong to current user for security
        $cartsToDelete = Cart::where('user_id', $userId)
            ->whereIn('id', $cartIds)
            ->get();

        if ($cartsToDelete->isEmpty()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item keranjang tidak ditemukan'
                ], 404);
            }
            return back()->with('error', 'Item keranjang tidak ditemukan');
        }

        // Perform bulk deletion
        Cart::where('user_id', $userId)->whereIn('id', $cartIds)->delete();

        $deletedCount = $cartsToDelete->count();
        $message = $deletedCount > 1
            ? "{$deletedCount} item berhasil dihapus dari keranjang"
            : "Item berhasil dihapus dari keranjang";

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'deleted_count' => $deletedCount
            ]);
        }

        return back()->with('success', $message);
    }



    public function checkout(Request $request)
    {
        $request->validate([
            'catatan_pesanan' => 'nullable|string|max:500',
            'selected_items' => 'required|string'
        ]);

        // Get selected cart items only
        $selectedItemIds = array_filter(explode(',', $request->selected_items));
        if (empty($selectedItemIds)) {
            return redirect()->route('cart.index')->with('error', 'Pilih setidaknya satu item untuk checkout');
        }

        $carts = Cart::with('menu')
            ->where('user_id', Auth::user()->id)
            ->whereIn('id', $selectedItemIds)
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Item yang dipilih tidak valid');
        }

        // Check stock for all items and calculate discounts
        $totalPrice = 0;
        $totalDiscount = 0;
        $appliedDiscounts = [];
        $errors = [];

        // Get active discounts
        $activeDiscounts = \App\Models\Promo::activeDiscounts()->with('menu')->get();

        // Enhanced time-based greeting with improved logic
        $greeting = $this->getTimeBasedGreeting();

        // Build user address information
        $user = Auth::user();
        $addressInfo = "";
        if ($user->province || $user->regency || $user->street || $user->hamlet) {
            $addressInfo .= "*ALAMAT PEMBELI:*\n";
            if ($user->province) $addressInfo .= "- Prov. {$user->province}\n";
            if ($user->regency) $addressInfo .= "- Kab./Kota {$user->regency}\n";
            if ($user->street) $addressInfo .= "- Jl. {$user->street}\n";
            if ($user->hamlet) $addressInfo .= "- Dusun/Kp. {$user->hamlet}\n";
            if ($user->address_notes) {
                $addressInfo .= "*Catatan Alamat:* {$user->address_notes}\n";
            }
            $addressInfo .= "\n";
        }

        // Build WhatsApp message
        $waMessage = "{$greeting}\n\n";
        $waMessage .= "Saya *{$user->name}* ingin memesan roti dari Wijaya Bakery\n\n";

        $waMessage .= "*INFORMASI PEMBELI:*\n";
        $waMessage .= "👤 Nama: {$user->name}\n";
        $waMessage .= "📱 No. HP: {$user->no_telepon}\n";
        $waMessage .= "📧 Email: {$user->email}\n\n";

        if (!empty($addressInfo)) {
            $waMessage .= $addressInfo;
        }

        $waMessage .= "*DETAIL PESANAN:*\n";

        $index = 1;
        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->menu->stok) {
                $errors[] = "Stok {$cart->menu->nama_menu} tidak mencukupi";
            }

            $subtotal = $cart->quantity * $cart->menu->harga;
            $itemDiscount = 0;

            // Check for applicable discounts
            foreach ($activeDiscounts as $discount) {
                if ($discount->isApplicable($cart->menu->id, $cart->quantity)) {
                    $itemDiscount = $discount->calculateDiscount($cart->menu->harga, $cart->quantity, $cart->menu->id);
                    if ($itemDiscount > 0) {
                        $appliedDiscounts[] = [
                            'menu' => $cart->menu->nama_menu,
                            'discount' => $discount->getDiscountDescription(),
                            'amount' => $itemDiscount
                        ];
                        break; // Apply first matching discount only
                    }
                }
            }

            $finalSubtotal = $subtotal - $itemDiscount;
            $totalPrice += $finalSubtotal;
            $totalDiscount += $itemDiscount;

            $waMessage .= $index . ". " . $cart->menu->nama_menu . "\n";
            $waMessage .= "   Jumlah: " . $cart->quantity . " x Rp " . number_format($cart->menu->harga, 0, ',', '.') . "\n";
            if ($itemDiscount > 0) {
                $waMessage .= "   Subtotal: Rp " . number_format($subtotal, 0, ',', '.') . "\n";
                $waMessage .= "   Diskon: Rp " . number_format($itemDiscount, 0, ',', '.') . "\n";
                $waMessage .= "   Total: Rp " . number_format($finalSubtotal, 0, ',', '.') . "\n\n";
            } else {
                $waMessage .= "   Subtotal: Rp " . number_format($subtotal, 0, ',', '.') . "\n\n";
            }
            $index++;
        }

        // Add discount summary to WhatsApp message
        if ($totalDiscount > 0) {
            $waMessage .= "*DISKON YANG DIDAPATKAN:*\n";
            foreach ($appliedDiscounts as $discount) {
                $waMessage .= "- {$discount['discount']} pada {$discount['menu']}\n";
            }
            $waMessage .= "\n*Total Diskon: Rp " . number_format($totalDiscount, 0, ',', '.') . "*\n\n";
        }

        if (!empty($errors)) {
            // Stock exceeds, redirect to WhatsApp with current order
            $waMessage .= "*PERHATIAN: Beberapa item melebihi stok yang tersedia*\n";
            $waMessage .= "*Silakan konfirmasi stok dengan penjual*\n\n";
            $waMessage .= "*Total Estimasi: Rp " . number_format($totalPrice, 0, ',', '.') . "*";

            $waNumber = '6285853849466';
            $waUrl = "https://wa.me/{$waNumber}?text=" . urlencode($waMessage);

            // Clear cart
            Cart::where('user_id', Auth::user()->id)->delete();

            return redirect($waUrl);
        }

        // Process order - decrease stock and save to pesanan with discount details
        DB::transaction(function () use ($carts, $activeDiscounts) {
            foreach ($carts as $cart) {
                // Base order data
                $orderData = [
                    'nama_pemesan' => Auth::user()->name,
                    'no_hp' => Auth::user()->no_telepon,
                    'menu_id' => $cart->menu_id,
                    'harga_satuan' => $cart->menu->harga,
                    'jumlah' => $cart->quantity,
                    'total_harga' => $cart->quantity * $cart->menu->harga,
                    'discount_amount' => 0,
                    'discount_type' => null,
                    'promo_id' => null,
                    'final_price' => $cart->quantity * $cart->menu->harga,
                ];

                // Check for applicable discounts
                foreach ($activeDiscounts as $discount) {
                    if ($discount->isApplicable($cart->menu->id, $cart->quantity)) {
                        $itemDiscount = $discount->calculateDiscount($cart->menu->harga, $cart->quantity, $cart->menu->id);
                        if ($itemDiscount > $orderData['discount_amount']) {
                            $orderData['discount_amount'] = $itemDiscount;
                            $orderData['discount_type'] = $discount->discount_type;
                            $orderData['promo_id'] = $discount->id;
                            $orderData['final_price'] = $orderData['total_harga'] - $itemDiscount;
                        }
                    }
                }

                \App\Models\Pesanan::create($orderData);

                // Decrease stock
                $cart->menu->decrement('stok', $cart->quantity);
            }

            // Clear cart
            Cart::where('user_id', Auth::user()->id)->delete();
        });

        // Add order summary to WhatsApp message
        $subTotalMessage = $totalPrice + $totalDiscount;
        $waMessage .= "\n*RINGKASAN PEMBELIAN:*\n";
        $waMessage .= "Subtotal (sebelum diskon): Rp " . number_format($subTotalMessage, 0, ',', '.') . "\n";

        if ($totalDiscount > 0) {
            $waMessage .= "Potongan Diskon: -Rp " . number_format($totalDiscount, 0, ',', '.') . "\n";
            $waMessage .= "*Total Pembayaran: Rp " . number_format($totalPrice, 0, ',', '.') . "*\n\n";
        } else {
            $waMessage .= "*Total Pembayaran: Rp " . number_format($totalPrice, 0, ',', '.') . "*\n\n";
        }

        // Add user notes if provided
        if (!empty($request->catatan_pesanan)) {
            $waMessage .= "*CATATAN PEMBELI:*\n" . $request->catatan_pesanan . "\n\n";
        }

        $waNumber = '6285853849466';
        $waUrl = "https://wa.me/{$waNumber}?text=" . urlencode($waMessage);

        return redirect($waUrl);
    }

    /**
     * Generate time-based greeting in Indonesian
     */
    private function getTimeBasedGreeting()
    {
        $currentHour = now()->hour; // Uses Carbon now() with proper timezone support

        // More precise time ranges for Indonesian cultural norms
        if ($currentHour >= 4 && $currentHour < 11) {
            // Morning: 04:00 - 10:59
            return "Selamat Pagi 🌅";
        } elseif ($currentHour >= 11 && $currentHour < 15) {
            // Noon: 11:00 - 14:59
            return "Selamat Siang ☀️";
        } elseif ($currentHour >= 15 && $currentHour < 18) {
            // Afternoon/Early Evening: 15:00 - 17:59
            return "Selamat Sore 🌇";
        } elseif ($currentHour >= 0 && $currentHour < 4) {
            // Late night: 00:00 - 03:59 (after midnight)
            return "Selamat Malam 🌙";
        } else {
            // Evening/Late night: 18:00 - 23:59
            return "Selamat Malam 🌙";
        }
    }
}
