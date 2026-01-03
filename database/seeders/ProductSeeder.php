<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Reset data
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        /*
        |--------------------------------------------------------------------------
        | PRODUK BARANG
        |--------------------------------------------------------------------------
        */
        $produkBarang = [
            [
                'name' => 'Transportable BTS (Combat)',
                'description' => 'Unit Transportable BTS (Combat) untuk kebutuhan jaringan sementara maupun darurat dengan standar industri telekomunikasi.',
                'price' => 250000000,
                'image' => 'assets/images/products/barang/combat.jpg',
            ],
            [
                'name' => 'Tower On Trailer',
                'description' => 'Tower mobile berbasis trailer yang fleksibel untuk deployment cepat di berbagai medan.',
                'price' => 300000000,
                'image' => 'assets/images/products/barang/tower-trailer.jpg',
            ],
            [
                'name' => 'Truck Head / Transporter Combat',
                'description' => 'Kendaraan transporter khusus untuk mobilisasi unit BTS Combat secara aman dan efisien.',
                'price' => 450000000,
                'image' => 'assets/images/products/barang/truck-combat.jpg',
            ],
            [
                'name' => 'Guyed Mast Tower',
                'description' => 'Menara guyed mast dengan sistem penyangga kabel untuk kestabilan dan efisiensi struktur.',
                'price' => 180000000,
                'image' => 'assets/images/products/barang/guyed-mast.jpg',
            ],
            [
                'name' => 'Monopole',
                'description' => 'Tower monopole dengan desain ramping dan estetis untuk area urban.',
                'price' => 220000000,
                'image' => 'assets/images/products/barang/monopole.jpg',
            ],
            [
                'name' => 'Perkuatan Tower SST dan Monopole',
                'description' => 'Solusi perkuatan struktur tower SST dan monopole untuk meningkatkan keamanan dan daya tahan.',
                'price' => 150000000,
                'image' => 'assets/images/products/barang/perkuatan-tower.jpg',
            ],
            [
                'name' => 'Steel Structure Produk',
                'description' => 'Produk struktur baja berkualitas tinggi untuk kebutuhan industri dan infrastruktur.',
                'price' => 120000000,
                'image' => 'assets/images/products/barang/steel-structure.jpg',
            ],
            [
                'name' => 'Sheet Metal Produk',
                'description' => 'Produk sheet metal presisi tinggi untuk berbagai kebutuhan teknis.',
                'price' => 90000000,
                'image' => 'assets/images/products/barang/sheet-metal.jpg',
            ],
            [
                'name' => 'Arsitektur & Furniture',
                'description' => 'Produk arsitektur dan furniture berbahan logam dengan desain modern dan fungsional.',
                'price' => 75000000,
                'image' => 'assets/images/products/barang/arsitektur-furniture.jpg',
            ],
            [
                'name' => 'Work Aid Tools',
                'description' => 'Peralatan pendukung kerja untuk operasional lapangan dan instalasi.',
                'price' => 50000000,
                'image' => 'assets/images/products/barang/work-tools.jpg',
            ],
        ];

        foreach ($produkBarang as $item) {
            Product::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => $item['description'],
                'type' => 'barang',
                'price' => $item['price'],
                'image' => $item['image'],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PRODUK JASA
        |--------------------------------------------------------------------------
        */
        $produkJasa = [
            [
                'name' => 'Service & Maintenance Transportable BTS (Combat)',
                'description' => 'Layanan perawatan dan servis rutin BTS Combat agar tetap optimal dan siap operasional.',
                'price' => 50000000,
                'image' => 'assets/images/products/jasa/service-combat.jpg',
            ],
            [
                'name' => 'Service & Maintenance Guyed Mast Tower',
                'description' => 'Perawatan berkala tower guyed mast untuk menjaga kestabilan dan keamanan struktur.',
                'price' => 40000000,
                'image' => 'assets/images/products/jasa/service-guyed.jpg',
            ],
            [
                'name' => 'Service & Maintenance Truck Head / Transporter Combat',
                'description' => 'Servis kendaraan transporter combat untuk memastikan kelancaran mobilisasi.',
                'price' => 30000000,
                'image' => 'assets/images/products/jasa/service-truck.jpg',
            ],
            [
                'name' => 'Delivery, Instalasi & Dismantel',
                'description' => 'Layanan pengiriman, pemasangan, dan pembongkaran tower dan BTS sesuai standar keselamatan.',
                'price' => 60000000,
                'image' => 'assets/images/products/jasa/instalasi.jpg',
            ],
            [
                'name' => 'Permanenisasi Combat',
                'description' => 'Proses permanenisasi BTS Combat menjadi instalasi jangka panjang.',
                'price' => 80000000,
                'image' => 'assets/images/products/jasa/permanenisasi.jpg',
            ],
            [
                'name' => 'Relokasi Perangkat',
                'description' => 'Layanan pemindahan perangkat telekomunikasi secara aman dan terencana.',
                'price' => 45000000,
                'image' => 'assets/images/products/jasa/relokasi.jpg',
            ],
            [
                'name' => 'Collocation CME',
                'description' => 'Layanan collocation CME untuk optimalisasi penggunaan infrastruktur tower.',
                'price' => 70000000,
                'image' => 'assets/images/products/jasa/collocation.jpg',
            ],
            [
                'name' => 'Desain Engineering',
                'description' => 'Perencanaan dan desain engineering sesuai kebutuhan proyek dan standar teknis.',
                'price' => 55000000,
                'image' => 'assets/images/products/jasa/desain.jpg',
            ],
            [
                'name' => 'Machining',
                'description' => 'Layanan machining presisi tinggi untuk komponen industri dan telekomunikasi.',
                'price' => 65000000,
                'image' => 'assets/images/products/jasa/machining.jpg',
            ],
        ];

        foreach ($produkJasa as $item) {
            Product::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => $item['description'],
                'type' => 'jasa',
                'price' => $item['price'],
                'image' => $item['image'],
            ]);
        }
    }
}
