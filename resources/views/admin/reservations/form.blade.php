cd "c:\Users\Ayoub\Gare Routière"
php artisan migrate --seed
php artisan serve@extends('layouts.app')

@section('title', 'Accueil - Gare Routière')

@section('content')
    @include('components.flash')

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-red-600 via-red-700 to-slate-800 text-white">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h1 class="text-4xl font-bold tracking-tight sm:text-6xl">
                    محطة الحافلات
                </h1>
                <h2 class="mt-4 text-xl font-semibold sm:text-2xl">
                    Gare Routière
                </h2>
                <p class="mt-6 text-lg leading-8 text-red-100">
                    Réservez votre voyage en bus de manière simple et rapide. Découvrez nos destinations et partez l'esprit tranquille.
                </p>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="relative -mt-16 pb-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-4xl">
                <div class="rounded-3xl bg-white p-8 shadow-2xl ring-1 ring-slate-200">
                    <h2 class="text-2xl font-bold text-slate-900 text-center mb-6">Rechercher un voyage</h2>

                    <form action="{{ route('home') }}" method="GET" class="grid gap-6 md:grid-cols-3">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Ville de départ</label>
                            <select name="ville_depart" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 transition-colors">
                                <option value="">Toutes les villes</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->id }}" {{ request('ville_depart') == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Ville d'arrivée</label>
                            <select name="ville_arrivee" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 transition-colors">
                                <option value="">Toutes les villes</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->id }}" {{ request('ville_arrivee') == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Date de départ</label>
                            <input type="date" name="date" value="{{ request('date') }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 transition-colors">
                        </div>

                        <div class="md:col-span-3 flex justify-center">
                            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-red-600 px-8 py-3 text-white font-semibold shadow-lg hover:bg-red-700 hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Voyages Section -->
    <section class="py-16 bg-slate-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-slate-900">Voyages disponibles</h2>
                <p class="mt-4 text-lg text-slate-600">Découvrez nos offres de voyages et réservez votre place</p>
            </div>

            @if($voyages->count() > 0)
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($voyages as $voyage)
                        <article class="rounded-2xl bg-white p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-slate-200">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-slate-900">
                                        {{ $voyage->villeDepart->nom }} → {{ $voyage->villeArrivee->nom }}
                                    </h3>
                                    <p class="text-sm text-slate-600 mt-1">{{ $voyage->societe->nom }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-red-600">{{ number_format($voyage->base_price, 2, ',', ' ') }} MAD</p>
                                    <p class="text-xs text-slate-500">par personne</p>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center text-slate-600">
                                    <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm">
                                        Départ: {{ $voyage->heure_depart->format('H:i') }} •
                                        Arrivée: {{ $voyage->heure_arrivee->format('H:i') }}
                                    </span>
                                </div>

                                <div class="flex items-center text-slate-600">
                                    <svg class="w-5 h-5 mr-2 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-sm">{{ $voyage->date_depart->format('d/m/Y') }}</span>
                                </div>

                                <div class="flex items-center text-slate-600">
                                    <svg class="w-5 h-5 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    <span class="text-sm">{{ $voyage->autocar->capacite }} places disponibles</span>
                                </div>
                            </div>

                            <div class="mt-6">
                                @auth
                                    <a href="{{ route('reservations.create', $voyage) }}" class="w-full inline-flex items-center justify-center rounded-xl bg-red-600 px-6 py-3 text-white font-semibold hover:bg-red-700 transition-colors duration-200">
                                        Réserver maintenant
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center rounded-xl bg-slate-600 px-6 py-3 text-white font-semibold hover:bg-slate-700 transition-colors duration-200">
                                        Se connecter pour réserver
                                    </a>
                                @endauth
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-slate-900">Aucun voyage trouvé</h3>
                    <p class="mt-2 text-slate-600">Essayez de modifier vos critères de recherche.</p>
                </div>
            @endif
        </div>
    </section>
@endsection@extends('layouts.app')
@extends('layouts.app')

@section('title', 'Accueil - Gare Routière')

@section('content')
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-red-600">Gare Routière</h1>
                    </div>
                    <div class="hidden md:block ml-10">
                        <div class="flex items-baseline space-x-4">
                            <a href="{{ route('home') }}" class="text-gray-900 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Accueil</a>
                            <a href="#" class="text-gray-500 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Voyages</a>
                            <a href="#" class="text-gray-500 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">À propos</a>
                            <a href="#" class="text-gray-500 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Contact</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Inscription</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-red-600 via-slate-600 to-slate-800 text-white overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute inset-0">
            <!-- Bus illustration placeholder -->
            <svg class="absolute bottom-0 right-0 w-96 h-96 opacity-10" viewBox="0 0 400 400" fill="currentColor">
                <path d="M50 300 L350 300 L340 250 L60 250 Z M70 250 L70 200 L330 200 L330 250 M80 200 L80 150 L320 150 L320 200 M90 150 L90 100 L310 100 L310 150 M100 100 L100 50 L300 50 L300 100 M120 50 L120 20 L280 20 L280 50"/>
                <circle cx="120" cy="320" r="20"/>
                <circle cx="280" cy="320" r="20"/>
            </svg>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32">
            <div class="text-center">
                <h1 class="text-4xl sm:text-6xl font-bold mb-6">
                    Réservez votre voyage facilement
                </h1>
                <p class="text-xl sm:text-2xl text-red-100 mb-2">
                    Voyagez en toute sérénité avec notre plateforme moderne
                </p>
                <p class="text-lg text-slate-200">
                    سافر بأمان مع منصتنا الحديثة
                </p>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="relative -mt-16 pb-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 text-center mb-8">Rechercher un voyage</h2>

                <form action="{{ route('home') }}" method="GET" class="grid gap-6 md:grid-cols-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ville de départ</label>
                        <select name="ville_depart" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 transition-colors">
                            <option value="">Toutes les villes</option>
                            @foreach($villes as $ville)
                                <option value="{{ $ville->id }}" {{ request('ville_depart') == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ville d'arrivée</label>
                        <select name="ville_arrivee" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 transition-colors">
                            <option value="">Toutes les villes</option>
                            @foreach($villes as $ville)
                                <option value="{{ $ville->id }}" {{ request('ville_arrivee') == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date de départ</label>
                        <input type="date" name="date" value="{{ request('date') }}" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 transition-colors">
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-slate-600 hover:from-red-700 hover:to-slate-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Voyages Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Voyages disponibles</h2>
                <p class="mt-4 text-lg text-gray-600">Découvrez nos offres et réservez votre place</p>
            </div>

            @if($voyages->count() > 0)
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($voyages as $voyage)
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-slate-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                            {{ substr($voyage->autocar->societe->nom, 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $voyage->autocar->societe->nom }}</h3>
                                            <p class="text-sm text-gray-500">{{ $voyage->autocar->modele ?? 'Bus moderne' }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 text-neutral-800">
                                            Disponible
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-2xl font-bold text-gray-900">{{ $voyage->villeDepart->nom }}</p>
                                            <p class="text-sm text-gray-500">Départ</p>
                                        </div>
                                        <div class="flex-1 mx-4 text-center">
                                            <svg class="w-6 h-6 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-2xl font-bold text-gray-900">{{ $voyage->villeArrivee->nom }}</p>
                                            <p class="text-sm text-gray-500">Arrivée</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <p class="text-sm text-gray-500">Heure départ</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $voyage->heure_depart->format('H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Heure arrivée</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $voyage->heure_arrivee->format('H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Date</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $voyage->date_depart->format('d/m/Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Places restantes</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $voyage->autocar->capacite - $voyage->reservations->sum('nombre_places') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-3xl font-bold text-red-600">{{ number_format($voyage->base_price, 2, ',', ' ') }} DH</p>
                                        <p class="text-sm text-gray-500">par personne</p>
                                    </div>
                                    @auth
                                        <a href="{{ route('reservations.create', $voyage) }}" class="bg-gradient-to-r from-red-600 to-slate-600 hover:from-red-700 hover:to-slate-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                            Réserver maintenant
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-xl transition-colors duration-200">
                                            Se connecter
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucun voyage trouvé</h3>
                    <p class="mt-2 text-gray-600">Essayez de modifier vos critères de recherche pour trouver des voyages disponibles.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('title', $reservation->id ? 'Éditer une réservation' : 'Créer une réservation')

@section('content')
<div class="space-y-6">
    @include('components.flash')

    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <h1 class="text-3xl font-bold text-slate-900">{{ $reservation->id ? 'Éditer la réservation' : 'Créer une nouvelle réservation' }}</h1>
        <p class="mt-1 text-slate-600">Gérez les réservations des clients et ajustez les détails si nécessaire.</p>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <form action="{{ $reservation->id ? route('admin.reservations.update', $reservation) : route('admin.reservations.store') }}" method="POST" class="space-y-6 max-w-3xl">
            @csrf
            @if($reservation->id)
                @method('PUT')
            @endif

            <div class="grid gap-4 lg:grid-cols-2">
                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Client</span>
                    <select name="user_id" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" required>
                        <option value="">Sélectionnez un utilisateur</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $reservation->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Voyage</span>
                    <select name="voyage_id" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" required>
                        <option value="">Sélectionnez un voyage</option>
                        @foreach($voyages as $voyage)
                            <option value="{{ $voyage->id }}" {{ old('voyage_id', $reservation->voyage_id) == $voyage->id ? 'selected' : '' }}>
                                {{ $voyage->villeDepart->nom }} → {{ $voyage->villeArrivee->nom }} • {{ $voyage->heure_depart->format('H:i') }} - {{ $voyage->heure_arrivee->format('H:i') }} • {{ $voyage->price }}€
                            </option>
                        @endforeach
                    </select>
                    @error('voyage_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </label>
            </div>

            <div class="grid gap-4 lg:grid-cols-2">
                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Nombre de places</span>
                    <input type="number" name="nombre_places" value="{{ old('nombre_places', $reservation->nombre_places ?? 1) }}" min="1" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" required />
                    @error('nombre_places')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Mode de règlement</span>
                    <select name="mode_reglement_id" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" required>
                        <option value="">Sélectionnez un mode</option>
                        @foreach($modes as $mode)
                            <option value="{{ $mode->id }}" {{ old('mode_reglement_id', $reservation->mode_reglement_id) == $mode->id ? 'selected' : '' }}>{{ $mode->nom }}</option>
                        @endforeach
                    </select>
                    @error('mode_reglement_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </label>
            </div>

            <div class="grid gap-4 lg:grid-cols-2">
                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Date de réservation</span>
                    <input type="date" name="date_reservation" value="{{ old('date_reservation', $reservation->date_reservation?->format('Y-m-d') ?? now()->toDateString()) }}" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" required />
                    @error('date_reservation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Statut</span>
                    <select name="status" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" required>
                        <option value="confirmee" {{ old('status', $reservation->status) === 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                        <option value="en_attente" {{ old('status', $reservation->status) === 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="annulee" {{ old('status', $reservation->status) === 'annulee' ? 'selected' : '' }}>Annulée</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </label>
            </div>

            <div class="flex gap-3 pt-4 border-t">
                <a href="{{ route('admin.reservations.index') }}" class="rounded-2xl border border-slate-300 px-6 py-3 text-slate-700 font-semibold hover:bg-slate-100">← Annuler</a>
                <button type="submit" class="rounded-2xl bg-red-600 px-6 py-3 text-white font-semibold hover:bg-red-700">{{ $reservation->id ? 'Mettre à jour' : 'Créer' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
