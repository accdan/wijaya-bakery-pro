<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesanan;
use App\Models\Menu;
use App\Models\Promo;
use Carbon\Carbon;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds for 47 realistic orders
     */
    public function run(): void
    {
        // Get all available menus for ordering
        $menus = Menu::orderBy('kategori_id')->get();
        $menuIds = $menus->pluck('id')->toArray();

        // Customer data - realistic Indonesian names
        $customers = [
            ['name' => 'Ahmad Santoso', 'phone' => '62821123456'],
            ['name' => 'Siti Nurhaliza', 'phone' => '62831123457'],
            ['name' => 'Budi Prabowo', 'phone' => '62841123458'],
            ['name' => 'Dewi Kusuma', 'phone' => '62851123459'],
            ['name' => 'Joko Widodo', 'phone' => '62864123460'],
            ['name' => 'Ani Sutarsih', 'phone' => '62874123461'],
            ['name' => 'Agus Pamungkas', 'phone' => '62883123462'],
            ['name' => 'Maya Sari', 'phone' => '62893123463'],
            ['name' => 'Rudi Hartono', 'phone' => '628132123464'],
            ['name' => 'Intan Permata', 'phone' => '628202123465'],
            ['name' => 'Dani Setiawan', 'phone' => '628212123466'],
            ['name' => 'Linda Kusumawati', 'phone' => '628222123467'],
            ['name' => 'Hadi Susanto', 'phone' => '628232123468'],
            ['name' => 'Rina Amelia', 'phone' => '628242123469'],
            ['name' => 'Yoga Pratama', 'phone' => '628252123470'],
            ['name' => 'Sari Dewi', 'phone' => '628262123471'],
            ['name' => 'Adi Nugroho', 'phone' => '628272123472'],
            ['name' => 'Mega Putri', 'phone' => '628282123473'],
            ['name' => 'Bayu Laksono', 'phone' => '628292123474'],
            ['name' => 'Wulan Sari', 'phone' => '628302123475'],
            ['name' => 'Candra Wijaya', 'phone' => '628312123476'],
            ['name' => 'Neni Rohiati', 'phone' => '628322123477'],
            ['name' => 'Toni Santoso', 'phone' => '628332123478'],
            ['name' => 'Dina Marlina', 'phone' => '628342123479'],
            ['name' => 'Kurniawan Putra', 'phone' => '628352123480'],
            ['name' => 'Santi Lestari', 'phone' => '628362123481'],
            ['name' => 'Roni Firmansyah', 'phone' => '628372123482'],
            ['name' => 'Lina Sulastri', 'phone' => '628382123483'],
            ['name' => 'Warsito Mangun', 'phone' => '628392123484'],
            ['name' => 'Mira Kartika', 'phone' => '628572123485'],
            ['name' => 'Arif Budiman', 'phone' => '628582123486'],
            ['name' => 'Sri Wahyuni', 'phone' => '628592123487'],
            ['name' => 'Eko Prasetyo', 'phone' => '6281456123488'],
            ['name' => 'Rita Amelia', 'phone' => '6281457123489'],
            ['name' => 'Ferdi Gunawan', 'phone' => '6281458123490'],
            ['name' => 'Nova Sari', 'phone' => '6281459123491'],
            ['name' => 'Hendro Wibowo', 'phone' => '6281460123492'],
            ['name' => 'Sinta Prabowo', 'phone' => '6281461123493'],
            ['name' => 'Wisnu Adi', 'phone' => '6281462123494'],
            ['name' => 'Lusi Mayasari', 'phone' => '6281463123495'],
            ['name' => 'Doni Hartono', 'phone' => '6281464123496'],
            ['name' => 'Sri Lestari', 'phone' => '6281465123497'],
            ['name' => 'Bambang Setiawan', 'phone' => '6281466123498'],
            ['name' => 'Yuniarti Sri', 'phone' => '6281467123499'],
            ['name' => 'Putra Nugroho', 'phone' => '6281468123500'],
            ['name' => 'Ayu Damayanti', 'phone' => '6281469123501'],
            ['name' => 'Krisna Putri', 'phone' => '6281470123502'],
            ['name' => 'Anwar Suwono', 'phone' => '6281471123503'],
        ];

        // Generate realistic orders with varied time distribution
        $createdDates = [];

        // Distribution: Recent orders (last 2 weeks) - 20 orders
        for ($i = 0; $i < 20; $i++) {
            $createdDates[] = Carbon::now()->subDays(rand(0, 14));
        }

        // Medium recent (2-4 weeks ago) - 15 orders
        for ($i = 0; $i < 15; $i++) {
            $createdDates[] = Carbon::now()->subDays(rand(15, 28));
        }

        // Older (1-6 months ago) - 12 orders
        for ($i = 0; $i < 12; $i++) {
            $createdDates[] = Carbon::now()->subMonths(rand(1, 6));
        }

        // Shuffle dates for realistic distribution
        shuffle($createdDates);

        // Generate 47 orders
        for ($i = 0; $i < 47; $i++) {
            // Select random customer
            $customer = $customers[array_rand($customers)];

            // Select random menu
            $menu = $menus->random();
            $menuId = $menu->id;

            // Random quantity (1-5, with some bias to smaller quantities)
            $quantity = rand(1, 100) <= 70 ? rand(1, 2) : rand(3, 5);

            // Base price calculation
            $hargaSatuan = $menu->harga;
            $totalHarga = $hargaSatuan * $quantity;

            // Sometimes apply discounts (about 40% of orders)
            $discountAmount = 0;
            $discountType = null;
            $promoId = null;
            $finalPrice = $totalHarga;

            if (rand(1, 100) <= 40) {
                // Get applicable discount for this menu at current time
                $activeDiscounts = Promo::activeDiscounts()->with('menu')->get();

                foreach ($activeDiscounts as $promo) {
                    if ($promo->isApplicable($menuId, $quantity)) {
                        $discountAmount = $promo->calculateDiscount($hargaSatuan, $quantity, $menuId);
                        if ($discountAmount > 0) {
                            $discountType = $promo->discount_type;
                            $promoId = $promo->id;
                            $finalPrice = $totalHarga - $discountAmount;
                            break; // Use first matching discount
                        }
                    }
                }
            }

            // Create order with specific created_at time
            Pesanan::create([
                'nama_pemesan' => $customer['name'],
                'no_hp' => $customer['phone'],
                'menu_id' => $menuId,
                'harga_satuan' => $hargaSatuan,
                'jumlah' => $quantity,
                'total_harga' => $totalHarga,
                'discount_amount' => $discountAmount,
                'discount_type' => $discountType,
                'promo_id' => $promoId,
                'final_price' => $finalPrice,
                'catatan' => $this->getRandomCatatan(),
                'created_at' => $createdDates[$i],
                'updated_at' => $createdDates[$i],
            ]);
        }

        $this->command->info('Generated 47 realistic orders with varied customers, items, and discount applications.');
    }

    /**
     * Get random realistic order notes
     */
    private function getRandomCatatan()
    {
        $catatan = [
            null,
            null,
            null, // Most orders have no notes
            'Dikemas rapi ya',
            'Mohon dikemas dengan hati-hati',
            'Tambah wrapping untuk hadiah',
            'Barangnya sensitif, mohon hati-hati',
            'Mohon dikirim hari ini',
            'Katanya enak banget, pengen coba',
            'Kirim ke alamat kantor',
            'Mohon dikemas tanpa label (surprise)',
            'Pelanggan setia, biasanya pesan setiap minggu',
            'Buat acara kantor, bantuan packaging bagus',
            'Jangan terlalu manis ya',
            'Kirim ke rumah mertua',
            'Sudah dicoba seminggu lalu, suka banget',
            'Mohon info waktu kirim',
            'Granola untuk anak sekolah',
            'Anak saya suka memberikan ke teman-temannya',
            'Coba varian yang baru ya',
            'Seminggu lalu kurang crispy, mohon perhatian',
            'Barangnya bagus pengemasan nya',
            'Sudah rekomendasi dari teman',
            'Mohon cepat ya, butuh hari ini',
            'Kirim ke kampung halaman',
            'Barangnya original ya',
            'Kualitasnya sesuai harga',
        ];

        return $catatan[array_rand($catatan)];
    }
}
