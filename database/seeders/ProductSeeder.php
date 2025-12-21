<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate(); // biar tidak double data
        Product::create([
            'name' => 'Sabun Bayi Organik',
            'slug' => Str::slug('Sabun Bayi Organik'),
            'description' => 'Sabun alami lembut untuk kulit bayi, tanpa bahan kimia berbahaya.',
            'type' => 'barang',
            'price' => 25000,
            'image' => 'uploads/products/sample1.jpg',
        ]);

        Product::create([
            'name' => 'Minyak Telon Hangat',
            'slug' => Str::slug('Minyak Telon Hangat'),
            'description' => 'Minyak telon dengan aroma lembut dan menenangkan.',
            'type' => 'barang',
            'price' => 32000,
            'image' => 'uploads/products/sample2.jpg',
        ]);

        // Services (Jasa)
        Product::create([
            'name' => 'Konsultasi Kehamilan',
            'slug' => Str::slug('Konsultasi Kehamilan'),
            'description' => 'Layanan konsultasi kesehatan ibu hamil oleh ahli spesialis.',
            'type' => 'jasa',
            'price' => 150000,
            'image' => 'uploads/services/consultation1.jpg',
        ]);

        Product::create([
            'name' => 'Pijat Bayi',
            'slug' => Str::slug('Pijat Bayi'),
            'description' => 'Layanan pijat bayi untuk meningkatkan kesehatan dan kenyamanan.',
            'type' => 'jasa',
            'price' => 75000,
            'image' => 'uploads/services/massage1.jpg',
        ]);
    }
}
