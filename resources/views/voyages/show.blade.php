@extends('layouts.app')

@section('title', 'Voyage - ' . $voyage->villeDepart->nom . ' → ' . $voyage->villeArrivee->nom)

@section('content')
<div class="space-y-6">
    @include('components.flash')

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-6 xl:flex-row xl:items-start xl:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-600">{{ $voyage->typeVoyage->nom }}</p>
                <h1 class="mt-3 text-3xl font-bold text-slate-900">{{ $voyage->villeDepart->nom }} → {{ $voyage->villeArrivee->nom }}</h1>
                <p class="mt-3 text-slate-600">Départ le {{ $voyage->date_depart->format('d/m/Y') }} à {{ $voyage->heure_depart->format('H:i') }}</p>
            </div>

            <div class="rounded-3xl bg-slate-950 px-6 py-5 text-white shadow-lg shadow-slate-900/10">
                <p class="text-sm text-slate-300">Prix</p>
                <p class="mt-1 text-4xl font-bold">{{ number_format((float) $voyage->price, 2, ',', ' ') }} DH</p>
                <p class="mt-3 text-sm text-cyan-300">{{ $voyage->available_seats }} places disponibles</p>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900">Informations du voyage</h2>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Ville de départ</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ $voyage->villeDepart->nom }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Ville d'arrivée</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ $voyage->villeArrivee->nom }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Date de départ</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ $voyage->date_depart->format('d/m/Y') }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Heure de départ</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ $voyage->heure_depart->format('H:i') }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Heure d'arrivée</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ $voyage->heure_arrivee->format('H:i') }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Places disponibles</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ $voyage->available_seats }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900">Informations complémentaires</h2>
            <div class="mt-6 space-y-4">
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Type de voyage</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ $voyage->typeVoyage->nom }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Autocar</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ $voyage->autocar->matricule }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Société</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ $voyage->autocar->societe->nom }}</p>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Capacité associée</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ $voyage->autocar->capacite }} places</p>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
            <a href="{{ route('voyages.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                Retour à la liste
            </a>

            <div class="flex flex-wrap gap-3">
                @auth
                    @if($voyage->available_seats > 0)
                        <a href="{{ route('reservations.create', $voyage) }}" class="inline-flex items-center justify-center rounded-2xl bg-cyan-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-400">
                            Réserver
                        </a>
                    @endif
                @endauth

                <a href="{{ route('voyages.edit', $voyage) }}" class="inline-flex items-center justify-center rounded-2xl bg-red-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700">
                    Modifier
                </a>

                <form action="{{ route('voyages.destroy', $voyage) }}" method="POST" onsubmit="return confirm('Supprimer ce voyage ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl border border-red-200 bg-red-50 px-5 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
