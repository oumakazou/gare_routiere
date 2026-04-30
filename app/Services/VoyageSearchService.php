<?php

namespace App\Services;

use App\Models\Voyage;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class VoyageSearchService
{
    public function __construct(
        private readonly HolidayService $holidayService,
    ) {
    }

    public function search(?int $villeDepartId, ?int $villeArriveeId, ?string $date): Collection
    {
        $travelDate = $date ?: Carbon::now()->addDay()->toDateString();
        $isHoliday = $this->holidayService->isHolidayDate($travelDate);

        $voyages = Voyage::query()
            ->with([
                'villeDepart',
                'villeArrivee',
                'typeVoyage',
                'autocar.societe',
                'autocar.equipements',
                'autocar.options',
                'reservations' => fn ($query) => $query->whereDate('date_reservation', $travelDate),
            ])
            ->when($villeDepartId, fn ($query) => $query->where('ville_depart_id', $villeDepartId))
            ->when($villeArriveeId, fn ($query) => $query->where('ville_arrivee_id', $villeArriveeId))
            ->when(! $isHoliday, fn ($query) => $query->whereHas('autocar', fn ($autocarQuery) => $autocarQuery->where('type', 'local')))
            ->orderBy('heure_depart')
            ->get();

        return $voyages->map(function (Voyage $voyage) use ($travelDate, $isHoliday) {
            $reservedSeats = $voyage->reservations->sum('nombre_places');
            $bookedSeatNumbers = $voyage->reservations
                ->flatMap(fn ($reservation) => $reservation->seat_numbers ?? [])
                ->map(fn ($seatNumber) => (int) $seatNumber)
                ->sort()
                ->values()
                ->all();

            $voyage->setAttribute('travel_date', $travelDate);
            $voyage->setAttribute('resolved_price', $this->holidayService->priceForDate($voyage, $travelDate));
            $voyage->setAttribute('available_seats', max($voyage->autocar->capacite - $reservedSeats, 0));
            $voyage->setAttribute('booked_seat_numbers', $bookedSeatNumbers);
            $voyage->setAttribute('is_holiday_offer', $isHoliday);
            $voyage->setAttribute('special_label', $this->holidayService->specialLabel($travelDate));

            return $voyage;
        });
    }
}
