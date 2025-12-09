<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Facades\Schema;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Matikan dulu constraint foreign key sementara
        Schema::disableForeignKeyConstraints();

        Service::truncate();

        // Hidupkan lagi setelah truncate
        Schema::enableForeignKeyConstraints();

        // Isi data contoh
        Service::create([
            'name' => 'Konsultasi Kehamilan',
            'description' => 'Pelayanan konsultasi seputar kehamilan dengan bidan profesional.',
        ]);

        Service::create([
            'name' => 'Pemeriksaan Ibu & Bayi',
            'description' => 'Pemeriksaan rutin untuk ibu hamil dan bayi dengan alat lengkap.',
        ]);
    }
}
