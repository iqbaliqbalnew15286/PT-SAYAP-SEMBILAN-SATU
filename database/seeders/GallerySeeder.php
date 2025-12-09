<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Gallery::truncate();

        \App\Models\Gallery::create([
            'title' => 'Suasana Klinik',
            'description' => 'Ruang tunggu bersih dan nyaman untuk pasien.',
            'image' => 'uploads/gallery/room.jpg',
        ]);

        \App\Models\Gallery::create([
            'title' => 'Tim Bidan Fina',
            'description' => 'Tim profesional dan berpengalaman di bidang kebidanan.',
            'image' => 'uploads/gallery/team.jpg',
        ]);
    }
}
