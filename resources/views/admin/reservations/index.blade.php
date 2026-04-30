@extends('layouts.app')

@section('title', 'Gestion des réservations - Admin')

@section('content')
<div class="space-y-6">
    @include('components.flash')

    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <h1 class="text-3xl font-bold text-slate-900">Gestion des réservations</h1>
        <p class="mt-1 text-slate-600">Voir et gérer toutes les réservations utilisateurs</p>
    </div>

    <div class="rounded-3xl bg-white shadow-sm border border-slate-200 overflow-hidden">
        @if($reservations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Utilisateur</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Voyage</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Places</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Total</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Statut</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Date réservation</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($reservations as $res)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 font-medium text-slate-900">{{ $res->user->name }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $res->voyage->villeDepart->nom }} → {{ $res->voyage->villeArrivee->nom }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $res->nombre_places }}</td>
                                <td class="px-4 py-3 font-semibold text-slate-900">{{ number_format($res->total_price, 2, ',', ' ') }} MAD</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex rounded-full px-2 py-1 text-xs font-semibold
                                        @if($res->status === 'confirmee') bg-green-100 text-green-700
                                        @elseif($res->status === 'en_attente') bg-yellow-100 text-yellow-700
                                        @else bg-red-100 text-red-700 @endif
                                    ">
                                        {{ ucfirst($res->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-slate-600">{{ $res->date_reservation->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-12 text-center">
                <p class="text-slate-600">Aucune réservation trouvée.</p>
            </div>
        @endif
    </div>
</div>
@endsection
