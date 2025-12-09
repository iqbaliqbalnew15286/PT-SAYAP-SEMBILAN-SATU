<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            AboutSeeder::class,
            ProductSeeder::class,
            ServiceSeeder::class,
            GallerySeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}
