@extends('layouts.admin')

@section('title', 'Nouveau voyage')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Ajouter un nouveau voyage</h1>
        <a href="{{ route('admin.voyages.index') }}" class="text-sm text-gray-500 hover:text-gray-700">
            &larr; Retour à la liste
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <form action="{{ route('admin.voyages.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Cities -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ville de Départ</label>
                    <select name="ville_depart_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach($villes as $ville)
                            <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ville d'Arrivée</label>
                    <select name="ville_arrivee_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach($villes as $ville)
                            <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Details -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date et Heure de Départ</label>
                    <input type="datetime-local" name="date_depart" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Prix (DH)</label>
                    <input type="number" name="prix" step="0.01" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Relationships -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Compagnie</label>
                    <select name="societe_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Autocar (Capacité)</label>
                    <select name="autocar_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach($autocars as $autocar)
                            <option value="{{ $autocar->id }}">{{ $autocar->immatriculation }} ({{ $autocar->capacite }} places)</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Type de Voyage</label>
                    <select name="type_voyage_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.voyages.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition">Annuler</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg shadow-md transition">
                    Enregistrer le Voyage
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
