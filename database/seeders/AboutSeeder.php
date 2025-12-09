<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        About::create([
            'vision'  => 'Menjadi layanan Mom & Baby Spa terpercaya di Indonesia.',
            'mission' => 'Memberikan pelayanan terbaik dengan tenaga profesional dan penuh kasih.',
            'goal'    => 'Meningkatkan kesehatan dan kebahagiaan ibu serta bayi secara menyeluruh.',
            'image'   => 'uploads/about/about.jpg',
        ]);
    }
}
