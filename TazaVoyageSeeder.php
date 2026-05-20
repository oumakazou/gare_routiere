<?php

namespace Database\Seeders;

use App\Models\Ville;
use App\Models\Voyage;
use App\Models\Autocar;
use App\Models\Societe;
use App\Models\TypeVoyage;
use Illuminate\Database\Seeder;

class TazaVoyageSeeder extends Seeder
{
    public function run(): void
    {
        $taza = Ville::firstOrCreate(['nom' => 'TAZA']);
        
        $societe = Societe::first() ?? Societe::create(['nom' => 'Compagnie Nationale']);
        $autocar = Autocar::first() ?? Autocar::create(['matricule' => 'TAZA-BUS-01', 'capacite' => 50, 'societe_id' => $societe->id]);
        $typeNormal = TypeVoyage::firstOrCreate(['nom' => 'Normal']);

        $routes = [
            'FES' => 35, 'MEKNES' => 60, 'KHEMISSET' => 80, 'TIFELT' => 80, 'SALE' => 90,
            'RABAT' => 90, 'CASA BLANCA' => 110, 'EL JADIDA' => 140, 'SAFI' => 180,
            'BNI MELLAL' => 130, 'CHICHAOUA' => 200, 'ESSAOUIRA' => 220, 'SETTAT' => 130,
            'MARRAKECH' => 180, 'AGADIR' => 250, 'INZGAN' => 250, 'SIDI KASEM' => 80,
            'SIDI SELIMANE' => 80, 'SIDI YAHYA' => 80, 'KENITRA' => 80, 'SOUK EL ARBAA' => 100,
            'KASAR LAKBIR' => 100, 'LARACHE' => 100, 'TANGER' => 110, 'TETOUAN' => 100,
            'ASSILAH' => 110, 'JORF EL MALHA' => 65, 'OUAZZANE' => 80, 'CHEFCHAOUEN' => 90,
            'AZROU' => 80, 'IFRANE' => 70, 'MIDELT' => 100, 'KHNIFRA' => 100, 'KASBAT TADLA' => 130,
            'EL KALAA SRAGHNA' => 130, 'AKNOUL' => 20, 'TIZI OUASLI' => 60, 'MIDAR' => 60,
            'SELOUANE' => 60, 'ZAIO' => 60, 'BERKANE' => 60, 'NADOR' => 60, 'GUERCIF' => 20,
            'MISSOUR' => 70, 'OUTAT EL HAJ' => 60, 'TANDIT' => 60, 'LAAYOUNE EST' => 50,
            'TAOURIRT' => 40, 'SAKA' => 40, 'OUJDA' => 60, 'TAHLA' => 25, 'RIBAT EL KHIR' => 40,
            'SEFROU' => 50,
        ];

        foreach ($routes as $destination => $price) {
            $villeArrivee = Ville::firstOrCreate(['nom' => mb_strtoupper($destination)]);
            
            Voyage::create([
                'ville_depart_id' => $taza->id,
                'ville_arrivee_id' => $villeArrivee->id,
                'societe_id' => $societe->id,
                'autocar_id' => $autocar->id,
                'type_voyage_id' => $typeNormal->id,
                'price' => $price,
                'base_price' => $price,
                'date_depart' => now()->addDays(rand(1, 7)),
                'heure_depart' => sprintf('%02d:00', rand(6, 21)),
                'heure_arrivee' => sprintf('%02d:00', rand(8, 23)),
                'available_seats' => rand(5, 48),
                'is_special' => false,
            ]);
        }
    }
}