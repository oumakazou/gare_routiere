@extends('layouts.app')

@section('title', 'Voyages - Gare Routière')

@section('content')
@include('components.flash')

<section class="space-y-6">
    <!-- SEARCH & FILTER BAR -->
    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <div class="mb-4">
            <h1 class="text-3xl font-semibold text-slate-900">Rechercher un voyage</h1>
            <p class="mt-1 text-slate-600">Explorez tous les trajets disponibles</p>
        </div>

        <form action="{{ route('voyages.index') }}" method="GET" class="space-y-6">
            <!-- Main Search Row -->
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Ville de départ</span>
                    <select name="ville_depart" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <option value="">Toutes</option>
                        @foreach($villes as $ville)
                            <option value="{{ $ville->id }}" {{ ($searchParams['ville_depart'] ?? '') == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Ville d'arrivée</span>
                    <select name="ville_arrivee" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <option value="">Toutes</option>
                        @foreach($villes as $ville)
                            <option value="{{ $ville->id }}" {{ ($searchParams['ville_arrivee'] ?? '') == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Date</span>
                    <input type="date" name="date" value="{{ $searchParams['date'] ?? '' }}" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" />
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Type de voyage</span>
                    <select name="type_voyage" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <option value="">Tous</option>
                        @foreach($typeVoyages as $type)
                            <option value="{{ $type->id }}" {{ ($searchParams['type_voyage'] ?? '') == $type->id ? 'selected' : '' }}>{{ $type->nom }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Période</span>
                    <select name="time_period" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <option value="">Toute la journée</option>
                        <option value="morning" {{ ($searchParams['time_period'] ?? '') === 'morning' ? 'selected' : '' }}>Matin (05:00 - 12:00)</option>
                        <option value="evening" {{ ($searchParams['time_period'] ?? '') === 'evening' ? 'selected' : '' }}>Soir (18:00 - 23:59)</option>
                    </select>
                </label>
            </div>

            <!-- Advanced Filters -->
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Prix min (MAD)</span>
                    <input type="number" name="price_min" value="{{ $searchParams['price_min'] ?? '' }}" min="0" step="0.01" placeholder="0" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" />
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Prix max (MAD)</span>
                    <input type="number" name="price_max" value="{{ $searchParams['price_max'] ?? '' }}" min="0" step="0.01" placeholder="5000" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" />
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Tri</span>
                    <select name="sort" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <option value="date" {{ ($searchParams['sort'] ?? '') === 'date' ? 'selected' : '' }}>Date & Heure</option>
                        <option value="price_asc" {{ ($searchParams['sort'] ?? '') === 'price_asc' ? 'selected' : '' }}>Prix (croissant)</option>
                        <option value="price_desc" {{ ($searchParams['sort'] ?? '') === 'price_desc' ? 'selected' : '' }}>Prix (décroissant)</option>
                    </select>
                </label>

                <div class="flex items-end gap-2">
                    <button type="submit" class="w-full rounded-2xl bg-blue-600 px-6 py-3 text-white font-medium hover:bg-blue-700 transition">Rechercher</button>
                </div>
            </div>

            <!-- Equipment & Options Filter (Optional) -->
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="col-span-full">
                    <p class="text-sm font-medium text-slate-700 mb-3">Filtrer par équipements/options (optionnel)</p>
                </div>
            </div>
        </form>

        <!-- Clear Filters Button -->
        @if(collect($searchParams)->filter()->isNotEmpty())
            <div class="mt-4 flex gap-2">
                <a href="{{ route('voyages.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                    Réinitialiser les filtres
                </a>
            </div>
        @endif
    </div>

    <!-- RESULTS SUMMARY & SORT -->
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-slate-600">
                Affichage <span class="font-semibold text-slate-900">{{ $voyages->count() }}</span> de 
                <span class="font-semibold text-slate-900">{{ $voyages->total() }}</span> résultats
            </p>
        </div>
    </div>

    <!-- VOYAGES LIST -->
    @if($voyages->count() > 0)
        <div class="grid gap-6">
            @foreach($voyages as $voyage)
                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 hover:shadow-lg transition">
                    <!-- Top Row: Route & Price -->
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                        <!-- Route Info -->
                        <div class="flex-1">
                            <!-- Type Badge -->
                            <div class="flex items-center gap-2 mb-3">
                                <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">
                                    {{ $voyage->typeVoyage->nom }}
                                </span>
                                @if($voyage->is_special)
                                    <span class="inline-flex rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-rose-700">
                                        🔥 Tarif spécial
                                    </span>
                                @endif
                            </div>

                            <!-- Route -->
                            <h2 class="text-2xl font-bold text-slate-900">
                                {{ $voyage->villeDepart->nom }} 
                                <span class="text-slate-500">→</span> 
                                {{ $voyage->villeArrivee->nom }}
                            </h2>

                            <!-- Date & Time -->
                            <p class="mt-2 text-slate-600">
                                <span class="font-semibold">{{ $voyage->date_depart->format('d/m/Y') }}</span> 
                                • 
                                <span class="font-semibold">{{ $voyage->heure_depart->format('H:i') }}</span> 
                                → 
                                <span class="font-semibold">{{ $voyage->heure_arrivee->format('H:i') }}</span>
                            </p>
                        </div>

                        <!-- Price Card -->
                        <div class="rounded-3xl bg-gradient-to-br from-blue-50 to-blue-100 px-6 py-5 text-right">
                            <p class="text-sm text-slate-600">Prix</p>
                            <p class="mt-1 text-4xl font-bold text-blue-900">
                                {{ number_format($voyage->price, 2, ',', ' ') }} MAD
                            </p>
                            @if($voyage->is_special)
                                <p class="mt-2 text-xs text-slate-600">
                                    <span class="line-through">{{ number_format($voyage->base_price, 2, ',', ' ') }} MAD</span>
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Details Row -->
                    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <!-- Autocar -->
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-700">Autocar</p>
                            <p class="mt-2 text-slate-900">{{ $voyage->autocar->matricule }}</p>
                            <p class="mt-1 text-xs text-slate-500">{{ $voyage->autocar->societe->nom }}</p>
                        </div>

                        <!-- Capacity -->
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-700">Capacité</p>
                            <p class="mt-2 text-slate-900">{{ $voyage->autocar->capacite }} places</p>
                            @php
                                $reserved = $voyage->reservations->sum('nombre_places');
                                $available = $voyage->autocar->capacite - $reserved;
                            @endphp
                            @if($available < 5 && $available > 0)
                                <p class="mt-1 text-xs text-rose-600 font-semibold">⚠️ Plus que {{ $available }} places</p>
                            @elseif($available <= 0)
                                <p class="mt-1 text-xs text-rose-600 font-semibold">❌ Complet</p>
                            @else
                                <p class="mt-1 text-xs text-green-600">{{ $available }} places disponibles</p>
                            @endif
                        </div>

                        <!-- Equipements -->
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-700">Équipements</p>
                            @if($voyage->autocar->equipements->count() > 0)
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @foreach($voyage->autocar->equipements as $equip)
                                        <span class="inline-flex items-center rounded-full bg-slate-200 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                            @if(strtolower($equip->nom) === 'wifi')
                                                📡 {{ $equip->nom }}
                                            @elseif(strtolower($equip->nom) === 'climatisation')
                                                ❄️ {{ $equip->nom }}
                                            @elseif(strtolower($equip->nom) === 'toilettes')
                                                🚻 {{ $equip->nom }}
                                            @else
                                                ✓ {{ $equip->nom }}
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <p class="mt-2 text-xs text-slate-600">Aucun</p>
                            @endif
                        </div>

                        <!-- Options -->
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="text-sm font-semibold text-slate-700">Options</p>
                            @if($voyage->autocar->options->count() > 0)
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @foreach($voyage->autocar->options as $option)
                                        <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                            ⭐ {{ $option->nom }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <p class="mt-2 text-xs text-slate-600">Aucune</p>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <a href="{{ route('voyages.show', $voyage) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-6 py-3 text-slate-900 font-medium hover:bg-slate-100 transition">
                            Détails complets
                        </a>
                        @if($available > 0)
                            @auth
                                <a href="{{ route('reservations.create', $voyage) }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-8 py-3 text-white font-semibold hover:bg-blue-700 transition">
                                    👉 Réserver maintenant
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-8 py-3 text-white font-semibold hover:bg-blue-700 transition">
                                    Connectez-vous pour réserver
                                </a>
                            @endauth
                        @else
                            <button disabled class="inline-flex items-center justify-center rounded-2xl bg-slate-300 px-8 py-3 text-slate-600 font-semibold cursor-not-allowed">
                                Complet
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- PAGINATION -->
        @if($voyages->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $voyages->links('pagination::tailwind') }}
            </div>
        @endif
    @else
        <!-- EMPTY STATE -->
        <div class="rounded-3xl bg-white p-12 shadow-sm border border-slate-200 text-center">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="mt-4 text-lg font-semibold text-slate-900">Aucun voyage trouvé</h3>
            <p class="mt-2 text-slate-600">
                Essayez de modifier vos critères de recherche ou
                <a href="{{ route('voyages.index') }}" class="font-semibold text-blue-600 hover:text-blue-700">
                    réinitialiser les filtres
                </a>
            </p>
        </div>
    @endif
</section>
@endsection
