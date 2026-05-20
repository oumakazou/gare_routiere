@extends('layouts.app')

@section('title', $autocar->id ? 'Éditer - ' . $autocar->matricule : 'Créer un autocar')

@section('content')
<div class="space-y-6">
    <!-- Flash Messages -->
    @include('components.flash')

    <!-- Header -->
    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <h1 class="text-3xl font-bold text-slate-900">{{ $autocar->id ? 'Éditer l\'autocar' : 'Créer un nouvel autocar' }}</h1>
        <p class="mt-1 text-slate-600">{{ $autocar->id ? 'Modifiez les informations' : 'Ajouter un nouveau véhicule' }}</p>
    </div>

    <!-- Form -->
    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <form action="{{ $autocar->id ? route('admin.autocars.update', $autocar) : route('admin.autocars.store') }}" method="POST" class="space-y-6">
            @csrf
            @if($autocar->id)
                @method('PUT')
            @endif

            <!-- Matricule -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Matricule <span class="text-red-600">*</span></label>
                <input type="text" name="matricule" value="{{ old('matricule', $autocar->matricule) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" required />
                @error('matricule')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Capacité -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Capacité (places) <span class="text-red-600">*</span></label>
                <input type="number" name="capacite" value="{{ old('capacite', $autocar->capacite) }}" min="1" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" required />
                @error('capacite')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Société -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Société <span class="text-red-600">*</span></label>
                <select name="societe_id" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" required>
                    <option value="">Sélectionnez une société</option>
                    @foreach($societes as $societe)
                        <option value="{{ $societe->id }}" {{ old('societe_id', $autocar->societe_id) == $societe->id ? 'selected' : '' }}>{{ $societe->nom }}</option>
                    @endforeach
                </select>
                @error('societe_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Type <span class="text-red-600">*</span></label>
                <select name="type" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" required>
                    <option value="">Sélectionnez un type</option>
                    <option value="local" {{ old('type', $autocar->type) === 'local' ? 'selected' : '' }}>Local</option>
                    <option value="external" {{ old('type', $autocar->type) === 'external' ? 'selected' : '' }}>Externe</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Équipements -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-3">Équipements</label>
                <div class="space-y-2">
                    @foreach($equipements as $equip)
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="equipements[]" value="{{ $equip->id }}" {{ $autocar->equipements->contains($equip->id) || in_array($equip->id, old('equipements', [])) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300" />
                            <span class="text-slate-700">{{ $equip->nom }}</span>
                        </label>
                    @endforeach
                </div>
                @error('equipements')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Options -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-3">Options</label>
                <div class="space-y-2">
                    @foreach($options as $option)
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="options[]" value="{{ $option->id }}" {{ $autocar->options->contains($option->id) || in_array($option->id, old('options', [])) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300" />
                            <span class="text-slate-700">{{ $option->nom }}</span>
                        </label>
                    @endforeach
                </div>
                @error('options')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4 border-t border-slate-200">
                <a href="{{ route('admin.autocars.index') }}" class="rounded-2xl border border-slate-300 px-6 py-3 text-slate-700 font-semibold hover:bg-slate-100 transition">← Annuler</a>
                <button type="submit" class="rounded-2xl bg-red-600 px-6 py-3 text-white font-semibold hover:bg-red-700 transition">{{ $autocar->id ? 'Mettre à jour' : 'Créer' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
