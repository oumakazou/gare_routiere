<?php

namespace Database\Seeders;

use App\Models\Ville;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $cities = [
            'Agadir',
            'Ait Benhaddou',
            'Akchour',
            'Al Hoceima',
            'Azrou',
            'Beni Mellal',
            'Boulemane',
            'Casablanca',
            'Chefchaouen',
            'Dakhla',
            'El Jadida',
            'Errachidia',
            'Fès',
            'Figuig',
            'Guelmim',
            'Ifrane',
            'Kenitra',
            'Khouribga',
            'Khemisset',
            'Laâyoune',
            'Marrakech',
            'Meknès',
            'Merzuga',
            'Midelt',
            'Nador',
            'Ouarzazate',
            'Oujda',
            'Rabat',
            'Safi',
            'Sidi Ifni',
            'Sidi Slimane',
            'Tan Tan',
            'Tanger',
            'Taourirt',
            'Tafraoute',
            'Taroudant',
            'Taza',
            'Tetouan',
            'Tinghir',
            'Tiznit',
            'Zag',
        ];

        // Create cities
        foreach ($cities as $cityName) {
            Ville::firstOrCreate(['nom' => $cityName]);
        }
    }
}
