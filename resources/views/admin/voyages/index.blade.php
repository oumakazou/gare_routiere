@extends('layouts.app')

@section('title', 'Gestion des voyages - Admin')

@section('content')
<div class="space-y-6">
    @include('components.flash')

    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Gestion des voyages</h1>
            <p class="mt-1 text-slate-600">Créer et gérer les trajets</p>
        </div>
        <a href="{{ route('admin.voyages.create') }}" class="rounded-2xl bg-blue-600 px-6 py-3 text-white font-semibold hover:bg-blue-700">+ Nouveau voyage</a>
    </div>

    <div class="rounded-3xl bg-white shadow-sm border border-slate-200 overflow-hidden">
        @if($voyages->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Route</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Date/Heure</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Type</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Prix</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Autocar</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($voyages as $voyage)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 font-medium text-slate-900">{{ $voyage->villeDepart->nom }} → {{ $voyage->villeArrivee->nom }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $voyage->date_depart->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $voyage->typeVoyage->nom }}</td>
                                <td class="px-4 py-3 font-semibold text-slate-900">{{ number_format($voyage->price, 2, ',', ' ') }} MAD</td>
                                <td class="px-4 py-3 text-slate-600">{{ $voyage->autocar->matricule }}</td>
                                <td class="px-4 py-3 flex gap-2">
                                    <a href="{{ route('admin.voyages.edit', $voyage) }}" class="text-blue-600 hover:text-blue-700 font-semibold text-xs">✎ Éditer</a>
                                    <form action="{{ route('admin.voyages.destroy', $voyage) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 font-semibold text-xs">🗑 Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-12 text-center">
                <p class="text-slate-600">Aucun voyage trouvé.</p>
                <a href="{{ route('admin.voyages.create') }}" class="mt-4 inline-flex text-blue-600 font-semibold hover:text-blue-700">+ Créer le premier →</a>
            </div>
        @endif
    </div>
</div>
@endsection
