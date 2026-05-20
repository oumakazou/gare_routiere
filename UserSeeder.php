<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or Update the Admin account
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Taza',
                'password' => Hash::make('password'), // Always hash passwords
                'is_admin' => true,
            ]
        );

        // Create a test client account
        User::updateOrCreate(
            ['email' => 'client@example.com'],
            [
                'name' => 'Client Test',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );
    }
}