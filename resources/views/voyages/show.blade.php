@extends('layouts.app')

@section('title', 'Voyage - ' . $voyage->villeDepart->nom . ' → ' . $voyage->villeArrivee->nom)

@section('content')
    @include('components.flash')
    
    <div class="space-y-6">
        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.2em] text-slate-500">{{ $voyage->typeVoyage->nom }}</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-900">{{ $voyage->villeDepart->nom }} → {{ $voyage->villeArrivee->nom }}</h1>
                    <p class="mt-2 text-slate-600">Départ le {{ $voyage->date_depart->format('d/m/Y') }} à {{ $voyage->heure_depart->format('H:i') }}</p>
                </div>
                <div class="rounded-3xl bg-slate-50 px-6 py-5 text-right">
                    <p class="text-sm text-slate-500">Prix</p>
                    <p class="mt-1 text-4xl font-semibold text-slate-900">{{ number_format($voyage->price, 2, ',', ' ') }} MAD</p>
                    @if($voyage->is_special)
                        <span class="mt-3 inline-flex rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-rose-700">Offre spéciale</span>
                    @endif
                </div>
            </div>

            <div class="mt-8 grid gap-4 md:grid-cols-2">
                <div class="rounded-3xl bg-slate-50 p-6">
                    <h2 class="text-lg font-semibold text-slate-900">Autocar</h2>
                    <p class="mt-3 text-slate-700">Matricule: {{ $voyage->autocar->matricule }}</p>
                    <p class="mt-2 text-slate-700">Capacité: {{ $voyage->autocar->capacite }} places</p>
                    <p class="mt-2 text-slate-700">Société: {{ $voyage->autocar->societe->nom }}</p>
                </div>
                <div class="rounded-3xl bg-slate-50 p-6">
                    <h2 class="text-lg font-semibold text-slate-900">Équipements & options</h2>
                    <p class="mt-3 text-slate-700"><span class="font-semibold">Équipements:</span> {{ $voyage->autocar->equipements->pluck('nom')->join(' • ') ?: 'Aucun' }}</p>
                    <p class="mt-2 text-slate-700"><span class="font-semibold">Options:</span> {{ $voyage->autocar->options->pluck('nom')->join(' • ') ?: 'Aucune' }}</p>
                </div>
            </div>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-6 py-3 text-slate-900 hover:bg-slate-100">Retour</a>
                @auth
                    <a href="{{ route('reservations.create', $voyage) }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">Réserver maintenant</a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">Connectez-vous pour réserver</a>
                @endauth
            </div>
        </div>
    </div>
@endsection
