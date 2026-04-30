@extends('layouts.app')

@section('title', 'Gestion des autocars - Admin')

@section('content')
<div class="space-y-6">
    <!-- Flash Messages -->
    @include('components.flash')

    <!-- Header -->
    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Gestion des autocars</h1>
            <p class="mt-1 text-slate-600">Ajouter, modifier et supprimer les autocars</p>
        </div>
        <a href="{{ route('admin.autocars.create') }}" class="rounded-2xl bg-blue-600 px-6 py-3 text-white font-semibold hover:bg-blue-700 transition">+ Nouvel autocar</a>
    </div>

    <!-- Table -->
    <div class="rounded-3xl bg-white shadow-sm border border-slate-200 overflow-hidden">
        @if($autocars->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Matricule</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Société</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Capacité</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Type</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($autocars as $autocar)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 font-medium text-slate-900">{{ $autocar->matricule }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $autocar->societe->nom }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $autocar->capacite }} places</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                        {{ $autocar->type === 'local' ? 'Local' : 'Externe' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('admin.autocars.edit', $autocar) }}" class="text-blue-600 hover:text-blue-700 font-semibold">✎ Éditer</a>
                                    <form action="{{ route('admin.autocars.destroy', $autocar) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 font-semibold">🗑 Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-12 text-center">
                <svg class="h-12 w-12 mx-auto text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="text-slate-600">Aucun autocar trouvé.</p>
                <a href="{{ route('admin.autocars.create') }}" class="mt-4 inline-flex text-blue-600 font-semibold hover:text-blue-700">+ Créer le premier →</a>
            </div>
        @endif
    </div>
</div>
@endsection
