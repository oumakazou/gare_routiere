@extends('layouts.public')

@section('title', 'Voyages depuis Taza')

@section('content')
<div class="mx-auto max-w-7xl space-y-8 px-4 py-8 sm:px-6 lg:px-8">
    <div class="rounded-3xl bg-gradient-to-r from-blue-600 to-cyan-500 p-6 text-white shadow-lg">
        <p class="text-sm font-semibold uppercase tracking-[0.2em]">Gare Routiere</p>
        <h1 class="mt-2 text-3xl font-bold">Voyages depuis Taza</h1>
        <p class="mt-2 text-sm text-blue-100">Recherchez rapidement votre destination, date, ligne ou société.</p>
    </div>

    <form id="voyage-search-form" method="GET" action="{{ route('voyages.index') }}" class="grid gap-4 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm lg:grid-cols-3">
        <div class="lg:col-span-2 grid gap-4 sm:grid-cols-2">
            <div>
                <label for="search" class="mb-2 block text-sm font-semibold text-slate-700">Recherche libre</label>
                <input id="search" name="search" value="{{ request('search') }}" placeholder="Destination, société, ligne..." class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
            </div>

            <div>
                <label for="ville_arrivee" class="mb-2 block text-sm font-semibold text-slate-700">Destination</label>
                <input id="ville_arrivee" name="ville_arrivee" list="arrival-cities" value="{{ request('ville_arrivee') }}" placeholder="Ex: Fes" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                <datalist id="arrival-cities">
                    @foreach($arrivalCities as $city)
                        <option value="{{ $city }}"></option>
                    @endforeach
                </datalist>
            </div>

            <div>
                <label for="company_id" class="mb-2 block text-sm font-semibold text-slate-700">Société de transport</label>
                <select id="company_id" name="company_id" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="">Toutes les sociétés</option>
                    @foreach($transportCompanies as $id => $name)
                        <option value="{{ $id }}" @selected((string) request('company_id') === (string) $id)>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="line_name" class="mb-2 block text-sm font-semibold text-slate-700">Ligne</label>
                <select id="line_name" name="line_name" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="">Toutes les lignes</option>
                    @foreach($lines as $line)
                        <option value="{{ $line }}" @selected(request('line_name') === $line)>{{ $line }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="date_voyage" class="mb-2 block text-sm font-semibold text-slate-700">Date du voyage</label>
                <input id="date_voyage" type="date" name="date_voyage" value="{{ request('date_voyage') }}" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
            </div>
        </div>

        <div class="flex items-end gap-3">
            <button type="submit" class="w-full rounded-2xl bg-blue-600 px-4 py-3 text-white font-semibold transition hover:bg-blue-700">Appliquer les filtres</button>
            <a href="{{ route('voyages.index') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-center text-slate-700 font-semibold transition hover:bg-slate-50">Réinitialiser</a>
        </div>
    </form>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Voyages filtrés</p>
            <p class="mt-3 text-3xl font-bold text-slate-900">{{ $voyages->total() }}</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Tickets disponibles</p>
            <p class="mt-3 text-3xl font-bold text-slate-900">{{ $voyages->sum('tickets') }}</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total TTC</p>
            <p class="mt-3 text-3xl font-bold text-slate-900">{{ number_format($voyages->sum('total_ttc'), 2, ',', ' ') }} MAD</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Voyages bloqués</p>
            <p class="mt-3 text-3xl font-bold text-slate-900">{{ $voyages->where('is_blocked', true)->count() }}</p>
        </div>
    </div>

    @if($voyages->isNotEmpty())
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full border-separate border-spacing-0 text-left text-sm text-slate-700">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-4 py-4 font-semibold">Date</th>
                            <th class="px-4 py-4 font-semibold">Départ</th>
                            <th class="px-4 py-4 font-semibold">Destination</th>
                            <th class="px-4 py-4 font-semibold">Société</th>
                            <th class="px-4 py-4 font-semibold">Ligne</th>
                            <th class="px-4 py-4 font-semibold">Tickets</th>
                            <th class="px-4 py-4 font-semibold">Total TTC</th>
                            <th class="px-4 py-4 font-semibold">Observations</th>
                            <th class="px-4 py-4 font-semibold">Statut</th>
                            <th class="px-4 py-4 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @foreach($voyages as $voyage)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-4">{{ optional($voyage->travel_date)->format('d/m/Y') ?? '-' }}</td>
                                <td class="px-4 py-4">{{ $voyage->departure_time ?: '-' }}</td>
                                <td class="px-4 py-4">{{ $voyage->destination ?: '-' }}</td>
                                <td class="px-4 py-4">{{ $voyage->transportCompany?->name ?? 'N/A' }}</td>
                                <td class="px-4 py-4">{{ $voyage->line_name ?: '-' }}</td>
                                <td class="px-4 py-4">{{ $voyage->tickets }}</td>
                                <td class="px-4 py-4">{{ number_format((float) $voyage->total_ttc, 2, ',', ' ') }} MAD</td>
                                <td class="px-4 py-4">{{ \Illuminate\Support\Str::limit($voyage->observations ?: '-', 40) }}</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $voyage->is_blocked ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                                        {{ $voyage->is_blocked ? 'Bloqué' : 'Ouvert' }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex gap-2 flex-wrap">
                                        @if(($voyage->tickets ?? 0) > 0 && ! $voyage->is_blocked)
                                            <a href="{{ route('reservations.create', $voyage) }}" class="rounded-2xl bg-emerald-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700">Réserver</a>
                                        @endif
                                        <a href="{{ route('voyages.index', array_merge(request()->query(), ['ville_arrivee' => $voyage->destination])) }}" class="rounded-2xl border border-slate-300 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-50">Voir</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white px-4 py-4 shadow-sm">
            {{ $voyages->links() }}
        </div>
    @else
        <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center shadow-sm">
            <h2 class="text-2xl font-bold text-slate-900">Aucun voyage trouvé</h2>
            @if($suggestedCity)
                <p class="mt-3 text-slate-600">Ville proche suggérée: <span class="font-semibold text-slate-900">{{ $suggestedCity }}</span></p>
            @endif
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.querySelector('#search');
        if (! searchInput) {
            return;
        }

        let timeoutId = null;
        searchInput.addEventListener('input', function () {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(function () {
                document.querySelector('#voyage-search-form')?.submit();
            }, 450);
        });
    });
</script>
@endsection
