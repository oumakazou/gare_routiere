@extends('layouts.app')

@section('title', 'Réserver le voyage')

@section('content')
    @include('components.flash')
    
    <div class="space-y-6">
        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
            <h1 class="text-3xl font-semibold text-slate-900">Réservation</h1>
            <p class="mt-2 text-slate-600">Complétez le formulaire pour réserver votre trajet.</p>

            <div class="mt-6 grid gap-4 lg:grid-cols-2">
                <div class="rounded-3xl bg-slate-50 p-6">
                    <h2 class="text-lg font-semibold text-slate-900">Voyage</h2>
                    <p class="mt-3 text-slate-700">{{ $voyage->villeDepart->nom }} → {{ $voyage->villeArrivee->nom }}</p>
                    <p class="mt-2 text-slate-700">{{ $voyage->date_depart->format('d/m/Y') }} à {{ $voyage->heure_depart->format('H:i') }}</p>
                    <p class="mt-2 text-slate-700">Prix unitaire: {{ number_format($voyage->price, 2, ',', ' ') }} MAD</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-6">
                    <h2 class="text-lg font-semibold text-slate-900">Mode de paiement</h2>
                    <p class="mt-3 text-slate-700">Choisissez une méthode de règlement pour finaliser la réservation.</p>
                </div>
            </div>

            <form action="{{ route('reservations.store', $voyage) }}" method="POST" class="mt-8 space-y-4">
                @csrf
                <div class="grid gap-4 lg:grid-cols-2">
                    <label class="block">
                        <span class="text-sm font-medium text-slate-700">Nombre de places</span>
                        <input type="number" name="nombre_places" value="{{ old('nombre_places', 1) }}" min="1" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" required />
                    </label>

                    <label class="block">
                        <span class="text-sm font-medium text-slate-700">Date de réservation</span>
                        <input type="date" name="date_reservation" value="{{ old('date_reservation', now()->toDateString()) }}" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" required />
                    </label>
                </div>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Mode de règlement</span>
                    <select name="mode_reglement_id" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
                        <option value="">Sélectionnez un mode</option>
                        @foreach($modes as $mode)
                            <option value="{{ $mode->id }}" {{ old('mode_reglement_id') == $mode->id ? 'selected' : '' }}>{{ $mode->nom }}</option>
                        @endforeach
                    </select>
                </label>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <a href="{{ route('voyages.show', $voyage) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-6 py-3 text-slate-900 hover:bg-slate-100">Retour</a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">Valider la réservation</button>
                </div>
            </form>
        </div>
    </div>
@endsection
