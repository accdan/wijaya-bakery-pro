<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promo;
use App\Models\Menu;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some menu items and categories for enhanced promos
        $nastarMenu = Menu::where('nama_menu', 'Toples Nastar Premium')->first();
        $kastengelMenu = Menu::where('nama_menu', 'Toples Kastengel Cheddar')->first();

        $rotiCategory = \App\Models\Kategori::where('nama_kategori', 'Roti')->first();
        $keringCategory = \App\Models\Kategori::where('nama_kategori', 'Kue Kering')->first();

        $promos = [
            // 🔥 **ENHANCED DISCOUNT TYPES - Special for the upgraded system**
            // 1. Single menu discount (backward compatibility)
            [
                'nama_promo' => 'Buy 5 Get 10% Off Nastar',
                'deskripsi_promo' => 'Diskon 10% untuk pembelian toples nastar minimal 5 pcs. Promo terbatas!',
                'gambar_promo' => 'promo-nastar.jpg',
                'status' => true,
                'menu_id' => $nastarMenu ? $nastarMenu->id : null,
                'kategori_id' => null,
                'min_quantity' => 5,
                'discount_type' => 'percentage',
                'discount_value' => 10.00,
                'is_discount_active' => true,
                'price_min' => null,
                'price_max' => null,
                'discount_rule' => 'single_menu',
                'max_discount_uses' => 100,
                'valid_until' => now()->addDays(30),
                'apply_to_cart_total' => false,
            ],

            // 2. Multiple menus discount (using pivot table)
            [
                'nama_promo' => 'Premium Cookies Package: Mix & Save 20%',
                'deskripsi_promo' => 'Paket premium untuk nastar dan kastengel dengan diskon hingga 20%. Perfect untuk gift!',
                'gambar_promo' => 'promo-premium-cookies.jpg',
                'status' => true,
                'menu_id' => null, // Will use pivot table
                'kategori_id' => null,
                'min_quantity' => 8, // Combined quantity
                'discount_type' => 'percentage',
                'discount_value' => 20.00,
                'is_discount_active' => true,
                'price_min' => null,
                'price_max' => null,
                'discount_rule' => 'multiple_menus',
                'max_discount_uses' => 50,
                'valid_until' => now()->addDays(45),
                'apply_to_cart_total' => false,
                // Associated menus will be linked via pivot table
                'associated_menus' => $nastarMenu && $kastengelMenu ? [$nastarMenu->id, $kastengelMenu->id] : [],
            ],

            // 3. Category-based discount (all items in category)
            [
                'nama_promo' => 'Weekend Special: All Roti Diskon 15%',
                'deskripsi_promo' => 'Diskon 15% untuk semua jenis roti setiap weekend. Minimal pembelian 2 pcs.',
                'gambar_promo' => 'promo-roti-weekend.jpg',
                'status' => true,
                'menu_id' => null,
                'kategori_id' => $rotiCategory ? $rotiCategory->id : null,
                'min_quantity' => 2,
                'discount_type' => 'percentage',
                'discount_value' => 15.00,
                'is_discount_active' => true,
                'price_min' => null,
                'price_max' => null,
                'discount_rule' => 'category_only',
                'max_discount_uses' => null, // Unlimited
                'valid_until' => now()->addDays(60),
                'apply_to_cart_total' => false,
            ],

            // 4. Price range discount (items within price range)
            [
                'nama_promo' => 'Budget Friendly: Mid-Range Items 12% Off',
                'deskripsi_promo' => 'Diskon 12% untuk semua item dengan harga Rp 20.000 - Rp 35.000. Perfect untuk jatah mingguan!',
                'gambar_promo' => 'promo-budget-friendly.jpg',
                'status' => true,
                'menu_id' => null,
                'kategori_id' => null,
                'min_quantity' => 3,
                'discount_type' => 'percentage',
                'discount_value' => 12.00,
                'is_discount_active' => true,
                'price_min' => 20000.00,
                'price_max' => 35000.00,
                'discount_rule' => 'price_range',
                'max_discount_uses' => 75,
                'valid_until' => now()->addDays(21),
                'apply_to_cart_total' => false,
            ],

            // 5. Free shipping promotion
            [
                'nama_promo' => 'Free Shipping: Order Above Rp 150K',
                'deskripsi_promo' => 'Gratis ongkir untuk pembelian minimal Rp 150.000. Promo berlaku area Malang Raya.',
                'gambar_promo' => 'promo-free-shipping.jpg',
                'status' => true,
                'menu_id' => null,
                'kategori_id' => null,
                'min_quantity' => 1,
                'discount_type' => 'free_shipping',
                'discount_value' => 0.00, // No cost discount
                'is_discount_active' => true,
                'price_min' => 150000.00,
                'price_max' => null,
                'discount_rule' => 'all_items',
                'max_discount_uses' => 200,
                'valid_until' => now()->addDays(14),
                'apply_to_cart_total' => true, // Applied to cart total
            ],

            // 6. Buy one get one (BOGO) promotion
            [
                'nama_promo' => 'Buy One Get One: Kue Basah',
                'deskripsi_promo' => 'Buy 1 kue basah, dapat 1 lagi gratis! Promo spesial hari raya.',
                'gambar_promo' => 'promo-bogo.jpg',
                'status' => true,
                'menu_id' => null,
                'kategori_id' => \App\Models\Kategori::where('nama_kategori', 'Kue Basah')->first()?->id,
                'min_quantity' => 2,
                'discount_type' => 'buy_one_get_one',
                'discount_value' => 0.00,
                'is_discount_active' => true,
                'price_min' => null,
                'price_max' => 20000.00, // Only for items under 20k
                'discount_rule' => 'category_only',
                'max_discount_uses' => 25,
                'valid_until' => now()->addDays(7), // Very limited time
                'apply_to_cart_total' => false,
            ],
        ];

        foreach ($promos as $promoData) {
            $associatedMenus = $promoData['associated_menus'] ?? [];
            unset($promoData['associated_menus']);

            $promo = Promo::updateOrCreate(
                ['nama_promo' => $promoData['nama_promo']],
                $promoData
            );

            // Attach associated menus for multiple_menus rule
            if (!empty($associatedMenus)) {
                $promo->menus()->sync($associatedMenus);
            }
        }
    }
}
