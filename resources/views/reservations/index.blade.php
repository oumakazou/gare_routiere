@extends('layouts.app')

@section('title', 'Mes réservations')

@section('content')
<div class="space-y-6">
    @include('components.flash')

    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <h1 class="text-3xl font-bold text-slate-900">Mes réservations</h1>
        <p class="mt-1 text-slate-600">Voir l'historique de vos réservations</p>
    </div>

    @if($reservations->count() > 0)
        <div class="space-y-4">
            @foreach($reservations as $res)
                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">
                                {{ $res->voyage->villeDepart->nom }} → {{ $res->voyage->villeArrivee->nom }}
                            </h3>
                            <p class="mt-1 text-slate-600">
                                {{ $res->voyage->date_depart->format('d/m/Y') }} à {{ $res->voyage->heure_depart->format('H:i') }}
                            </p>
                            <p class="mt-2 text-sm text-slate-600">
                                <span class="font-semibold">{{ $res->nombre_places }}</span> place(s) • 
                                Réservé le {{ $res->date_reservation->format('d/m/Y') }}
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-sm text-slate-600">Total</p>
                            <p class="text-3xl font-bold text-slate-900">{{ number_format($res->total_price, 2, ',', ' ') }} MAD</p>
                            <p class="mt-2">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                    @if($res->status === 'confirmee') bg-green-100 text-green-700
                                    @elseif($res->status === 'en_attente') bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif
                                ">
                                    {{ ucfirst($res->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-slate-200 flex gap-2">
                        <a href="{{ route('voyages.show', $res->voyage) }}" class="text-blue-600 hover:text-blue-700 font-semibold">Voir le trajet →</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="rounded-3xl bg-white p-12 shadow-sm border border-slate-200 text-center">
            <svg class="h-12 w-12 mx-auto text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-slate-600">Vous n'avez pas encore de réservations.</p>
            <a href="{{ route('voyages.index') }}" class="mt-4 inline-flex text-blue-600 font-semibold hover:text-blue-700">Découvrir les voyages →</a>
        </div>
    @endif
</div>
@endsection
