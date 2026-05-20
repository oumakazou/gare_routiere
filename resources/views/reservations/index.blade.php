@extends('layouts.app')

@section('title', 'Mes reservations')

@section('content')
<div class="section-shell py-10 sm:py-12">
    @include('components.flash')

    <div class="rounded-[2rem] bg-slate-950 px-6 py-8 text-white shadow-[0_32px_90px_-42px_rgba(15,23,42,0.55)] sm:px-8">
        <p class="text-xs font-semibold uppercase tracking-[0.32em] text-white/50">Suivi client</p>
        <h1 class="mt-4 text-3xl font-semibold sm:text-4xl">Mes reservations</h1>
        <p class="mt-3 max-w-2xl text-sm leading-7 text-white/70">
            Retrouvez vos dernieres reservations enregistrees dans ce navigateur et finalisez le paiement si besoin.
        </p>
    </div>

    @if($reservations->isNotEmpty())
        <div class="mt-8 space-y-4">
            @foreach($reservations as $reservation)
                @php
                    $voyage = $reservation->voyage;
                    $isPaid = in_array($reservation->id, $paidReservationIds, true);
                    $destination = $voyage->destination ?? $voyage->ville_arrivee ?? 'Destination';
                    $travelDate = $voyage?->travel_date?->format('d/m/Y') ?? '-';
                    $amount = (float) ($voyage->total_ttc ?? 0);
                @endphp

                <div class="soft-panel rounded-[2rem] p-6">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Reservation #{{ $reservation->id }}</p>
                                <h2 class="mt-2 text-2xl font-semibold text-slate-950">Taza - {{ $destination }}</h2>
                            </div>

                            <div class="grid gap-3 text-sm text-slate-600 sm:grid-cols-2">
                                <p><span class="font-semibold text-slate-900">Client:</span> {{ $reservation->client_name }}</p>
                                <p><span class="font-semibold text-slate-900">Telephone:</span> {{ $reservation->client_phone }}</p>
                                <p><span class="font-semibold text-slate-900">Date:</span> {{ $travelDate }}</p>
                                <p><span class="font-semibold text-slate-900">Heure:</span> {{ $voyage->departure_time ?: '-' }}</p>
                            </div>
                        </div>

                        <div class="rounded-[1.5rem] border border-slate-200 bg-white px-5 py-4 text-right shadow-sm">
                            <p class="text-sm text-slate-500">Montant</p>
                            <p class="mt-2 text-3xl font-semibold text-slate-950">{{ number_format($amount, 2, ',', ' ') }} MAD</p>
                            <span class="mt-3 inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $isPaid ? 'bg-neutral-100 text-neutral-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $isPaid ? 'Paiement confirme' : 'Paiement en attente' }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-3 border-t border-slate-200 pt-5 sm:flex-row">
                        @if($isPaid)
                            <a href="{{ route('payments.success', $reservation) }}" class="inline-flex items-center justify-center rounded-full bg-neutral-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-neutral-700">
                                Voir le recu
                            </a>
                        @else
                            <a href="{{ route('payments.create', $reservation) }}" class="inline-flex items-center justify-center rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-black">
                                Payer maintenant
                            </a>
                        @endif

                        <a href="{{ route('voyages.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-100">
                            Reserver un autre voyage
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="soft-panel mt-8 rounded-[2rem] p-10 text-center">
            <h2 class="text-2xl font-semibold text-slate-950">Aucune reservation enregistree</h2>
            <p class="mt-3 text-slate-500">Commencez par reserver un trajet pour voir votre historique ici.</p>
            <a href="{{ route('voyages.index') }}" class="mt-6 inline-flex items-center justify-center rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-black">
                Voir les voyages
            </a>
        </div>
    @endif
</div>
@endsection
