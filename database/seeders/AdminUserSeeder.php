<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@villaafrica.com'],
            [
                'name' => 'Villa Africa Admin',
                'email' => 'admin@villaafrica.com',
                'password' => Hash::make('Admin@2026'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
