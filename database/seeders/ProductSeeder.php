<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate(); // biar tidak double data
        Product::create([
            'name' => 'Sabun Bayi Organik',
            'description' => 'Sabun alami lembut untuk kulit bayi, tanpa bahan kimia berbahaya.',
            'price' => 25000,
            'image' => 'uploads/products/sample1.jpg',
        ]);

        Product::create([
            'name' => 'Minyak Telon Hangat',
            'description' => 'Minyak telon dengan aroma lembut dan menenangkan.',
            'price' => 32000,
            'image' => 'uploads/products/sample2.jpg',
        ]);
    }
}
