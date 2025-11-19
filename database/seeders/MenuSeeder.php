<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $rotiCategory = Kategori::firstOrCreate(
            ['nama_kategori' => 'Roti'],
            ['nama_kategori' => 'Roti']
        );

        $kueCategory = Kategori::firstOrCreate(
            ['nama_kategori' => 'Kue Kering'],
            ['nama_kategori' => 'Kue Kering']
        );

        $basahCategory = Kategori::firstOrCreate(
            ['nama_kategori' => 'Kue Basah'],
            ['nama_kategori' => 'Kue Basah']
        );

        $rotiId = $rotiCategory->id;
        $kueId = $kueCategory->id;
        $basahId = $basahCategory->id;

        $menus = [
            // --- Kue Kering / Toples ---
            [
                'nama_menu' => 'Toples Nastar Premium',
                'harga' => 38000,
                'stok' => 20,
                'deskripsi_menu' => 'Nastar premium dengan isian selai nanas homemade. Harga per-toples ukuran 500gr.',
                'gambar_menu' => 'toples-nastar-premium.jpg',
                'kategori_id' => $kueId,
            ],
            [
                'nama_menu' => 'Toples Sagu Keju Halus',
                'harga' => 35000,
                'stok' => 18,
                'deskripsi_menu' => 'Sagu keju lembut meleleh di mulut. Pembelian per-toples berisi ±45 pcs.',
                'gambar_menu' => 'toples-sagu-keju.jpg',
                'kategori_id' => $kueId,
            ],
            [
                'nama_menu' => 'Toples Kastengel Cheddar',
                'harga' => 40000,
                'stok' => 15,
                'deskripsi_menu' => 'Kastengel dengan keju cheddar premium. Dijual per-toples ukuran 450gr.',
                'gambar_menu' => 'toples-kastengel.jpg',
                'kategori_id' => $kueId,
            ],
            [
                'nama_menu' => 'Toples Putri Salju',
                'harga' => 32000,
                'stok' => 20,
                'deskripsi_menu' => 'Kue putri salju lembut berlapis gula halus. Pembelian per-toples isi ±40 pcs.',
                'gambar_menu' => 'toples-putri-salju.jpg',
                'kategori_id' => $kueId,
            ],
            [
                'nama_menu' => 'Toples Telinga Gajah',
                'harga' => 30000,
                'stok' => 22,
                'deskripsi_menu' => 'Telinga gajah renyah bercorak spiral coklat. Dijual per-toples berat 450gr.',
                'gambar_menu' => 'toples-telinga-gajah.jpg',
                'kategori_id' => $kueId,
            ],
            [
                'nama_menu' => 'Toples Kue Lidah Kucing',
                'harga' => 33000,
                'stok' => 25,
                'deskripsi_menu' => 'Kue lidah kucing tipis renyah. Per-toples berisi ±50 lembar.',
                'gambar_menu' => 'toples-lidah-kucing.jpg',
                'kategori_id' => $kueId,
            ],
            [
                'nama_menu' => 'Toples Cookies Choco Chip',
                'harga' => 28000,
                'stok' => 27,
                'deskripsi_menu' => 'Cookies renyah dengan choco chip melimpah. Pembelian per-toples.',
                'gambar_menu' => 'toples-choco-chip.jpg',
                'kategori_id' => $kueId,
            ],
            [
                'nama_menu' => 'Toples Kue Semprit Susu',
                'harga' => 27000,
                'stok' => 30,
                'deskripsi_menu' => 'Kue semprit susu wangi dan lembut. Dijual per-toples 400gr.',
                'gambar_menu' => 'toples-semprit.jpg',
                'kategori_id' => $kueId,
            ],

            // --- Roti ---
            [
                'nama_menu' => 'Roti Tawar Lembut',
                'harga' => 15000,
                'stok' => 35,
                'deskripsi_menu' => 'Roti tawar lembut cocok untuk sarapan dan sandwich.',
                'gambar_menu' => 'roti-tawar.jpg',
                'kategori_id' => $rotiId,
            ],
            [
                'nama_menu' => 'Roti Coklat Gulung',
                'harga' => 12000,
                'stok' => 40,
                'deskripsi_menu' => 'Roti gulung isi coklat premium, lembut dan manis.',
                'gambar_menu' => 'roti-gulung-coklat.jpg',
                'kategori_id' => $rotiId,
            ],
            [
                'nama_menu' => 'Roti Sisir Original',
                'harga' => 13000,
                'stok' => 30,
                'deskripsi_menu' => 'Roti sisir lembut dengan rasa butter klasik.',
                'gambar_menu' => 'roti-sisir.jpg',
                'kategori_id' => $rotiId,
            ],
            [
                'nama_menu' => 'Roti Bakar Keju Manis',
                'harga' => 10000,
                'stok' => 50,
                'deskripsi_menu' => 'Roti bakar dengan topping keju melted.',
                'gambar_menu' => 'roti-bakar-keju.jpg',
                'kategori_id' => $rotiId,
            ],

            // --- Kue Basah ---
            [
                'nama_menu' => 'Kue Lapis Pelangi',
                'harga' => 8000,
                'stok' => 25,
                'deskripsi_menu' => 'Kue lapis warna-warni dengan tekstur kenyal manis.',
                'gambar_menu' => 'kue-lapis-pelangi.jpg',
                'kategori_id' => $basahId,
            ],
            [
                'nama_menu' => 'Bolu Kukus Mekar',
                'harga' => 7000,
                'stok' => 30,
                'deskripsi_menu' => 'Bolu kukus mekar dengan aroma vanila lembut.',
                'gambar_menu' => 'bolu-kukus.jpg',
                'kategori_id' => $basahId,
            ],
            [
                'nama_menu' => 'Klepon Gula Merah',
                'harga' => 6000,
                'stok' => 35,
                'deskripsi_menu' => 'Klepon berisi gula merah cair dengan taburan kelapa.',
                'gambar_menu' => 'klepon.jpg',
                'kategori_id' => $basahId,
            ],
            [
                'nama_menu' => 'Dadar Gulung Coklat',
                'harga' => 7000,
                'stok' => 28,
                'deskripsi_menu' => 'Dadar gulung isi unti coklat manis.',
                'gambar_menu' => 'dadar-gulung-coklat.jpg',
                'kategori_id' => $basahId,
            ],
        ];

        // Insert menus using updateOrCreate
        foreach ($menus as $item) {
            Menu::updateOrCreate(
                ['nama_menu' => $item['nama_menu']],
                $item
            );
        }
    }
}
