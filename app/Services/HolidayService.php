<?php

namespace App\Services;

use App\Models\Holiday;
use App\Models\Voyage;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class HolidayService
{
    public function findHolidayForDate(?string $date): ?Holiday
    {
        if (! $date) {
            return null;
        }

        $travelDate = Carbon::parse($date)->toDateString();

        return Holiday::query()
            ->whereDate('start_date', '<=', $travelDate)
            ->whereDate('end_date', '>=', $travelDate)
            ->first();
    }

    public function isHolidayDate(?string $date): bool
    {
        return $this->findHolidayForDate($date) !== null;
    }

    public function priceForDate(Voyage $voyage, ?string $date): float
    {
        $basePrice = (float) $voyage->base_price;

        if (! $this->isHolidayDate($date)) {
            return $basePrice;
        }

        return round($basePrice * 1.3, 2);
    }

    public function specialLabel(?string $date): ?string
    {
        return $this->isHolidayDate($date) ? 'Tarif special Aid' : null;
    }
}
