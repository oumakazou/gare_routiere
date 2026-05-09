@extends('layouts.app')

@section('title', $voyage->id ? 'Éditer voyage' : 'Créer un voyage')

@section('content')
<div class="space-y-6">
    @include('components.flash')

    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <h1 class="text-3xl font-bold text-slate-900">{{ $voyage->id ? 'Éditer le voyage' : 'Créer un nouveau voyage' }}</h1>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <form action="{{ $voyage->id ? route('admin.voyages.update', $voyage) : route('admin.voyages.store') }}" method="POST" class="space-y-6">
            @csrf
            @if($voyage->id)
                @method('PUT')
            @endif

            <div class="grid gap-4 lg:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Ville de départ <span class="text-red-600">*</span></label>
                    <select name="ville_depart_id" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required>
                        <option value="">Sélectionnez</option>
                        @foreach($villes as $v)
                            <option value="{{ $v->id }}" {{ old('ville_depart_id', $voyage->ville_depart_id) == $v->id ? 'selected' : '' }}>{{ $v->nom }}</option>
                        @endforeach
                    </select>
                    @error('ville_depart_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Ville d'arrivée <span class="text-red-600">*</span></label>
                    <select name="ville_arrivee_id" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required>
                        <option value="">Sélectionnez</option>
                        @foreach($villes as $v)
                            <option value="{{ $v->id }}" {{ old('ville_arrivee_id', $voyage->ville_arrivee_id) == $v->id ? 'selected' : '' }}>{{ $v->nom }}</option>
                        @endforeach
                    </select>
                    @error('ville_arrivee_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid gap-4 lg:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Date <span class="text-red-600">*</span></label>
                    <input type="date" name="date_depart" value="{{ old('date_depart', $voyage->date_depart?->format('Y-m-d')) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required />
                    @error('date_depart')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Autocar <span class="text-red-600">*</span></label>
                    <select name="autocar_id" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required>
                        <option value="">Sélectionnez</option>
                        @foreach($autocars as $a)
                            <option value="{{ $a->id }}" {{ old('autocar_id', $voyage->autocar_id) == $a->id ? 'selected' : '' }}>{{ $a->matricule }} ({{ $a->societe->nom }})</option>
                        @endforeach
                    </select>
                    @error('autocar_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid gap-4 lg:grid-cols-3">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Heure départ <span class="text-red-600">*</span></label>
                    <input type="time" name="heure_depart" value="{{ old('heure_depart', $voyage->heure_depart?->format('H:i')) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required />
                    @error('heure_depart')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Heure arrivée <span class="text-red-600">*</span></label>
                    <input type="time" name="heure_arrivee" value="{{ old('heure_arrivee', $voyage->heure_arrivee?->format('H:i')) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required />
                    @error('heure_arrivee')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Type <span class="text-red-600">*</span></label>
                    <select name="type_voyage_id" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required>
                        <option value="">Sélectionnez</option>
                        @foreach($typeVoyages as $t)
                            <option value="{{ $t->id }}" {{ old('type_voyage_id', $voyage->type_voyage_id) == $t->id ? 'selected' : '' }}>{{ $t->nom }}</option>
                        @endforeach
                    </select>
                    @error('type_voyage_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid gap-4 lg:grid-cols-2">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Prix de base (DH) <span class="text-red-600">*</span></label>
                    <input type="number" name="base_price" value="{{ old('base_price', $voyage->base_price) }}" step="0.01" min="0" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required />
                    @error('base_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="flex items-center gap-3 mt-6 cursor-pointer">
                        <input type="checkbox" name="is_special" value="1" {{ old('is_special', $voyage->is_special) ? 'checked' : '' }} class="w-4 h-4 rounded" />
                        <span class="text-sm font-semibold text-slate-700">Offre spéciale (x1.3 prix)</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t">
                <a href="{{ route('admin.voyages.index') }}" class="rounded-2xl border border-slate-300 px-6 py-3 text-slate-700 font-semibold hover:bg-slate-100">← Annuler</a>
                <button type="submit" class="rounded-2xl bg-blue-600 px-6 py-3 text-white font-semibold hover:bg-blue-700">{{ $voyage->id ? 'Mettre à jour' : 'Créer' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
