<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\TransportCompany;
use App\Models\Voyage;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $lastSeenId = (int) session('admin_last_seen_reservation_id', 0);

        $newReservations = Reservation::query()
            ->with('voyage:id,ville_arrivee')
            ->where('id', '>', $lastSeenId)
            ->latest('id')
            ->take(5)
            ->get();

        $newReservationsCount = Reservation::query()
            ->where('id', '>', $lastSeenId)
            ->count();

        $voyageStatusCounts = Voyage::query()
            ->selectRaw('is_blocked, count(*) as total')
            ->groupBy('is_blocked')
            ->pluck('total', 'is_blocked')
            ->mapWithKeys(fn ($total, $blocked) => [$blocked ? 'Bloqués' : 'Ouverts' => $total]);

        $recentTicketStats = Voyage::query()
            ->whereNotNull('travel_date')
            ->selectRaw('DATE(travel_date) as day, SUM(tickets) as tickets, SUM(total_ttc) as total_ttc')
            ->groupBy('day')
            ->orderByDesc('day')
            ->take(7)
            ->get()
            ->reverse();

        $lastVoyages = Voyage::query()
            ->with('transportCompany')
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        return view('admin.dashboard', [
            'voyagesCount' => Voyage::count(),
            'reservationsCount' => Reservation::count(),
            'newReservations' => $newReservations,
            'newReservationsCount' => $newReservationsCount,
            'totalTickets' => (int) Voyage::sum('tickets'),
            'totalTtc' => (float) Voyage::sum('total_ttc'),
            'blockedVoyages' => Voyage::where('is_blocked', true)->count(),
            'activeCompanies' => TransportCompany::where('is_active', true)->count(),
            'voyageStatusCounts' => $voyageStatusCounts,
            'recentTicketStats' => $recentTicketStats,
            'lastVoyages' => $lastVoyages,
        ]);
    }
}
