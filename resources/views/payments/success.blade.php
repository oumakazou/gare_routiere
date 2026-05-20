@extends('layouts.app')

@section('title', 'Paiement reussi - horseRide')

@section('content')
@php
    $destination = $reservation->voyage->destination ?? $reservation->voyage->ville_arrivee ?? 'Destination';
    $travelDate = $reservation->voyage->travel_date?->format('d/m/Y') ?? '-';
    $amount = (float) ($reservation->voyage->total_ttc ?? 0);
@endphp

<div class="min-h-screen bg-gradient-to-br from-neutral-50 to-red-50 py-12">
    <div class="mx-auto max-w-md px-4 text-center sm:px-6 lg:px-8">
        @include('components.flash')

        <div class="mx-auto mb-8 flex h-24 w-24 items-center justify-center rounded-full bg-neutral-100">
            <svg class="h-12 w-12 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>

        <h1 class="mb-4 text-3xl font-bold text-gray-900">Paiement reussi</h1>
        <p class="mb-8 text-lg text-gray-600">
            Votre reservation a ete enregistree avec succes.
        </p>

        <div class="mb-8 rounded-2xl bg-white p-6 text-left shadow-lg">
            <h2 class="mb-4 text-xl font-semibold text-gray-900">Recapitulatif</h2>

            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Reservation</span>
                    <span class="font-semibold">#{{ $reservation->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Trajet</span>
                    <span class="font-semibold">Taza - {{ $destination }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Date</span>
                    <span class="font-semibold">{{ $travelDate }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Montant</span>
                    <span class="font-semibold text-neutral-600">{{ number_format($amount, 2, ',', ' ') }} MAD</span>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <a href="{{ route('reservations.index') }}" class="block w-full rounded-lg bg-red-600 px-6 py-3 font-semibold text-white transition duration-200 hover:bg-red-700">
                Voir mes reservations
            </a>

            <a href="{{ route('voyages.index') }}" class="block w-full rounded-lg border border-red-600 bg-white px-6 py-3 font-semibold text-red-600 transition duration-200 hover:bg-red-50">
                Reserver un autre voyage
            </a>
        </div>
    </div>
</div>
@endsection
