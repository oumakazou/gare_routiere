<?php

namespace Database\Seeders;

use App\Models\Trajet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrajetSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $trajets = [
            [
                'ville_depart' => 'Fès',
                'ville_arrivee' => 'Rabat',
                'heure_depart' => '08:00',
                'heure_arrivee' => '10:30',
                'prix' => 50.00,
            ],
            [
                'ville_depart' => 'Rabat',
                'ville_arrivee' => 'Casablanca',
                'heure_depart' => '09:00',
                'heure_arrivee' => '10:30',
                'prix' => 30.00,
            ],
            [
                'ville_depart' => 'Casablanca',
                'ville_arrivee' => 'Marrakech',
                'heure_depart' => '14:00',
                'heure_arrivee' => '17:00',
                'prix' => 80.00,
            ],
            [
                'ville_depart' => 'Fès',
                'ville_arrivee' => 'Casablanca',
                'heure_depart' => '06:00',
                'heure_arrivee' => '09:00',
                'prix' => 70.00,
            ],
        ];

        foreach ($trajets as $trajet) {
            Trajet::create($trajet);
        }
    }
}