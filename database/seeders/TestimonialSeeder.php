<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Testimonial::truncate();

        \App\Models\Testimonial::create([
            'name' => 'Siti Aminah',
            'message' => 'Pelayanan di Bidan Fina sangat ramah dan profesional!',
            'image' => 'uploads/testimonials/siti.jpg',
        ]);

        \App\Models\Testimonial::create([
            'name' => 'Rina Putri',
            'message' => 'Terima kasih Bidan Fina sudah membantu persalinan saya dengan nyaman.',
            'image' => 'uploads/testimonials/rina.jpg',
        ]);
    }
}
