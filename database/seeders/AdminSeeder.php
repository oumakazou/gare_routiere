<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the specific admin account requested
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'nom' => 'Admin User',
                'mot_de_passe' => Hash::make('password'), // Use mot_de_passe
                'role' => 'admin',
                'is_admin' => true,
            ]
        );

        // Ensure other test users have a 'user' role
        User::updateOrCreate(
            ['email' => 'client@example.com'],
            [
                'nom' => 'Client User',
                'mot_de_passe' => Hash::make('password'), // Use mot_de_passe
                'role' => 'user',
            ]
        );

        User::updateOrCreate(
            ['email' => 'jean@example.com'],
            [
                'nom' => 'Jean User',
                'mot_de_passe' => Hash::make('password'), // Use mot_de_passe
                'role' => 'user',
            ]
        );
    }
}