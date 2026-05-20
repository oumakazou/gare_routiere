@extends('layouts.app')

@section('title', $societe->id ? 'Éditer - ' . $societe->nom : 'Créer une société')

@section('content')
<div class="space-y-6">
    @include('components.flash')

    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <h1 class="text-3xl font-bold text-slate-900">{{ $societe->id ? 'Éditer la société' : 'Créer une nouvelle société' }}</h1>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <form action="{{ $societe->id ? route('admin.societes.update', $societe) : route('admin.societes.store') }}" method="POST" class="space-y-6 max-w-md">
            @csrf
            @if($societe->id)
                @method('PUT')
            @endif

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nom <span class="text-red-600">*</span></label>
                <input type="text" name="nom" value="{{ old('nom', $societe->nom) }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-red-500 focus:ring-2 focus:ring-red-200" required />
                @error('nom')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Contact</label>
                <input type="text" name="contact" value="{{ old('contact', $societe->contact) }}" placeholder="Téléphone ou email" class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:border-red-500 focus:ring-2 focus:ring-red-200" />
                @error('contact')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-4 border-t">
                <a href="{{ route('admin.societes.index') }}" class="rounded-2xl border border-slate-300 px-6 py-3 text-slate-700 font-semibold hover:bg-slate-100">← Annuler</a>
                <button type="submit" class="rounded-2xl bg-red-600 px-6 py-3 text-white font-semibold hover:bg-red-700">{{ $societe->id ? 'Mettre à jour' : 'Créer' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
