@extends('layouts.admin')

@section('title', 'Ajouter société')

@section('content')
<div class="max-w-2xl space-y-5">
    <h1 class="text-3xl font-bold">Ajouter société</h1>
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.transport-companies.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="mb-1 block text-sm font-semibold">Nom</label>
                <input name="name" value="{{ old('name') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" checked>
                <span>Active</span>
            </label>
            <div class="flex gap-3">
                <a href="{{ route('admin.transport-companies.index') }}" class="rounded-xl border border-slate-300 px-5 py-3 font-semibold text-slate-700">Annuler</a>
                <button class="rounded-xl bg-red-600 px-5 py-3 font-semibold text-white">Créer</button>
            </div>
        </form>
    </div>
</div>
@endsection
