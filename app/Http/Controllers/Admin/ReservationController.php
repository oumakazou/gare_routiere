<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ModeReglement;
use App\Models\User;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(): View
    {
        $reservations = Reservation::with(['user', 'voyage.villeDepart', 'voyage.villeArrivee', 'modeReglement'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function create(): View
    {
        return view('admin.reservations.form', [
            'reservation' => new Reservation(),
            'users' => User::orderBy('name')->get(),
            'voyages' => Voyage::with(['villeDepart', 'villeArrivee'])->orderBy('date_depart')->get(),
            'modes' => ModeReglement::orderBy('nom')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'voyage_id' => ['required', 'exists:voyages,id'],
            'nombre_places' => ['required', 'integer', 'min:1'],
            'mode_reglement_id' => ['required', 'exists:mode_reglements,id'],
            'date_reservation' => ['required', 'date'],
            'status' => ['required', 'in:confirmee,en_attente,annulee'],
        ]);

        $voyage = Voyage::findOrFail($validated['voyage_id']);

        Reservation::create([
            'user_id' => $validated['user_id'],
            'voyage_id' => $validated['voyage_id'],
            'nombre_places' => $validated['nombre_places'],
            'seat_numbers' => range(1, $validated['nombre_places']),
            'mode_reglement_id' => $validated['mode_reglement_id'],
            'date_reservation' => $validated['date_reservation'],
            'status' => $validated['status'],
            'total_price' => $voyage->price * $validated['nombre_places'],
        ]);

        return redirect()->route('admin.reservations.index')->with('success', 'Réservation administrateur créée.');
    }

    public function edit(Reservation $reservation): View
    {
        return view('admin.reservations.form', [
            'reservation' => $reservation,
            'users' => User::orderBy('name')->get(),
            'voyages' => Voyage::with(['villeDepart', 'villeArrivee'])->orderBy('date_depart')->get(),
            'modes' => ModeReglement::orderBy('nom')->get(),
        ]);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'voyage_id' => ['required', 'exists:voyages,id'],
            'nombre_places' => ['required', 'integer', 'min:1'],
            'mode_reglement_id' => ['required', 'exists:mode_reglements,id'],
            'date_reservation' => ['required', 'date'],
            'status' => ['required', 'in:confirmee,en_attente,annulee'],
        ]);

        $voyage = Voyage::findOrFail($validated['voyage_id']);

        $reservation->update([
            'user_id' => $validated['user_id'],
            'voyage_id' => $validated['voyage_id'],
            'nombre_places' => $validated['nombre_places'],
            'seat_numbers' => range(1, $validated['nombre_places']),
            'mode_reglement_id' => $validated['mode_reglement_id'],
            'date_reservation' => $validated['date_reservation'],
            'status' => $validated['status'],
            'total_price' => $voyage->price * $validated['nombre_places'],
        ]);

        return redirect()->route('admin.reservations.index')->with('success', 'Réservation mise à jour.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Réservation supprimée.');
    }
}
