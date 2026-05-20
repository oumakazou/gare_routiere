@extends('layouts.app')

@section('title', __('reservation.meta_title'))

@section('content')
<div class="section-shell py-10 sm:py-12">
    @php
        $arrivalCity = $voyage->destination ?? $voyage->ville_arrivee ?? $voyage->villeArrivee?->nom ?? __('reservation.fallback_destination');
        $rawDate = $voyage->travel_date ?? $voyage->date_voyage ?? $voyage->date_depart ?? null;
        $displayDate = $rawDate ? \Illuminate\Support\Carbon::parse($rawDate)->format('d/m/Y') : '-';
        $displayPrice = (float) ($voyage->total_ttc ?? $voyage->prix ?? $voyage->price ?? $voyage->base_price ?? 0);
    @endphp

    <div class="mx-auto max-w-3xl">
        <div class="relative overflow-hidden rounded-[2.25rem] bg-slate-950 p-8 text-white shadow-[0_32px_90px_-42px_rgba(15,23,42,0.5)] sm:p-10">
            <div class="absolute inset-0">
                <img src="{{ asset('images/voyages.jpg') }}" alt="{{ __('reservation.hero_image_alt') }}" class="h-full w-full object-cover opacity-30">
                <div class="absolute inset-0 bg-[linear-gradient(120deg,rgba(2,6,23,0.9),rgba(15,23,42,0.68))]"></div>
            </div>

            <div class="relative">
                <p class="text-xs font-semibold uppercase tracking-[0.32em] text-white/50">{{ __('reservation.eyebrow') }}</p>
                <h1 class="mt-4 font-display text-4xl">{{ __('reservation.title') }}</h1>
                <p class="mt-4 text-sm leading-7 text-white/70">{{ __('reservation.copy') }}</p>

                <div class="mt-8 grid gap-4 rounded-[1.75rem] border border-white/10 bg-white/5 p-5 sm:grid-cols-3">
                    <div>
                        <p class="text-xs uppercase tracking-[0.22em] text-white/[0.45]">{{ __('reservation.summary.route') }}</p>
                        <p class="mt-2 text-lg font-semibold text-white">Taza - {{ $arrivalCity }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.22em] text-white/[0.45]">{{ __('reservation.summary.date') }}</p>
                        <p class="mt-2 text-lg font-semibold text-white">{{ $displayDate }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.22em] text-white/[0.45]">{{ __('reservation.summary.price') }}</p>
                        <p class="mt-2 text-lg font-semibold text-white">{{ number_format($displayPrice, 2, ',', ' ') }} MAD</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="soft-panel mt-8 rounded-[2rem] p-6 sm:p-8">
            <form method="POST" action="{{ route('reservations.store', $voyage) }}" class="space-y-5">
                @csrf

                <div>
                    <label for="client_name" class="mb-2 block text-sm font-semibold text-slate-700">{{ __('reservation.fields.name') }}</label>
                    <input id="client_name" name="client_name" value="{{ old('client_name') }}" class="w-full rounded-[1.25rem] border-slate-200 bg-white px-4 py-3 text-slate-900 transition focus:border-slate-950 focus:ring-slate-950/10">
                    @error('client_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="client_phone" class="mb-2 block text-sm font-semibold text-slate-700">{{ __('reservation.fields.phone') }}</label>
                    <input id="client_phone" name="client_phone" value="{{ old('client_phone') }}" class="w-full rounded-[1.25rem] border-slate-200 bg-white px-4 py-3 text-slate-900 transition focus:border-slate-950 focus:ring-slate-950/10">
                    @error('client_phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-3 pt-2 sm:flex-row">
                    <a href="{{ route('voyages.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-100">
                        {{ __('reservation.actions.cancel') }}
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-black">
                        {{ __('reservation.actions.confirm') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
