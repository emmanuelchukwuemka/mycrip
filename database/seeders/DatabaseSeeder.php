<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@mycrib.africa',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // Agents
        User::factory(5)->create([
            'role' => 'agent',
            'password' => Hash::make('password'),
        ]);

        // Regular Users
        User::factory(5)->create([
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);

        // Specific Test Agent
        User::create([
            'name' => 'Sarah Connor',
            'email' => 'sarah@mycrib.africa',
            'role' => 'agent',
            'password' => Hash::make('password'),
        ]);
    }
}
