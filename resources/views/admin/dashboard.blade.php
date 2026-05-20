@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-bold">Dashboard</h1>
            <p class="mt-2 text-sm text-slate-500">Statistiques en temps réel sur les voyages et les importations depuis Excel / CSV.</p>
        </div>
        <a href="{{ route('admin.reservations.index') }}" class="relative inline-flex rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white">
            Notifications
            @if($newReservationsCount > 0)
                <span class="absolute -right-2 -top-2 rounded-full bg-red-600 px-2 py-0.5 text-xs font-bold text-white">{{ $newReservationsCount }}</span>
            @endif
        </a>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total voyages</p>
            <p class="mt-2 text-3xl font-bold">{{ $voyagesCount }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total tickets</p>
            <p class="mt-2 text-3xl font-bold">{{ $totalTickets }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total TTC</p>
            <p class="mt-2 text-3xl font-bold">{{ number_format($totalTtc, 2, ',', ' ') }} DH</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Voyages bloqués</p>
            <p class="mt-2 text-3xl font-bold">{{ $blockedVoyages }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Sociétés actives</p>
            <p class="mt-2 text-3xl font-bold">{{ $activeCompanies }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Réservations totales</p>
            <p class="mt-2 text-3xl font-bold">{{ $reservationsCount }}</p>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold">Répartition des voyages</h2>
            <p class="mt-2 text-sm text-slate-500">Visualise la proportion des voyages ouverts et bloqués.</p>

            <div class="mt-6 space-y-4">
                @php $statusTotal = $voyageStatusCounts->sum(); @endphp
                @foreach($voyageStatusCounts as $label => $count)
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-sm text-slate-600">
                            <span>{{ $label }}</span>
                            <span class="font-semibold text-slate-900">{{ $count }}</span>
                        </div>
                        <div class="h-3 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-red-600" style="width: {{ $statusTotal ? round($count / $statusTotal * 100) : 0 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold">Trend des tickets</h2>
            <p class="mt-2 text-sm text-slate-500">Tickets vendus et montant TTC par date.</p>

            <div class="mt-6 space-y-4">
                @foreach($recentTicketStats as $stat)
                    <div>
                        <div class="flex items-center justify-between text-sm text-slate-600">
                            <span>{{ \Carbon\Carbon::parse($stat->day)->format('d/m') }}</span>
                            <span class="font-semibold text-slate-900">{{ $stat->tickets }} tickets</span>
                        </div>
                        <div class="mt-2 h-3 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-cyan-600" style="width: {{ min(100, max(6, round($stat->tickets / max(1, $recentTicketStats->max('tickets')) * 100))) }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-2">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold">Derniers voyages</h2>
            <p class="mt-2 text-sm text-slate-500">Les derniers voyages créés ou importés depuis Excel / CSV.</p>

            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full text-sm text-slate-700">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Date</th>
                            <th class="px-4 py-3 text-left font-semibold">Destination</th>
                            <th class="px-4 py-3 text-left font-semibold">Société</th>
                            <th class="px-4 py-3 text-left font-semibold">Ligne</th>
                            <th class="px-4 py-3 text-left font-semibold">Tickets</th>
                            <th class="px-4 py-3 text-left font-semibold">Total TTC</th>
                            <th class="px-4 py-3 text-left font-semibold">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($lastVoyages as $voyage)
                            <tr class="hover:bg-slate-50">
                                @php
                                    $tripDate = $voyage->travel_date ?? $voyage->date_voyage ?? null;
                                    $tripDestination = $voyage->destination ?? $voyage->ville_arrivee ?? '-';
                                    $tripTickets = $voyage->tickets ?? $voyage->places_disponibles ?? 0;
                                    $tripTtc = $voyage->total_ttc ?? $voyage->prix ?? 0;
                                    $tripBlocked = (bool) ($voyage->is_blocked ?? false);
                                @endphp
                                <td class="px-4 py-3">{{ $tripDate ? \Illuminate\Support\Carbon::parse($tripDate)->format('d/m/Y') : '-' }}</td>
                                <td class="px-4 py-3">{{ $tripDestination }}</td>
                                <td class="px-4 py-3">{{ $voyage->transportCompany?->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $voyage->line_name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $tripTickets }}</td>
                                <td class="px-4 py-3">{{ number_format((float) $tripTtc, 2, ',', ' ') }} DH</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $tripBlocked ? 'bg-red-100 text-red-700' : 'bg-neutral-100 text-neutral-700' }}">
                                        {{ $tripBlocked ? 'Bloqué' : 'Ouvert' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-4 text-sm text-slate-500" colspan="7">Aucun voyage récent disponible.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-xl font-bold">Nouvelles reservations</h2>
                @if($newReservations->isEmpty())
                    <p class="mt-3 text-sm text-slate-600">Aucune nouvelle réservation.</p>
                @else
                    <div class="mt-4 space-y-3">
                        @foreach($newReservations as $reservation)
                            <div class="rounded-2xl bg-slate-50 px-4 py-3 text-sm text-slate-700">
                                Nouvelle reservation pour {{ optional($reservation->voyage)->ville_arrivee ?? optional($reservation->voyage)->destination ?? 'destination inconnue' }}
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-xl font-bold">Import données Excel / CSV</h2>
                <p class="mt-2 text-sm text-slate-600">Importer les voyages existants. Si ton environnement XAMPP ne supporte pas XLSX, exporte le fichier en CSV puis importe-le ici.</p>
                <form method="POST" action="{{ route('admin.voyages.import') }}" enctype="multipart/form-data" class="mt-4 flex flex-wrap items-center gap-3">
                    @csrf
                    <input type="file" name="file" required class="rounded-xl border border-slate-300 px-4 py-2">
                    <button class="rounded-xl bg-red-600 px-4 py-2 font-semibold text-white hover:bg-red-700">Importer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
