@extends('layouts.admin')

@section('title', 'Admin Voyages')

@section('content')
<div class="space-y-5">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">Gestion des voyages</h1>
        <a href="{{ route('admin.voyages.create') }}" class="rounded-xl bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700">
            + Nouveau voyage
        </a>
    </div>

    <form method="GET" class="grid gap-3 rounded-2xl border border-slate-200 bg-white p-4 md:grid-cols-5">
        <input name="destination" value="{{ request('destination') }}" placeholder="Filtrer destination" class="rounded-xl border border-slate-300 px-4 py-2.5">
        <input type="date" name="departure_date" value="{{ request('departure_date') }}" class="rounded-xl border border-slate-300 px-4 py-2.5">
        <select name="company_id" class="rounded-xl border border-slate-300 px-4 py-2.5">
            <option value="">Toutes les sociétés</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}" @selected(request('company_id') == $company->id)>{{ $company->name }}</option>
            @endforeach
        </select>
        <select name="is_blocked" class="rounded-xl border border-slate-300 px-4 py-2.5">
            <option value="">Tous</option>
            <option value="1" @selected(request('is_blocked') === '1')>Bloqués</option>
            <option value="0" @selected(request('is_blocked') === '0')>Non bloqués</option>
        </select>
        <button class="rounded-xl bg-slate-900 px-4 py-2.5 font-semibold text-white">Rechercher</button>
    </form>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold">Société</th>
                    <th class="px-4 py-3 text-left font-semibold">Ligne</th>
                    <th class="px-4 py-3 text-left font-semibold">Destination</th>
                    <th class="px-4 py-3 text-left font-semibold">Date</th>
                    <th class="px-4 py-3 text-left font-semibold">Heure</th>
                    <th class="px-4 py-3 text-left font-semibold">Tickets</th>
                    <th class="px-4 py-3 text-left font-semibold">TTC</th>
                    <th class="px-4 py-3 text-left font-semibold">Bloqué</th>
                    <th class="px-4 py-3 text-left font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($voyages as $voyage)
                    <tr>
                        <td class="px-4 py-3">{{ $voyage->transportCompany?->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $voyage->line_name }}</td>
                        <td class="px-4 py-3">{{ $voyage->destination }}</td>
                        <td class="px-4 py-3">{{ optional($voyage->departure_date)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $voyage->departure_time ?: '-' }}</td>
                        <td class="px-4 py-3">{{ $voyage->available_seats }}</td>
                        <td class="px-4 py-3">{{ number_format((float)$voyage->price, 2, ',', ' ') }} DH</td>
                        <td class="px-4 py-3">{{ $voyage->is_blocked ? 'Oui' : 'Non' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.voyages.edit', $voyage) }}" class="text-blue-600 hover:underline">Modifier</a>
                                <form method="POST" action="{{ route('admin.voyages.destroy', $voyage) }}" onsubmit="return confirm('Supprimer ce voyage ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-6 text-center text-slate-500">Aucun voyage.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm">
        {{ $voyages->links() }}
    </div>
</div>
@endsection
