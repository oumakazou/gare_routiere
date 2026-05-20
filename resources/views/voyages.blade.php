@extends('layouts.app')

@section('title', 'Voyages - Gare Routière')

@section('content')
@include('components.flash')

<section class="space-y-6">
    <!-- SEARCH & FILTER FORM -->
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
                    <select name="ville_depart" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200">
                        <option value="">Toutes</option>
                        @foreach($villes as $ville)
                            <option value="{{ $ville->id }}" {{ ($searchParams['ville_depart'] ?? ($ville->nom == 'Taza' ? $ville->id : '')) == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Ville d'arrivée</span>
                    <select name="ville_arrivee" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200">
                        <option value="">Toutes</option>
                        @foreach($villes as $ville)
                            <option value="{{ $ville->id }}" {{ ($searchParams['ville_arrivee'] ?? '') == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Date</span>
                    <input type="date" name="date" value="{{ $searchParams['date'] ?? '' }}" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" />
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Type de voyage</span>
                    <select name="type_voyage" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200">
                        <option value="">Tous</option>
                        @foreach($typeVoyages as $type)
                            <option value="{{ $type->id }}" {{ ($searchParams['type_voyage'] ?? '') == $type->id ? 'selected' : '' }}>{{ $type->nom }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Période</span>
                    <select name="time_period" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200">
                        <option value="">Toute la journée</option>
                        <option value="morning" {{ ($searchParams['time_period'] ?? '') === 'morning' ? 'selected' : '' }}>Matin (05:00 - 12:00)</option>
                        <option value="evening" {{ ($searchParams['time_period'] ?? '') === 'evening' ? 'selected' : '' }}>Soir (18:00 - 23:59)</option>
                    </select>
                </label>
            </div>

            <!-- Advanced Filters -->
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Prix min (DH)</span>
                    <input type="number" name="price_min" value="{{ $searchParams['price_min'] ?? '' }}" min="0" step="0.01" placeholder="0" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" />
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Prix max (DH)</span>
                    <input type="number" name="price_max" value="{{ $searchParams['price_max'] ?? '' }}" min="0" step="0.01" placeholder="Ex: 500" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" />
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Trier par</span>
                    <select name="sort" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200">
                        <option value="date" {{ ($searchParams['sort'] ?? '') === 'date' ? 'selected' : '' }}>Date & Heure</option>
                        <option value="price_asc" {{ ($searchParams['sort'] ?? '') === 'price_asc' ? 'selected' : '' }}>Prix (croissant)</option>
                        <option value="price_desc" {{ ($searchParams['sort'] ?? '') === 'price_desc' ? 'selected' : '' }}>Prix (décroissant)</option>
                    </select>
                </label>

                <div class="flex items-end gap-2">
                    <button type="submit" class="w-full rounded-2xl bg-red-700 px-6 py-3 text-white font-medium shadow-lg shadow-blue-200/50 hover:bg-red-800 transition-all duration-300">Rechercher</button>
                </div>
            </div>

            <!-- Equipment & Options Filter -->
            <div class="pt-4 border-t border-slate-100">
                <p class="text-sm font-medium text-slate-700 mb-3">Équipements souhaités</p>
                <div class="flex flex-wrap gap-4">
                    @php $commonEquip = ['WiFi', 'Climatisation', 'Toilettes', 'Prises USB']; @endphp
                    @foreach($commonEquip as $item)
                        <label class="inline-flex items-center cursor-pointer group text-slate-600 hover:text-slate-900 transition-colors duration-200">
                            <input type="checkbox" name="equipements[]" value="{{ $item }}" class="rounded text-red-600 focus:ring-red-500 border-slate-300">
                            <span class="ml-2 text-sm text-slate-600 group-hover:text-slate-900 transition">{{ $item }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </form>

        <!-- Clear Filters Button -->
        @if(collect($searchParams)->filter()->isNotEmpty())
            <div class="mt-4 flex gap-2">
                <a href="{{ route('voyages.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Réinitialiser
                </a>
            </div>
        @endif
    </div>

    <!-- RESULTS SUMMARY & SORT -->
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-slate-600">
                Affichage <span class="font-semibold text-slate-900">{{ $voyages->count() }}</span> de 
                <span class="font-semibold text-slate-900">{{ $voyages->total() }}</span> voyages trouvés
            </p>
        </div>
    </div>

    <!-- VOYAGES LIST -->
    @if($voyages->count() > 0)
        <div class="grid gap-6">
            @foreach($voyages as $voyage) {{-- Assuming $voyage->itineraire exists and is a string --}}
                <div class="rounded-3xl bg-white p-6 shadow-lg border border-slate-100 hover:shadow-xl hover:border-red-200 transition-all duration-300 ease-in-out">
                    <!-- Top Row: Route & Price -->
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                        <!-- Route Info -->
                        <div class="flex-1">
                            <!-- Type Badge -->
                            <div class="flex items-center gap-2 mb-3">
                                <span class="inline-flex rounded-full bg-red-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-red-600">
                                    {{ $voyage->typeVoyage->nom }}
                                </span>
                                @if($voyage->is_special)
                                    <span class="inline-flex rounded-full bg-cyan-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-cyan-600">
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

                            <!-- Itinéraire / Ligne détaillée -->
                            @if($voyage->itineraire)
                                <p class="mt-1 text-sm text-slate-500 flex items-center gap-1 font-light">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span class="italic font-medium">{{ $voyage->itineraire }}</span>
                                </p>
                            @endif

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
                        <div class="rounded-3xl bg-gradient-to-br from-red-50 to-red-100 px-6 py-5 text-right shadow-inner">
                            <p class="text-sm text-slate-600">Prix</p>
                            <p class="mt-1 text-4xl font-bold text-red-900">
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
                        <div class="rounded-2xl bg-slate-50 p-4 shadow-sm border border-slate-100">
                            <p class="text-sm font-semibold text-slate-700">Autocar</p>
                            <p class="mt-2 text-slate-900">{{ $voyage->autocar->matricule }}</p>
                            <p class="mt-1 text-xs text-slate-500">{{ $voyage->autocar->societe->nom }}</p>
                        </div>

                        <!-- Capacity -->
                        <div class="rounded-2xl bg-slate-50 p-4 shadow-sm border border-slate-100">
                            <p class="text-sm font-semibold text-slate-700">Capacité</p>
                            <p class="mt-2 text-slate-900">{{ $voyage->autocar->capacite }} places</p>
                            @if($voyage->available_seats < 5 && $voyage->available_seats > 0)
                                <p class="mt-1 text-xs text-rose-600 font-bold">⚠️ Plus que {{ $voyage->available_seats }} places</p>
                            @elseif($voyage->available_seats <= 0)
                                <p class="mt-1 text-xs text-rose-600 font-bold">❌ Complet</p>
                            @else
                                <p class="mt-1 text-xs text-neutral-600 font-medium">{{ $voyage->available_seats }} places disponibles</p>
                            @endif
                        </div>

                        <!-- Equipements -->
                        <div class="rounded-2xl bg-slate-50 p-4 shadow-sm border border-slate-100">
                            <p class="text-sm font-semibold text-slate-700">Équipements</p>
                            <div class="mt-2 flex flex-wrap gap-1.5">
                                @forelse($voyage->autocar->equipements as $equip)
                                    {{-- @foreach($voyage->autocar->equipements as $equip) This inner loop is redundant --}}
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
                                @empty
                                    <p class="text-xs text-slate-500">Standard</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Options -->
                        <div class="rounded-2xl bg-slate-50 p-4 shadow-sm border border-slate-100">
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
                        <a href="{{ route('voyages.show', $voyage) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-6 py-3 text-slate-900 font-medium hover:bg-slate-100 transition-all duration-300">
                            Détails complets
                        </a>
                        @if($voyage->available_seats > 0)
                            @auth
                                <a href="{{ route('reservations.create', $voyage) }}" class="inline-flex items-center justify-center rounded-2xl bg-red-700 px-8 py-3 text-white font-semibold shadow-lg shadow-blue-300/50 hover:bg-red-800 transition-all duration-300">
                                    👉 Réserver maintenant
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl bg-slate-800 px-8 py-3 text-white font-semibold shadow-lg shadow-slate-400/30 hover:bg-slate-900 transition-all duration-300">
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
        <div class="rounded-3xl bg-white p-12 shadow-lg border border-slate-100 text-center">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="mt-4 text-lg font-semibold text-slate-900">Aucun voyage trouvé</h3>
            <p class="mt-2 text-slate-600">
                Essayez de modifier vos critères de recherche ou
                <a href="{{ route('voyages.index') }}" class="font-semibold text-red-600 hover:text-red-700">
                    réinitialiser les filtres
                </a>
            </p>
        </div>
    @endif
</section>
@endsection
