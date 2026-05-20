<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voyage;
use App\Models\Reservation;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_voyages' => Voyage::count(),
            'total_reservations' => Reservation::count(),
            'total_users' => User::where('role', 'client')->count(),
            'pending_reservations' => Reservation::where('status', 'pending')->count(),
        ];

        $recent_reservations = Reservation::with(['user', 'voyage.villeDepart', 'voyage.villeArrivee'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_reservations'));
    }
}