<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('facilities')->truncate();

        DB::table('facilities')->insert([

            /*
            |--------------------------------------------------------------------------
            | PERALATAN PABRIKASI
            |--------------------------------------------------------------------------
            */
            [
                'name' => 'Mesin Plasma Cutting',
                'description' => 'Mesin pemotong baja presisi tinggi menggunakan teknologi plasma untuk kebutuhan fabrikasi struktur.',
                'image' => 'assets/images/facilities/pabrikasi/plasma-cutting.jpg',
                'type' => 'Peralatan Pabrikasi',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mesin Bending',
                'description' => 'Mesin pembengkok plat baja untuk membentuk komponen struktur sesuai desain.',
                'image' => 'assets/images/facilities/pabrikasi/mesin-bending.jpg',
                'type' => 'Peralatan Pabrikasi',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mesin Las CO 3 Phase',
                'description' => 'Mesin las industri 3 phase untuk penyambungan struktur baja skala besar.',
                'image' => 'assets/images/facilities/pabrikasi/mesin-las.jpg',
                'type' => 'Peralatan Pabrikasi',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mesin Grinding',
                'description' => 'Mesin penghalus dan perapih hasil las serta permukaan material baja.',
                'image' => 'assets/images/facilities/pabrikasi/mesin-grinding.jpg',
                'type' => 'Peralatan Pabrikasi',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mesin Cutting Circle',
                'description' => 'Mesin pemotong material berbentuk lingkaran untuk kebutuhan fabrikasi presisi.',
                'image' => 'assets/images/facilities/pabrikasi/cutting-circle.jpg',
                'type' => 'Peralatan Pabrikasi',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mesin Kompresor',
                'description' => 'Penyedia tekanan udara untuk mendukung operasional peralatan pabrikasi.',
                'image' => 'assets/images/facilities/pabrikasi/kompresor.jpg',
                'type' => 'Peralatan Pabrikasi',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Mesin Drilling Magnet',
                'description' => 'Mesin bor magnetik untuk pengeboran material baja dengan tingkat akurasi tinggi.',
                'image' => 'assets/images/facilities/pabrikasi/drilling-magnet.jpg',
                'type' => 'Peralatan Pabrikasi',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tools Kit Pabrikasi',
                'description' => 'Perlengkapan tools lengkap untuk mendukung pekerjaan fabrikasi dan produksi.',
                'image' => 'assets/images/facilities/pabrikasi/tools-kit.jpg',
                'type' => 'Peralatan Pabrikasi',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | PERALATAN MAINTENANCE
            |--------------------------------------------------------------------------
            */
            [
                'name' => 'Tension Meter',
                'description' => 'Alat ukur ketegangan kabel untuk pekerjaan maintenance tower dan struktur.',
                'image' => 'assets/images/facilities/maintenance/tension-meter.jpg',
                'type' => 'Peralatan Maintenance',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ampere Pliers',
                'description' => 'Alat ukur arus listrik untuk pengecekan sistem kelistrikan di lapangan.',
                'image' => 'assets/images/facilities/maintenance/ampere-pliers.jpg',
                'type' => 'Peralatan Maintenance',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Grounding Tester',
                'description' => 'Alat penguji sistem grounding untuk memastikan keamanan instalasi listrik.',
                'image' => 'assets/images/facilities/maintenance/grounding-tester.jpg',
                'type' => 'Peralatan Maintenance',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Theodolite',
                'description' => 'Alat ukur sudut dan elevasi untuk pekerjaan survey dan instalasi tower.',
                'image' => 'assets/images/facilities/maintenance/theodolite.jpg',
                'type' => 'Peralatan Maintenance',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Vernier Caliper',
                'description' => 'Alat ukur presisi untuk pengukuran dimensi komponen teknik.',
                'image' => 'assets/images/facilities/maintenance/vernier-caliper.jpg',
                'type' => 'Peralatan Maintenance',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tools Kit Maintenance',
                'description' => 'Perlengkapan tools lapangan untuk pekerjaan perawatan dan perbaikan.',
                'image' => 'assets/images/facilities/maintenance/tools-kit.jpg',
                'type' => 'Peralatan Maintenance',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | KENDARAAN OPERASIONAL
            |--------------------------------------------------------------------------
            */
            [
                'name' => 'Head Truck',
                'description' => 'Kendaraan operasional utama untuk pengangkutan material dan peralatan proyek.',
                'image' => 'assets/images/facilities/kendaraan/head-truck.jpg',
                'type' => 'Kendaraan Operasional',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pick Up',
                'description' => 'Kendaraan pick up untuk mobilisasi cepat peralatan dan tim lapangan.',
                'image' => 'assets/images/facilities/kendaraan/pickup.jpg',
                'type' => 'Kendaraan Operasional',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Minibus',
                'description' => 'Kendaraan minibus untuk transportasi personel operasional dan teknisi.',
                'image' => 'assets/images/facilities/kendaraan/minibus.jpg',
                'type' => 'Kendaraan Operasional',
                'publisher' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
