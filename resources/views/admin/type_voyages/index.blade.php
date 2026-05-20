@extends('layouts.app')

@section('title', 'Types de voyage - Admin')

@section('content')
<div class="space-y-6">
    @include('components.flash')

    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Types de voyage</h1>
        </div>
        <a href="{{ route('admin.type-voyages.create') }}" class="rounded-2xl bg-red-600 px-6 py-3 text-white font-semibold hover:bg-red-700">+ Nouveau</a>
    </div>

    <div class="rounded-3xl bg-white shadow-sm border border-slate-200 overflow-hidden">
        @if($typeVoyages->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Nom</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($typeVoyages as $type)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 font-medium text-slate-900">{{ $type->nom }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('admin.type-voyages.edit', $type) }}" class="text-red-600 hover:text-red-700 font-semibold">✎ Éditer</a>
                                    <form action="{{ route('admin.type-voyages.destroy', $type) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr?');">
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
                <p class="text-slate-600">Aucun type trouvé.</p>
            </div>
        @endif
    </div>
</div>
@endsection
