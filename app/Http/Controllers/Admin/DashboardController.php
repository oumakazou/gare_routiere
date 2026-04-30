<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Autocar;
use App\Models\Reservation;
use App\Models\Voyage;
use App\Models\Ville;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'villes' => Ville::count(),
            'autocars' => Autocar::count(),
            'voyages' => Voyage::count(),
            'reservations' => Reservation::count(),
        ]);
    }
}
