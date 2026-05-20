@extends('layouts.app')

@section('title', __('voyages.meta_title'))

@section('content')
<div class="section-shell py-10 sm:py-12">
    <section class="relative overflow-hidden rounded-[2.5rem] bg-gray-900 px-6 py-10 text-white shadow-[0_32px_90px_-42px_rgba(31,41,55,0.5)] sm:px-10">
        <div class="absolute inset-0">
            <img src="{{ asset('images/team-fatima.png') }}" alt="{{ __('voyages.hero_image_alt') }}" class="h-full w-full object-cover opacity-30">
            <div class="absolute inset-0 bg-[linear-gradient(120deg,rgba(31,41,55,0.92),rgba(75,85,99,0.66))]"></div>
        </div>

        <div class="relative max-w-3xl">
            <p class="text-xs font-semibold uppercase tracking-[0.32em] text-gray-300">{{ __('voyages.eyebrow') }}</p>
            <h1 class="mt-4 font-display text-4xl sm:text-5xl">{{ __('voyages.title') }}</h1>
            <p class="mt-5 max-w-2xl text-sm leading-7 text-white/70 sm:text-base">
                {{ __('voyages.copy') }}
            </p>
        </div>
    </section>

    @include('components.flash')

    <form id="voyage-search-form" method="GET" action="{{ route('voyages.index') }}" class="soft-panel mt-8 grid gap-5 rounded-[2rem] p-6 lg:grid-cols-[1.4fr_1fr]">
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            <div class="xl:col-span-2">
                <label for="search" class="mb-2 block text-sm font-semibold text-gray-700">{{ __('voyages.filters.search') }}</label>
                <input id="search" name="search" value="{{ request('search') }}" placeholder="{{ __('voyages.filters.search_placeholder') }}" class="w-full rounded-[1.25rem] border-gray-300 bg-white px-4 py-3 text-gray-900 transition-colors duration-300 focus:border-red-600 focus:ring-red-600/10">
            </div>

            <div>
                <label for="ville_arrivee" class="mb-2 block text-sm font-semibold text-gray-700">{{ __('voyages.filters.destination') }}</label>
                <input id="ville_arrivee" name="ville_arrivee" list="arrival-cities" value="{{ request('ville_arrivee', request('destination')) }}" placeholder="{{ __('voyages.filters.destination_placeholder') }}" class="w-full rounded-[1.25rem] border-gray-300 bg-white px-4 py-3 text-gray-900 transition-colors duration-300 focus:border-red-600 focus:ring-red-600/10">
                <datalist id="arrival-cities">
                    @foreach($arrivalCities as $city)
                        <option value="{{ $city }}"></option>
                    @endforeach
                </datalist>
            </div>
            <div>
                <label for="company_id" class="mb-2 block text-sm font-semibold text-gray-700">{{ __('voyages.filters.company') }}</label>
                <select id="company_id" name="company_id" class="w-full rounded-[1.25rem] border-gray-300 bg-white px-4 py-3 text-gray-900 transition-colors duration-300 focus:border-red-600 focus:ring-red-600/10">
                    <option value="">{{ __('voyages.filters.all_companies') }}</option>
                    @foreach($transportCompanies as $id => $name)
                        <option value="{{ $id }}" @selected((string) request('company_id') === (string) $id)>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="line_name" class="mb-2 block text-sm font-semibold text-gray-700">{{ __('voyages.filters.line') }}</label>
                <select id="line_name" name="line_name" class="w-full rounded-[1.25rem] border-gray-300 bg-white px-4 py-3 text-gray-900 transition-colors duration-300 focus:border-red-600 focus:ring-red-600/10">
                    <option value="">{{ __('voyages.filters.all_lines') }}</option>
                    @foreach($lines as $line)
                        <option value="{{ $line }}" @selected(request('line_name') === $line)>{{ $line }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="date_voyage" class="mb-2 block text-sm font-semibold text-gray-700">{{ __('voyages.filters.date') }}</label>
                <input id="date_voyage" type="date" name="date_voyage" value="{{ request('date_voyage') }}" class="w-full rounded-[1.25rem] border-gray-300 bg-white px-4 py-3 text-gray-900 transition-colors duration-300 focus:border-red-600 focus:ring-red-600/10">
            </div>
        </div>

        <div class="flex flex-col justify-end gap-3 sm:flex-row lg:flex-col transition-colors duration-300">
            <button type="submit" class="inline-flex items-center justify-center rounded-full bg-red-600 px-5 py-3 text-sm font-semibold text-white transition-colors duration-300 hover:bg-red-700">
                {{ __('voyages.filters.apply') }}
            </button>
            <a href="{{ route('voyages.index') }}" class="inline-flex items-center justify-center rounded-full border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-900 transition-colors duration-300 hover:bg-gray-100">
                {{ __('voyages.filters.reset') }}
            </a>
        </div>
    </form>

    <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="soft-panel rounded-[1.75rem] p-5">
            <p class="text-sm text-gray-500">{{ __('voyages.stats.filtered') }}</p>
            <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $voyages->total() }}</p>
        </div>
        <div class="soft-panel rounded-[1.75rem] p-5">
            <p class="text-sm text-gray-500">Places Disponibles</p>
            <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $voyages->sum('available_seats') }}</p>
        </div>
        <div class="soft-panel rounded-[1.75rem] p-5">
            <p class="text-sm text-gray-500">Prix Moyen</p>
            <p class="mt-3 text-3xl font-semibold text-gray-900">{{ number_format($voyages->avg('price'), 2, '.', ' ') }} DH</p>
        </div>
    </div>

    @if($voyages->isNotEmpty())
        <div class="soft-panel mt-8 overflow-hidden rounded-[2rem] p-2">
            <div class="overflow-x-auto">
                <table class="min-w-full border-separate border-spacing-0 text-left text-sm text-slate-700">
                    <thead class="bg-gray-200 text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">
                        <tr class="transition-colors duration-300">
                            <th class="px-4 py-4">{{ __('voyages.table.date') }}</th>
                            <th class="px-4 py-4">{{ __('voyages.table.departure') }}</th>
                            <th class="px-4 py-4">{{ __('voyages.table.destination') }}</th>
                            <th class="px-4 py-4">{{ __('voyages.table.company') }}</th>
                            <th class="px-4 py-4">Places</th>
                            <th class="px-4 py-4">Prix</th>
                            <th class="px-4 py-4">{{ __('voyages.table.notes') }}</th>
                            <th class="px-4 py-4">{{ __('voyages.table.status') }}</th>
                            <th class="px-4 py-4">{{ __('voyages.table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300 bg-white">
                        @foreach($voyages as $voyage)
                            <tr class="hover:bg-gray-100 transition-colors duration-300">
                                <td class="px-4 py-4">{{ optional($voyage->date_depart)->format('d/m/Y') }}</td>
                                <td class="px-4 py-4 font-medium">{{ $voyage->villeDepart->nom }} à {{ $voyage->heure_depart }}</td>
                                <td class="px-4 py-4 font-bold text-gray-900">{{ $voyage->villeArrivee->nom }}</td>
                                <td class="px-4 py-4">{{ $voyage->societe->nom }}</td>
                                <td class="px-4 py-4">{{ $voyage->available_seats }}</td>
                                <td class="px-4 py-4 font-bold text-red-600">{{ number_format($voyage->price, 2) }} DH</td>
                                <td class="px-4 py-4">{{ \Illuminate\Support\Str::limit($voyage->observations ?: '-', 40) }}</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $voyage->is_blocked ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $voyage->is_blocked ? __('voyages.status.blocked') : __('voyages.status.open') }} {{-- Changed emerald to gray --}}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @if($voyage->available_seats > 0 && ! $voyage->is_blocked)
                                            <a href="{{ route('reservations.create', $voyage) }}" class="inline-flex items-center justify-center rounded-full bg-red-600 px-4 py-2 text-xs font-semibold text-white transition-colors duration-300 hover:bg-red-700">
                                                {{ __('voyages.actions.book') }}
                                            </a>
                                        @endif
                                        <a href="{{ route('voyages.index', array_merge(request()->query(), ['ville_arrivee' => $voyage->destination])) }}" class="inline-flex items-center justify-center rounded-full border border-gray-300 bg-white px-4 py-2 text-xs font-semibold text-gray-900 transition-colors duration-300 hover:bg-gray-100">
                                            {{ __('voyages.actions.view') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="soft-panel mt-6 rounded-[1.5rem] px-4 py-4">
            {{ $voyages->links() }}
        </div>
    @else
        <div class="soft-panel mt-8 rounded-[2rem] p-10 text-center">
            <h2 class="text-2xl font-semibold text-gray-900">{{ __('voyages.empty.title') }}</h2>
            @if($suggestedCity)
                <p class="mt-3 text-gray-500">{{ __('voyages.empty.suggestion') }} <span class="font-semibold text-gray-900">{{ $suggestedCity }}</span></p>
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
