<?php

namespace Database\Seeders;

use App\Models\Autocar;
use App\Models\Equipement;
use App\Models\ModeReglement;
use App\Models\Option;
use App\Models\Societe;
use App\Models\TypeVoyage;
use App\Models\User;
use App\Models\Ville;
use App\Models\Voyage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Client User',
            'email' => 'client@example.com',
        ]);

        $villes = collect(['Fès', 'Rabat', 'Casablanca', 'Marrakech'])->map(function ($nom) {
            return Ville::create(['nom' => $nom]);
        });

        $societes = collect([
            ['nom' => 'Société Atlas', 'contact' => 'contact@atlas.ma'],
            ['nom' => 'Bus Express', 'contact' => 'contact@busexpress.ma'],
            ['nom' => 'TransMed', 'contact' => 'contact@transmed.ma'],
        ])->map(fn ($data) => Societe::create($data));

        $equipements = collect(['WiFi', 'Climatisation', 'TV'])->map(fn ($nom) => Equipement::create(['nom' => $nom]));
        $options = collect(['VIP', 'Confort', 'Rapide'])->map(fn ($nom) => Option::create(['nom' => $nom]));
        $types = collect(['normal', 'express', 'luxe'])->map(fn ($nom) => TypeVoyage::create(['nom' => $nom]));
        $modes = collect(['cash', 'carte', 'en ligne'])->map(fn ($nom) => ModeReglement::create(['nom' => $nom]));

        $autocars = collect([
            ['matricule' => 'AT-123-AB', 'capacite' => 50, 'type' => 'local', 'societe' => $societes[0], 'equipements' => [$equipements[0], $equipements[1]], 'options' => [$options[1]]],
            ['matricule' => 'BX-789-CD', 'capacite' => 45, 'type' => 'external', 'societe' => $societes[1], 'equipements' => [$equipements[0], $equipements[2]], 'options' => [$options[0], $options[2]]],
            ['matricule' => 'TM-456-EF', 'capacite' => 55, 'type' => 'local', 'societe' => $societes[2], 'equipements' => [$equipements[1], $equipements[2]], 'options' => [$options[1], $options[2]]],
        ])->map(function ($data) {
            $autocar = Autocar::create([
                'matricule' => $data['matricule'],
                'capacite' => $data['capacite'],
                'type' => $data['type'],
                'societe_id' => $data['societe']->id,
            ]);
            $autocar->equipements()->sync(collect($data['equipements'])->pluck('id'));
            $autocar->options()->sync(collect($data['options'])->pluck('id'));

            return $autocar;
        });

        $voyagesData = [
            ['depart' => 'Casablanca', 'arrivee' => 'Rabat', 'autocar' => $autocars[0], 'type' => $types[0], 'date' => now()->addDays(2)->toDateString(), 'depart_time' => '08:00', 'arrivee_time' => '10:00', 'price' => 120, 'special' => false],
            ['depart' => 'Rabat', 'arrivee' => 'Fès', 'autocar' => $autocars[1], 'type' => $types[1], 'date' => now()->addDays(2)->toDateString(), 'depart_time' => '11:00', 'arrivee_time' => '14:15', 'price' => 180, 'special' => true],
            ['depart' => 'Fès', 'arrivee' => 'Marrakech', 'autocar' => $autocars[2], 'type' => $types[2], 'date' => now()->addDays(3)->toDateString(), 'depart_time' => '09:30', 'arrivee_time' => '14:00', 'price' => 240, 'special' => false],
        ];

        foreach ($voyagesData as $data) {
            Voyage::create([
                'ville_depart_id' => $villes->firstWhere('nom', $data['depart'])->id,
                'ville_arrivee_id' => $villes->firstWhere('nom', $data['arrivee'])->id,
                'autocar_id' => $data['autocar']->id,
                'type_voyage_id' => $data['type']->id,
                'date_depart' => $data['date'],
                'heure_depart' => $data['depart_time'],
                'heure_arrivee' => $data['arrivee_time'],
                'base_price' => $data['price'],
                'is_special' => $data['special'],
            ]);
        }
    }
}
