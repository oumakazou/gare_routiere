@php
    $priceValue = old('price', $voyage->getRawOriginal('price') ?? ($voyage->exists ? $voyage->price : ''));
    $availableSeatsValue = old('available_seats', $voyage->getRawOriginal('available_seats') ?? ($voyage->exists ? $voyage->available_seats : ''));
@endphp

<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <form action="{{ $action }}" method="POST" class="space-y-6">
        @csrf
        @if($method !== 'POST')
            @method($method)
        @endif

        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label for="ville_depart" class="mb-2 block text-sm font-semibold text-slate-700">Ville de départ</label>
                <input id="ville_depart" name="ville_depart" type="text" value="{{ $villeDepart->nom }}" readonly class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 text-slate-900 shadow-sm cursor-not-allowed" disabled>
                <p class="mt-2 text-xs text-slate-500">Départ automatiquement fixé à Taza</p>
            </div>

            <div>
                <label for="ville_arrivee_id" class="mb-2 block text-sm font-semibold text-slate-700">Ville d'arrivée</label>
                <select id="ville_arrivee_id" name="ville_arrivee_id" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" required>
                    <option value="">Sélectionner une ville de destination</option>
                    @foreach($villesArrivee as $ville)
                        <option value="{{ $ville->id }}" @selected(old('ville_arrivee_id', $voyage->ville_arrivee_id) == $ville->id)>{{ $ville->nom }}</option>
                    @endforeach
                </select>
                @error('ville_arrivee_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            <div>
                <label for="date_depart" class="mb-2 block text-sm font-semibold text-slate-700">Date de départ</label>
                <input id="date_depart" name="date_depart" type="date" value="{{ old('date_depart', $voyage->date_depart?->format('Y-m-d')) }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                @error('date_depart')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="heure_depart" class="mb-2 block text-sm font-semibold text-slate-700">Heure de départ</label>
                <input id="heure_depart" name="heure_depart" type="time" value="{{ old('heure_depart', $voyage->heure_depart?->format('H:i')) }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                @error('heure_depart')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="heure_arrivee" class="mb-2 block text-sm font-semibold text-slate-700">Heure d'arrivée</label>
                <input id="heure_arrivee" name="heure_arrivee" type="time" value="{{ old('heure_arrivee', $voyage->heure_arrivee?->format('H:i')) }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                @error('heure_arrivee')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label for="price" class="mb-2 block text-sm font-semibold text-slate-700">Prix (DH)</label>
                <input id="price" name="price" type="number" min="0" step="0.01" value="{{ $priceValue }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                @error('price')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="available_seats" class="mb-2 block text-sm font-semibold text-slate-700">Places disponibles</label>
                <input id="available_seats" name="available_seats" type="number" min="1" step="1" value="{{ $availableSeatsValue }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                @error('available_seats')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-col gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-between">
            <a href="{{ route('voyages.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                Annuler
            </a>
            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:bg-blue-700">
                {{ $submitLabel }}
            </button>
        </div>
    </form>
</div>
