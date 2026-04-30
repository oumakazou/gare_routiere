<?php

namespace App\Http\Controllers;

use App\Models\ModeReglement;
use App\Models\Reservation;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(): View
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with(['voyage.villeDepart', 'voyage.villeArrivee'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create(Voyage $voyage): View
    {
        $modes = ModeReglement::orderBy('nom')->get();

        return view('reservations.create', compact('voyage', 'modes'));
    }

    public function store(Request $request, Voyage $voyage)
    {
        $validated = $request->validate([
            'nombre_places' => ['required', 'integer', 'min:1'],
            'mode_reglement_id' => ['required', 'exists:mode_reglements,id'],
            'date_reservation' => ['required', 'date'],
        ]);

        $user = Auth::user();

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'voyage_id' => $voyage->id,
            'nombre_places' => $validated['nombre_places'],
            'seat_numbers' => range(1, $validated['nombre_places']),
            'mode_reglement_id' => $validated['mode_reglement_id'],
            'date_reservation' => $validated['date_reservation'],
            'status' => 'confirmee',
            'total_price' => $voyage->price * $validated['nombre_places'],
        ]);

        return redirect()->route('reservations.index')->with('success', "Réservation confirmée pour le voyage {$voyage->villeDepart->nom} → {$voyage->villeArrivee->nom}.");
    }
}
