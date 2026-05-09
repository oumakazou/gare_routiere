<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        // Dummy voyage data as per README specification
        $voyages = [
            [
                'from' => 'Casablanca',
                'to' => 'Rabat',
                'date' => '2026-05-10',
                'time' => '08:00',
                'duration' => '1h 30m',
                'seats' => 12,
                'price' => '120',
                'discount' => 10,
                'image' => 'https://images.unsplash.com/photo-1489147910541-a8d3d545e941?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80'
            ],
            [
                'from' => 'Rabat',
                'to' => 'Fès',
                'date' => '2026-05-10',
                'time' => '10:30',
                'duration' => '2h 15m',
                'seats' => 8,
                'price' => '180',
                'discount' => null,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80'
            ],
            [
                'from' => 'Fès',
                'to' => 'Marrakech',
                'date' => '2026-05-10',
                'time' => '14:00',
                'duration' => '3h 45m',
                'seats' => 15,
                'price' => '250',
                'discount' => 15,
                'image' => 'https://images.unsplash.com/photo-1539650116574-75c0c6d0b7ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80'
            ],
            [
                'from' => 'Marrakech',
                'to' => 'Agadir',
                'date' => '2026-05-11',
                'time' => '09:15',
                'duration' => '2h 30m',
                'seats' => 10,
                'price' => '160',
                'discount' => null,
                'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80'
            ],
            [
                'from' => 'Tanger',
                'to' => 'Casablanca',
                'date' => '2026-05-11',
                'time' => '11:45',
                'duration' => '4h 20m',
                'seats' => 20,
                'price' => '280',
                'discount' => 20,
                'image' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80'
            ],
            [
                'from' => 'Agadir',
                'to' => 'Marrakech',
                'date' => '2026-05-11',
                'time' => '16:30',
                'duration' => '2h 30m',
                'seats' => 14,
                'price' => '160',
                'discount' => 5,
                'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80'
            ],
            [
                'from' => 'Rabat',
                'to' => 'Tanger',
                'date' => '2026-05-10',
                'time' => '13:20',
                'duration' => '3h 10m',
                'seats' => 18,
                'price' => '220',
                'discount' => null,
                'image' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80'
            ],
            [
                'from' => 'Casablanca',
                'to' => 'Fès',
                'date' => '2026-05-10',
                'time' => '07:00',
                'duration' => '3h 45m',
                'seats' => 22,
                'price' => '240',
                'discount' => 12,
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80'
            ]
        ];

        return view('home', compact('voyages'));
    }
}
