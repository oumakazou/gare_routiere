@extends('layouts.app')

@section('title', 'Gestion des villes - Admin')

@section('content')
<div class="space-y-6">
    @include('components.flash')

    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Gestion des villes</h1>
            <p class="mt-1 text-slate-600">Gérer les villes de départ et d'arrivée</p>
        </div>
        <a href="{{ route('admin.villes.create') }}" class="rounded-2xl bg-red-600 px-6 py-3 text-white font-semibold hover:bg-red-700">+ Nouvelle ville</a>
    </div>

    <div class="rounded-3xl bg-white shadow-sm border border-slate-200 overflow-hidden">
        @if($villes->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Nom</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($villes as $ville)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 font-medium text-slate-900">{{ $ville->nom }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('admin.villes.edit', $ville) }}" class="text-red-600 hover:text-red-700 font-semibold">✎ Éditer</a>
                                    <form action="{{ route('admin.villes.destroy', $ville) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr?');">
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
                <p class="text-slate-600">Aucune ville trouvée.</p>
                <a href="{{ route('admin.villes.create') }}" class="mt-4 inline-flex text-red-600 font-semibold hover:text-red-700">+ Créer →</a>
            </div>
        @endif
    </div>
</div>
@endsection
