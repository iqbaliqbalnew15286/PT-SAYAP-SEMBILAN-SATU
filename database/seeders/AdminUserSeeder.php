<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan admin tidak dobel
        User::updateOrCreate(
            ['email' => 'admin@bidanfina.test'],
            [
                'name' => 'Admin BidanFina',
                'password' => Hash::make('password123'), // ganti dengan password yang kuat
                'email_verified_at' => now(),
            ]
        );
    }
}
