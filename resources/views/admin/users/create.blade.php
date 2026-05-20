@extends('layouts.admin')

@section('title', 'Nouvel utilisateur')

@section('content')
<div class="mx-auto max-w-xl space-y-6">
    <div>
        <h1 class="text-3xl font-bold">Nouvel utilisateur</h1>
        <p class="mt-2 text-sm text-slate-500">Créer un compte avec accès client ou administrateur.</p>
    </div>

    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-700">Nom</label>
            <input type="text" name="nom" value="{{ old('nom') }}" required class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500">
            @error('nom')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500">
            @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700">Mot de passe</label>
            <input type="password" name="mot_de_passe" required class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500">
            @error('mot_de_passe')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700">Rôle (optionnel)</label>
            <input type="text" name="role" value="{{ old('role') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500">
            @error('role')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_admin" value="1" id="is_admin" class="rounded border-slate-300 text-red-600 focus:ring-red-500" {{ old('is_admin') ? 'checked' : '' }}>
            <label for="is_admin" class="text-sm text-slate-700">Administrateur</label>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">Enregistrer</button>
            <a href="{{ route('admin.users.index') }}" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Annuler</a>
        </div>
    </form>
</div>
@endsection
