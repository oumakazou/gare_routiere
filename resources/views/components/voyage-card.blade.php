@php
    $tripUrl = route('voyages.index', [
        'ville_arrivee' => $voyage['to'],
        'date_voyage' => $voyage['date'],
    ]);
    $tripDate = \Illuminate\Support\Carbon::parse($voyage['date'])->format('d/m/Y');
@endphp

<article data-reveal="scale" class="group overflow-hidden rounded-[2rem] border border-black/5 bg-white p-4 shadow-[0_28px_70px_-40px_rgba(15,23,42,0.35)] transition duration-300 hover:-translate-y-1.5 hover:shadow-[0_30px_90px_-42px_rgba(15,23,42,0.45)]">
    <div class="relative overflow-hidden rounded-[1.6rem]">
        <img
            src="{{ asset($voyage['image']) }}"
            alt="{{ $voyage['from'] }} {{ __('home.trip.to_connector') }} {{ $voyage['to'] }}"
            class="h-64 w-full object-cover transition duration-700 group-hover:scale-105"
            loading="lazy"
            decoding="async"
        >
        <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(15,23,42,0.08),rgba(15,23,42,0.72))]"></div>
        <div class="absolute left-4 right-4 top-4 flex items-center justify-between gap-3">
            <span class="rounded-full border border-white/10 bg-white/[0.15] px-3 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-white backdrop-blur-xl">
                {{ $voyage['company'] }}
            </span>
            <span class="rounded-full border border-white/10 bg-black/[0.15] px-3 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-white/80 backdrop-blur-xl">
                {{ $voyage['time'] }}
            </span>
        </div>
        <div class="absolute inset-x-0 bottom-0 p-5 text-white">
            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/[0.55]">{{ __('home.trip.premium_label') }}</p>
            <div class="mt-3 flex items-end justify-between gap-4">
                <div>
                    <h3 class="text-2xl font-semibold">{{ $voyage['from'] }}</h3>
                    <p class="mt-1 text-sm text-white/[0.72]">{{ __('home.trip.to') }} {{ $voyage['to'] }}</p>
                </div>
                <span class="rounded-full border border-white/10 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-white/[0.78]">
                    {{ $voyage['duration'] }}
                </span>
            </div>
        </div>
    </div>

    <div class="px-1 pb-1 pt-5">
        <div class="grid grid-cols-2 gap-3">
            <div class="rounded-[1.4rem] bg-slate-100 px-4 py-4">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">{{ __('home.trip.date') }}</p>
                <p class="mt-2 text-sm font-semibold text-slate-950">{{ $tripDate }}</p>
            </div>
            <div class="rounded-[1.4rem] bg-slate-100 px-4 py-4">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">{{ __('home.trip.seats') }}</p>
                <p class="mt-2 text-sm font-semibold text-slate-950">{{ $voyage['seats'] }}</p>
            </div>
        </div>

        <div class="mt-5 flex items-end justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">{{ __('home.trip.price') }}</p>
                <p class="mt-2 text-3xl font-semibold text-slate-950">
                    {{ number_format((float) $voyage['price'], 0) }}
                    <span class="text-sm font-medium text-slate-500">MAD</span>
                </p>
            </div>

            <a href="{{ $tripUrl }}" class="inline-flex items-center justify-center rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition duration-300 hover:-translate-y-0.5 hover:bg-black">
                {{ __('home.trip.cta') }}
            </a>
        </div>
    </div>
</article>
