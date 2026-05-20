<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Voyage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(): View
    {
        $reservationIds = $this->reservationHistory()->all();
        $paidReservationIds = collect(session('paid_reservations', []))
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->values()
            ->all();

        $reservations = Reservation::query()
            ->with('voyage:id,destination,travel_date,departure_time,total_ttc,ville_arrivee')
            ->whereIn('id', $reservationIds)
            ->latest('id')
            ->get();

        return view('reservations.index', compact('reservations', 'paidReservationIds'));
    }

    public function create(Voyage $voyage): View
    {
        return view('reservations.create', compact('voyage'));
    }

    public function store(Request $request, Voyage $voyage): RedirectResponse
    {
        $availableSeats = $voyage->tickets ?? $voyage->places_disponibles;

        if ($voyage->is_blocked || ($availableSeats !== null && (int) $availableSeats < 1)) {
            return redirect()
                ->route('voyages.index')
                ->with('error', __('reservation.unavailable'));
        }

        $validated = $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'client_phone' => ['required', 'string', 'max:30'],
        ]);

        $reservation = Reservation::query()->create([
            'voyage_id' => $voyage->id,
            'client_name' => $validated['client_name'],
            'client_phone' => $validated['client_phone'],
        ]);

        if ($voyage->tickets !== null && $voyage->tickets > 0) {
            $voyage->decrement('tickets');
        } elseif ($voyage->places_disponibles !== null && $voyage->places_disponibles > 0) {
            $voyage->decrement('places_disponibles');
        }

        session([
            'reservation_history' => $this->reservationHistory()
                ->prepend($reservation->id)
                ->unique()
                ->take(20)
                ->values()
                ->all(),
        ]);

        return redirect()
            ->route('reservations.index')
            ->with('success', __('reservation.success'));
    }

    private function reservationHistory(): Collection
    {
        return collect(session('reservation_history', []))
            ->map(fn ($id) => (int) $id)
            ->filter();
    }
}
