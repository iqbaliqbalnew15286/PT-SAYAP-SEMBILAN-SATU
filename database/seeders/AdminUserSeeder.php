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
            ['email' => 'iqbaliqbalnew15286@gmail.com'],
            [
                'name' => 'Admin Tower',
                'password' => Hash::make('tower123'), // ganti dengan password yang kuat
                'email_verified_at' => now(),
            ]
        );
    }
}
