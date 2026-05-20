@extends('layouts.admin')

@section('title', 'Paramètres')

@section('content')
<div class="mx-auto max-w-xl space-y-6">
    <h1 class="text-3xl font-bold">Paramètres</h1>

    @if(session('success'))
        <div class="rounded-xl border border-neutral-200 bg-neutral-50 px-4 py-3 text-sm text-neutral-800">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-700">Nom du site (optionnel)</label>
            <input type="text" name="site_name" value="{{ old('site_name', config('app.name')) }}" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500">
            @error('site_name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <button type="submit" class="rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">Enregistrer</button>
    </form>
</div>
@endsection
