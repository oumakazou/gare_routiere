<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminSeeder::class); // Call the new AdminSeeder
        // The existing VoyageSeeder call
        $this->call([
            VoyageSeeder::class,
        ]);
    }
}
