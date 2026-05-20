<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredTrips = collect([
            [
                'company' => 'Atlas Executive',
                'from' => 'Taza',
                'to' => 'Casablanca',
                'date' => '2026-05-16',
                'time' => '07:15',
                'duration' => '4h 20m',
                'seats' => 12,
                'price' => 190,
                'image' => 'images/casa.png',
            ],
            [
                'company' => 'Premium Lines',
                'from' => 'Taza',
                'to' => 'Marrakech',
                'date' => '2026-05-16',
                'time' => '06:45',
                'duration' => '6h 10m',
                'seats' => 8,
                'price' => 260,
                'image' => 'images/marakech.png',
            ],
            [
                'company' => 'Blue Route',
                'from' => 'Taza',
                'to' => 'Chefchaouen',
                'date' => '2026-05-17',
                'time' => '09:00',
                'duration' => '3h 05m',
                'seats' => 9,
                'price' => 145,
                'image' => 'images/chafchaouin.png',
            ],
            [
                'company' => 'Sahara Night',
                'from' => 'Taza',
                'to' => 'Agadir',
                'date' => '2026-05-17',
                'time' => '21:00',
                'duration' => '9h 35m',
                'seats' => 15,
                'price' => 320,
                'image' => 'images/agadir.png',
            ],
        ]);

        $destinations = collect([
            [
                'name' => 'Casablanca',
                'image' => 'images/casa.png',
                'copy_key' => 'home.destinations.casablanca',
            ],
            [
                'name' => 'Marrakech',
                'image' => 'images/marakech.png',
                'copy_key' => 'home.destinations.marrakech',
            ],
            [
                'name' => 'Chefchaouen',
                'image' => 'images/chafchaouin.png',
                'copy_key' => 'home.destinations.chefchaouen',
            ],
            [
                'name' => 'Agadir',
                'image' => 'images/agadir.png',
                'copy_key' => 'home.destinations.agadir',
            ],
        ]);

        $journeyStats = [
            ['value' => '50K+', 'label_key' => 'home.stats.travelers'],
            ['value' => '38', 'label_key' => 'home.stats.destinations'],
            ['value' => '120+', 'label_key' => 'home.stats.departures'],
            ['value' => '4.9/5', 'label_key' => 'home.stats.rating'],
        ];

        $experienceCards = [
            [
                'title_key' => 'home.experience.comfort.title',
                'copy_key' => 'home.experience.comfort.copy',
            ],
            [
                'title_key' => 'home.experience.reliability.title',
                'copy_key' => 'home.experience.reliability.copy',
            ],
            [
                'title_key' => 'home.experience.support.title',
                'copy_key' => 'home.experience.support.copy',
            ],
        ];

        $journeySteps = [
            [
                'index' => '01',
                'title_key' => 'home.steps.search.title',
                'copy_key' => 'home.steps.search.copy',
            ],
            [
                'index' => '02',
                'title_key' => 'home.steps.confirm.title',
                'copy_key' => 'home.steps.confirm.copy',
            ],
            [
                'index' => '03',
                'title_key' => 'home.steps.depart.title',
                'copy_key' => 'home.steps.depart.copy',
            ],
        ];

        $testimonials = [
            [
                'author' => 'Sara B.',
                'role_key' => 'home.testimonials.sara.role',
                'quote_key' => 'home.testimonials.sara.quote',
            ],
            [
                'author' => 'Youssef M.',
                'role_key' => 'home.testimonials.youssef.role',
                'quote_key' => 'home.testimonials.youssef.quote',
            ],
            [
                'author' => 'Nadia K.',
                'role_key' => 'home.testimonials.nadia.role',
                'quote_key' => 'home.testimonials.nadia.quote',
            ],
        ];

        return view('home', compact(
            'destinations',
            'experienceCards',
            'featuredTrips',
            'journeyStats',
            'journeySteps',
            'testimonials',
        ));
    }
}
