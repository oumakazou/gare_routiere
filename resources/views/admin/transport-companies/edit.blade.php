@extends('layouts.admin')

@section('title', 'Modifier société')

@section('content')
<div class="max-w-2xl space-y-5">
    <h1 class="text-3xl font-bold">Modifier société</h1>
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.transport-companies.update', $transportCompany) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="mb-1 block text-sm font-semibold">Nom</label>
                <input name="name" value="{{ old('name', $transportCompany->name) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $transportCompany->is_active))>
                <span>Active</span>
            </label>
            <div class="flex gap-3">
                <a href="{{ route('admin.transport-companies.index') }}" class="rounded-xl border border-slate-300 px-5 py-3 font-semibold text-slate-700">Annuler</a>
                <button class="rounded-xl bg-blue-600 px-5 py-3 font-semibold text-white">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection
