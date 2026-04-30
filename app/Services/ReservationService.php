<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Voyage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReservationService
{
    public function __construct(
        private readonly HolidayService $holidayService,
    ) {
    }

    public function bookedSeatNumbers(Voyage $voyage, string $travelDate, ?Reservation $ignoreReservation = null): array
    {
        $query = $voyage->reservations()
            ->whereDate('date_reservation', $travelDate);

        if ($ignoreReservation) {
            $query->whereKeyNot($ignoreReservation->id);
        }

        return $query->get()
            ->flatMap(fn (Reservation $reservation) => $reservation->seat_numbers ?? [])
            ->map(fn ($seatNumber) => (int) $seatNumber)
            ->sort()
            ->values()
            ->all();
    }

    public function availableSeatsCount(Voyage $voyage, string $travelDate, ?Reservation $ignoreReservation = null): int
    {
        $reservedSeats = $voyage->reservations()
            ->whereDate('date_reservation', $travelDate)
            ->when($ignoreReservation, fn ($query) => $query->whereKeyNot($ignoreReservation->id))
            ->sum('nombre_places');

        return max($voyage->autocar->capacite - $reservedSeats, 0);
    }

    public function createForUser(User $user, Voyage $voyage, array $data): Reservation
    {
        return $this->persistReservation($user->id, $voyage, $data);
    }

    public function createForAdmin(array $data): Reservation
    {
        $voyage = Voyage::query()->with('autocar')->findOrFail($data['voyage_id']);

        return $this->persistReservation($data['user_id'], $voyage, $data);
    }

    public function updateReservation(Reservation $reservation, array $data): Reservation
    {
        $voyage = Voyage::query()
            ->with('autocar')
            ->findOrFail($data['voyage_id'] ?? $reservation->voyage_id);

        $userId = $data['user_id'] ?? $reservation->user_id;

        $this->validateSeats(
            $voyage,
            $data['date_reservation'],
            $data['seat_numbers'],
            $reservation
        );

        $reservation->update([
            'user_id' => $userId,
            'voyage_id' => $voyage->id,
            'nombre_places' => count($data['seat_numbers']),
            'seat_numbers' => $this->normalizeSeatNumbers($data['seat_numbers']),
            'mode_reglement_id' => $data['mode_reglement_id'],
            'date_reservation' => $data['date_reservation'],
            'status' => $data['status'],
            'total_price' => $this->holidayService->priceForDate($voyage, $data['date_reservation']) * count($data['seat_numbers']),
        ]);

        return $reservation->fresh(['user', 'voyage.villeDepart', 'voyage.villeArrivee', 'modeReglement']);
    }

    private function persistReservation(int $userId, Voyage $voyage, array $data): Reservation
    {
        return DB::transaction(function () use ($userId, $voyage, $data) {
            $this->validateSeats($voyage, $data['date_reservation'], $data['seat_numbers']);

            return Reservation::query()->create([
                'user_id' => $userId,
                'voyage_id' => $voyage->id,
                'nombre_places' => count($data['seat_numbers']),
                'seat_numbers' => $this->normalizeSeatNumbers($data['seat_numbers']),
                'mode_reglement_id' => $data['mode_reglement_id'],
                'date_reservation' => $data['date_reservation'],
                'status' => $data['status'] ?? 'confirmee',
                'total_price' => $this->holidayService->priceForDate($voyage, $data['date_reservation']) * count($data['seat_numbers']),
            ]);
        });
    }

    private function validateSeats(Voyage $voyage, string $travelDate, array $seatNumbers, ?Reservation $ignoreReservation = null): void
    {
        $normalizedSeatNumbers = $this->normalizeSeatNumbers($seatNumbers);

        if (count($normalizedSeatNumbers) !== count(array_unique($normalizedSeatNumbers))) {
            throw ValidationException::withMessages([
                'seat_numbers' => 'Chaque siege doit etre unique.',
            ]);
        }

        foreach ($normalizedSeatNumbers as $seatNumber) {
            if ($seatNumber < 1 || $seatNumber > $voyage->autocar->capacite) {
                throw ValidationException::withMessages([
                    'seat_numbers' => 'Un ou plusieurs numeros de siege sont invalides.',
                ]);
            }
        }

        $bookedSeatNumbers = $this->bookedSeatNumbers($voyage, $travelDate, $ignoreReservation);

        if (array_intersect($normalizedSeatNumbers, $bookedSeatNumbers)) {
            throw ValidationException::withMessages([
                'seat_numbers' => 'Certains sieges ne sont plus disponibles.',
            ]);
        }

        if (count($normalizedSeatNumbers) > $this->availableSeatsCount($voyage, $travelDate, $ignoreReservation)) {
            throw ValidationException::withMessages([
                'seat_numbers' => 'Le nombre de places demande depasse les disponibilites.',
            ]);
        }
    }

    private function normalizeSeatNumbers(array $seatNumbers): array
    {
        $normalized = collect($seatNumbers)
            ->map(fn ($seatNumber) => (int) $seatNumber)
            ->sort()
            ->values()
            ->all();

        return $normalized;
    }
}
