<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('partners')->truncate();

        $towerProviders = [
            [
                'name' => 'PT. Daya Mitra Telekomunikasi',
                'city' => 'Jakarta',
                'logo' => 'assets/partners/daya-mitra-telekomunikasi.png',
            ],
            [
                'name' => 'PT. Infraco Daya Mitra',
                'city' => 'Jakarta',
                'logo' => 'assets/partners/infraco-daya-mitra.png',
            ],
            [
                'name' => 'PT. Koperasi Jasa Daya Mitra',
                'city' => 'Jakarta',
                'logo' => 'assets/partners/koperasi-jasa-daya-mitra.png',
            ],
            [
                'name' => 'PT. Persada Sokka Tama',
                'city' => 'Jakarta',
                'logo' => 'assets/partners/persada-sokka-tama.png',
            ],
            [
                'name' => 'PT. Solusi Tunas Pratama Tbk',
                'city' => 'Jakarta',
                'logo' => 'assets/partners/solusi-tunas-pratama.png',
            ],
            [
                'name' => 'PT. Tower Bersama Infrastructure Tbk',
                'city' => 'Jakarta',
                'logo' => 'assets/partners/tower-bersama.png',
            ],
        ];

        $nonTowerProviders = [
            [
                'name' => 'PT. Akurasi Konstruksi Indonesia',
                'city' => 'Bogor',
                'logo' => 'assets/partners/akurasi-konstruksi.png',
            ],
            [
                'name' => 'CV. Cahaya Abadi Teknik',
                'city' => 'Bogor',
                'logo' => 'assets/partners/cahaya-abadi-teknik.png',
            ],
            [
                'name' => 'PT. Duta Solusi Metalindo',
                'city' => 'Jakarta',
                'logo' => 'assets/partners/duta-solusi-metalindo.png',
            ],
            [
                'name' => 'PT. Dwi Pari Abadi',
                'city' => 'Jakarta',
                'logo' => 'assets/partners/dwi-pari-abadi.png',
            ],
            [
                'name' => 'CV. Raja Ardana Interior',
                'city' => 'Bogor',
                'logo' => 'assets/partners/raja-ardana-interior.png',
            ],
            [
                'name' => 'PT. Sayap Sembilan Satu',
                'city' => 'Bogor',
                'logo' => 'assets/partners/sayap-sembilan-satu.png',
            ],
            [
                'name' => 'PT. Surya Anugerah Enjinering',
                'city' => 'Jakarta',
                'logo' => 'assets/partners/surya-anugerah-enjinering.png',
            ],
            [
                'name' => 'PT. Quadran Empat Persada',
                'city' => 'Jakarta',
                'logo' => 'assets/partners/quadran-empat-persada.png',
            ],
        ];

        $partners = [];

        foreach ($towerProviders as $item) {
            $partners[] = [
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => 'Perusahaan penyedia infrastruktur tower telekomunikasi yang mendukung jaringan komunikasi nasional.',
                'logo' => $item['logo'],
                'sector' => 'Tower Provider',
                'city' => $item['city'],
                'company_contact' => '',
                'publisher' => 'Admin',
                'partnership_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        foreach ($nonTowerProviders as $item) {
            $partners[] = [
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => 'Perusahaan pendukung non tower yang bergerak di bidang konstruksi, engineering, dan penyedia solusi industri.',
                'logo' => $item['logo'],
                'sector' => 'Non Tower Provider',
                'city' => $item['city'],
                'company_contact' => '',
                'publisher' => 'Admin',
                'partnership_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('partners')->insert($partners);
    }
}
