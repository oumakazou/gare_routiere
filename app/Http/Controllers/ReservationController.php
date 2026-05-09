<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function create(Voyage $voyage): View|RedirectResponse
    {
        $availableSeats = (int) ($voyage->tickets ?? $voyage->places_disponibles ?? $voyage->available_seats ?? 0);

        if ($availableSeats <= 0) {
            return redirect()
                ->route('voyages.index')
                ->with('error', 'Ce voyage est complet.');
        }

        return view('reservations.create', compact('voyage'));
    }

    public function store(Request $request, Voyage $voyage)
    {
        $data = $request->validate([
            'client_name' => ['required', 'string', 'max:100'],
            'client_phone' => ['required', 'string', 'max:30'],
        ]);

        $reserved = DB::transaction(function () use ($voyage, $data) {
            $lockedVoyage = Voyage::query()->lockForUpdate()->findOrFail($voyage->id);
            $availableSeats = (int) ($lockedVoyage->tickets ?? $lockedVoyage->places_disponibles ?? $lockedVoyage->available_seats ?? 0);
            if ($availableSeats <= 0) {
                return false;
            }

            if (Schema::hasColumn('reservations', 'client_name')) {
                Reservation::create([
                    'voyage_id' => $lockedVoyage->id,
                    'client_name' => $data['client_name'],
                    'client_phone' => $data['client_phone'],
                ]);
            } else {
                // Backward-compatible insert for legacy reservations schema.
                $userId = DB::table('users')->value('id');
                if (! $userId) {
                    $userId = DB::table('users')->insertGetId([
                        'nom' => $data['client_name'],
                        'email' => 'legacy_' . time() . '@example.com',
                        'mot_de_passe' => bcrypt('password123'),
                        'is_admin' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $modeReglementId = DB::table('mode_reglements')->value('id');
                if (! $modeReglementId) {
                    $modeReglementId = DB::table('mode_reglements')->insertGetId([
                        'nom' => 'Especes',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('reservations')->insert([
                    'user_id' => $userId,
                    'voyage_id' => $lockedVoyage->id,
                    'nombre_places' => 1,
                    'seat_numbers' => json_encode([1]),
                    'mode_reglement_id' => $modeReglementId,
                    'date_reservation' => now()->toDateString(),
                    'status' => 'confirmee',
                    'total_price' => (float) ($lockedVoyage->price ?? $lockedVoyage->base_price ?? 0),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            if (Schema::hasColumn('voyages', 'tickets')) {
                $lockedVoyage->decrement('tickets');
            } elseif (Schema::hasColumn('voyages', 'places_disponibles')) {
                $lockedVoyage->decrement('places_disponibles');
            } else {
                $lockedVoyage->decrement('available_seats');
            }

            return true;
        });

        if (! $reserved) {
            return redirect()
                ->route('voyages.index')
                ->with('error', 'Plus de places disponibles pour ce voyage.');
        }

        return redirect()
            ->route('voyages.index')
            ->with('success', 'Reservation effectuee avec succes.');
    }
}
