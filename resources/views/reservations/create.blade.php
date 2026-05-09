@extends('layouts.public')

@section('title', 'Reserver un voyage')

@section('content')
<div class="mx-auto max-w-xl px-4 py-8 sm:px-6 lg:px-8">
    @php
        $arrivalCity = $voyage->destination ?? $voyage->ville_arrivee ?? $voyage->villeArrivee?->nom ?? 'Destination';
        $rawDate = $voyage->travel_date ?? $voyage->date_voyage ?? $voyage->date_depart ?? null;
        $displayDate = $rawDate ? \Illuminate\Support\Carbon::parse($rawDate)->format('d/m/Y') : '-';
        $displayPrice = (float) ($voyage->total_ttc ?? $voyage->prix ?? $voyage->price ?? $voyage->base_price ?? 0);
    @endphp
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-bold">Reservation</h1>
        <p class="mt-2 text-sm text-slate-600">
            Taza → {{ $arrivalCity }} | {{ $displayDate }} | {{ number_format($displayPrice, 2, ',', ' ') }} MAD
        </p>

        <form method="POST" action="{{ route('reservations.store', $voyage) }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="client_name" class="mb-1 block text-sm font-semibold text-slate-700">Nom complet</label>
                <input id="client_name" name="client_name" value="{{ old('client_name') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                @error('client_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="client_phone" class="mb-1 block text-sm font-semibold text-slate-700">Telephone</label>
                <input id="client_phone" name="client_phone" value="{{ old('client_phone') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                @error('client_phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <a href="{{ route('voyages.index') }}" class="rounded-xl border border-slate-300 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-50">Annuler</a>
                <button type="submit" class="rounded-xl bg-emerald-600 px-5 py-3 font-semibold text-white hover:bg-emerald-700">
                    Confirmer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
