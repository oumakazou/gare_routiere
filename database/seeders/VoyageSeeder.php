<?php

namespace Database\Seeders;

use App\Models\TransportCompany;
use App\Models\Voyage;
use Illuminate\Database\Seeder;

class VoyageSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake('fr_FR');

        $cities = [
            'Fes',
            'Rabat',
            'Casablanca',
            'Meknes',
            'Oujda',
            'Nador',
            'Al Hoceima',
            'Tanger',
            'Marrakech',
            'Agadir',
            'Kenitra',
            'Tetouan',
        ];

        $companies = [
            'Etoile du Nord',
            'CTM',
            'Supratours',
            'Ghaza Transport',
            'Trans Atlas',
        ];

        foreach ($companies as $companyName) {
            TransportCompany::firstOrCreate(['name' => $companyName], ['is_active' => true]);
        }

        $companyIds = TransportCompany::pluck('id')->all();

        for ($i = 0; $i < 60; $i++) {
            $travelDate = now()->addDays(rand(0, 9))->toDateString();
            $tickets = $faker->numberBetween(5, 50);
            $ttc = $faker->numberBetween(80, 300);
            Voyage::create([
                'transport_company_id' => $faker->randomElement($companyIds),
                'line_name' => $faker->randomElement($cities) . ' - ' . $faker->randomElement($cities),
                'destination' => $faker->randomElement($cities),
                'travel_date' => $travelDate,
                'departure_time' => sprintf('%02d:%02d', rand(5, 23), rand(0, 1) ? 0 : 30),
                'tickets' => $tickets,
                'total_ttc' => $ttc,
                'observations' => $faker->optional()->sentence(),
                'is_blocked' => $faker->boolean(10),
                'blocked_by' => $faker->optional(0.2)->name(),
                'created_by_name' => 'CP',
                'ville_depart' => 'Taza',
                'ville_arrivee' => $faker->randomElement($cities),
                'date_voyage' => $travelDate,
                'prix' => $ttc,
                'places_disponibles' => $tickets,
            ]);
        }
    }
}
