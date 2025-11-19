<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsors = [
            [
                'nama_sponsor' => 'PT. Indofood Sukses Makmur',
                'deskripsi_sponsor' => 'Perusahaan makanan terbesar di Indonesia yang mendukung usaha kecil menengah di bidang kuliner.',
                'logo_sponsor' => 'logo-indofood.jpg',
            ],
            [
                'nama_sponsor' => 'Bank BCA - Branch Malang',
                'deskripsi_sponsor' => 'Bank nasional yang memberikan dukungan finansial kepada UKM lokal dan komunitas wilis.',
                'logo_sponsor' => 'logo-bca.jpg',
            ],
            [
                'nama_sponsor' => 'Aroma Cafe & Resto',
                'deskripsi_sponsor' => 'Cafe dan resto partners yang berkolaborasi dalam event kuliner dan workshop baking.',
                'logo_sponsor' => 'logo-aroma-cafe.jpg',
            ],
            [
                'nama_sponsor' => 'Komunitas Kopi Malang',
                'deskripsi_sponsor' => 'Komunitas pecinta kopi di Malang yang mendukung pengembangan bakery lokal dan variasi menu.',
                'logo_sponsor' => 'logo-kopi-malang.jpg',
            ],
        ];

        foreach ($sponsors as $sponsor) {
            Sponsor::updateOrCreate(
                ['nama_sponsor' => $sponsor['nama_sponsor']],
                $sponsor
            );
        }
    }
}
