@extends('layouts.app')

@section('title', 'Accueil - Gare Routière')

@section('content')
    @include('components.flash')
    
    <section class="space-y-6">
        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-semibold text-slate-900">Recherchez votre voyage</h1>
                    <p class="mt-2 text-slate-600">Trouvez un trajet de bus entre vos villes préférées.</p>
                </div>
            </div>

            <form action="{{ route('home') }}" method="GET" class="mt-6 grid gap-4 sm:grid-cols-3">
                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Ville de départ</span>
                    <select name="ville_depart" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <option value="">Toutes</option>
                        @foreach($villes as $ville)
                            <option value="{{ $ville->id }}" {{ (string)($search['ville_depart'] ?? '') === (string)$ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Ville d'arrivée</span>
                    <select name="ville_arrivee" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <option value="">Toutes</option>
                        @foreach($villes as $ville)
                            <option value="{{ $ville->id }}" {{ (string)($search['ville_arrivee'] ?? '') === (string)$ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Date</span>
                    <input type="date" name="date" value="{{ $search['date'] ?? '' }}" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" />
                </label>

                <div class="sm:col-span-3 flex justify-end">
                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-white shadow-sm hover:bg-blue-700">Chercher</button>
                </div>
            </form>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            @forelse($voyages as $voyage)
                <article class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">{{ $voyage->typeVoyage->nom }}</p>
                            <h2 class="mt-2 text-2xl font-semibold text-slate-900">{{ $voyage->villeDepart->nom }} → {{ $voyage->villeArrivee->nom }}</h2>
                            <p class="mt-1 text-slate-600">Départ le {{ $voyage->date_depart->format('d/m/Y') }} à {{ $voyage->heure_depart->format('H:i') }}</p>
                        </div>
                        <div class="rounded-3xl bg-slate-100 px-4 py-3 text-right">
                            <p class="text-sm text-slate-500">Prix</p>
                            <p class="mt-1 text-3xl font-semibold text-slate-900">{{ number_format($voyage->price, 2, ',', ' ') }} MAD</p>
                            @if($voyage->is_special)
                                <span class="mt-2 inline-flex rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-rose-700">Offre spéciale</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-3xl bg-slate-50 p-4">
                            <p class="text-sm font-medium text-slate-700">Autocar</p>
                            <p class="mt-1 text-slate-900">{{ $voyage->autocar->matricule }} ({{ $voyage->autocar->capacite }} places)</p>
                            <p class="mt-1 text-sm text-slate-500">Société: {{ $voyage->autocar->societe->nom }}</p>
                        </div>
                        <div class="rounded-3xl bg-slate-50 p-4">
                            <p class="text-sm font-medium text-slate-700">Équipements</p>
                            <p class="mt-1 text-slate-900">{{ $voyage->autocar->equipements->pluck('nom')->join(' • ') ?: 'Aucun' }}</p>
                            <p class="mt-1 text-sm text-slate-500">Options: {{ $voyage->autocar->options->pluck('nom')->join(' • ') ?: 'Aucune' }}</p>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <a href="{{ route('voyages.show', $voyage) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-6 py-3 text-slate-900 hover:bg-slate-100">Détails</a>
                        <a href="{{ route('reservations.create', $voyage) }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">Réserver</a>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 col-span-full">
                    <p class="text-slate-700">Aucun voyage trouvé pour ces critères. Essayez une autre combinaison.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
