<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(): View
    {
        $reservations = Reservation::query()
            ->with('voyage:id,destination,travel_date,total_ttc')
            ->latest('id')
            ->paginate(20);

        $latestReservationId = Reservation::query()->max('id') ?? 0;
        session(['admin_last_seen_reservation_id' => $latestReservationId]);

        return view('admin.reservations.index', compact('reservations'));
    }
}
