<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\TransportCompany;
use App\Models\Voyage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private const VOYAGES = 'voyages';

    public function index(): View
    {
        $lastSeenReservationId = (int) session('admin_last_seen_reservation_id', 0);

        $voyageRelation = $this->reservationVoyageRelation();

        $newReservations = Reservation::query()
            ->with($voyageRelation)
            ->where('id', '>', $lastSeenReservationId)
            ->latest('id')
            ->take(5)
            ->get();

        $recentTicketStats = $this->recentTicketStats();

        $voyagesCount = Voyage::query()->count();

        $totalTickets = $this->sumVoyageColumnAsInt(
            $this->ticketsColumnForSum(),
        );

        $totalTtc = $this->sumVoyageColumnAsFloat(
            $this->ttcColumnForSum(),
        );

        $blockedVoyages = Schema::hasColumn(self::VOYAGES, 'is_blocked')
            ? Voyage::query()->where('is_blocked', true)->count()
            : 0;

        $activeCompanies = Schema::hasTable('transport_companies') && Schema::hasColumn('transport_companies', 'is_active')
            ? TransportCompany::query()->where('is_active', true)->count()
            : 0;

        $reservationsCount = Reservation::query()->count();

        $voyageStatusCounts = $this->voyageStatusCounts();

        $lastVoyages = $this->lastVoyagesQuery()->get();

        return view('admin.dashboard', [
            'newReservationsCount' => $newReservations->count(),
            'voyagesCount' => $voyagesCount,
            'totalTickets' => $totalTickets,
            'totalTtc' => $totalTtc,
            'blockedVoyages' => $blockedVoyages,
            'activeCompanies' => $activeCompanies,
            'reservationsCount' => $reservationsCount,
            'voyageStatusCounts' => $voyageStatusCounts,
            'recentTicketStats' => $recentTicketStats,
            'lastVoyages' => $lastVoyages,
            'newReservations' => $newReservations,
        ]);
    }

    /**
     * @return array<string, callable(\Illuminate\Database\Eloquent\Relations\BelongsTo): void>
     */
    private function reservationVoyageRelation(): array
    {
        $cols = ['id'];
        foreach (['destination', 'ville_arrivee'] as $col) {
            if (Schema::hasColumn(self::VOYAGES, $col)) {
                $cols[] = $col;
            }
        }

        return [
            'voyage' => static function ($q) use ($cols): void {
                $q->select($cols);
            },
        ];
    }

    private function recentTicketStats(): Collection
    {
        if (
            Schema::hasColumn(self::VOYAGES, 'travel_date')
            && Schema::hasColumn(self::VOYAGES, 'tickets')
            && Schema::hasColumn(self::VOYAGES, 'total_ttc')
        ) {
            return Voyage::query()
                ->selectRaw('travel_date as day, SUM(tickets) as tickets, SUM(total_ttc) as total_ttc')
                ->whereNotNull('travel_date')
                ->groupBy('travel_date')
                ->orderByDesc('travel_date')
                ->limit(7)
                ->get()
                ->sortBy('day')
                ->values();
        }

        if (Schema::hasColumn(self::VOYAGES, 'date_voyage')) {
            $ticketsExpr = $this->ticketsSqlExpression();
            $ttcExpr = $this->ttcSqlExpression();

            return Voyage::query()
                ->selectRaw("date_voyage as day, {$ticketsExpr} as tickets, {$ttcExpr} as total_ttc")
                ->whereNotNull('date_voyage')
                ->groupBy('date_voyage')
                ->orderByDesc('date_voyage')
                ->limit(7)
                ->get()
                ->sortBy('day')
                ->values();
        }

        return collect();
    }

    private function ticketsSqlExpression(): string
    {
        if (Schema::hasColumn(self::VOYAGES, 'tickets')) {
            return 'SUM(COALESCE(tickets, 0))';
        }
        if (Schema::hasColumn(self::VOYAGES, 'places_disponibles')) {
            return 'SUM(COALESCE(places_disponibles, 0))';
        }

        return '0';
    }

    private function ttcSqlExpression(): string
    {
        if (Schema::hasColumn(self::VOYAGES, 'total_ttc')) {
            return 'SUM(COALESCE(total_ttc, 0))';
        }
        if (Schema::hasColumn(self::VOYAGES, 'prix')) {
            return 'SUM(COALESCE(prix, 0))';
        }

        return '0';
    }

    private function ticketsColumnForSum(): ?string
    {
        if (Schema::hasColumn(self::VOYAGES, 'tickets')) {
            return 'tickets';
        }
        if (Schema::hasColumn(self::VOYAGES, 'places_disponibles')) {
            return 'places_disponibles';
        }

        return null;
    }

    private function ttcColumnForSum(): ?string
    {
        if (Schema::hasColumn(self::VOYAGES, 'total_ttc')) {
            return 'total_ttc';
        }
        if (Schema::hasColumn(self::VOYAGES, 'prix')) {
            return 'prix';
        }

        return null;
    }

    private function sumVoyageColumnAsInt(?string $column): int
    {
        if ($column === null) {
            return 0;
        }

        return (int) Voyage::query()->sum($column);
    }

    private function sumVoyageColumnAsFloat(?string $column): float
    {
        if ($column === null) {
            return 0.0;
        }

        return (float) Voyage::query()->sum($column);
    }

    private function voyageStatusCounts(): Collection
    {
        if (! Schema::hasColumn(self::VOYAGES, 'is_blocked')) {
            $total = Voyage::query()->count();

            return collect([
                'Ouverts' => $total,
                'Bloques' => 0,
            ]);
        }

        return collect([
            'Ouverts' => Voyage::query()->where('is_blocked', false)->count(),
            'Bloques' => Voyage::query()->where('is_blocked', true)->count(),
        ]);
    }

    private function lastVoyagesQuery()
    {
        $q = Voyage::query()->with('transportCompany');

        if (Schema::hasColumn(self::VOYAGES, 'travel_date')) {
            return $q->latest('travel_date')->latest('id');
        }

        if (Schema::hasColumn(self::VOYAGES, 'date_voyage')) {
            return $q->latest('date_voyage')->latest('id');
        }

        return $q->latest('id');
    }
}
