@extends('layouts.app')

@section('title', __('home.meta_title'))

@section('content')
@php
    $heroBadges = [
        __('home.hero.badge_one'),
        __('home.hero.badge_two'),
        __('home.hero.badge_three'),
    ];
    $featuredPlan = $featuredTrips->first();

    $experienceIcons = [
        'comfort' => 'M4.5 8.25h15m-15 7.5h15m-15-15h15',
        'reliability' => 'M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z',
        'support' => 'M18 10.5a6 6 0 01-6 6h-1.5l-3 3v-3H6a6 6 0 110-12h6a6 6 0 016 6z',
    ];

    $experienceNames = ['comfort', 'reliability', 'support'];
@endphp

<section class="relative isolate overflow-hidden bg-stone-50">
    <div class="absolute inset-0">
        <img
            src="{{ asset('images/mahta.png') }}"
            alt="{{ __('home.hero.image_alt') }}"
            class="h-full w-full object-cover object-center"
            fetchpriority="high"
        >
        <div class="absolute inset-0 bg-gradient-to-b from-red-950/20 via-red-950/40 to-red-950/80"></div>
        <div class="absolute inset-0 backdrop-blur-sm"></div>
        <div class="absolute inset-x-0 bottom-0 h-52 bg-gradient-to-t from-white to-transparent"></div>
    </div>

    <div class="section-shell relative flex min-h-[100svh] flex-col items-center justify-center pb-24 pt-32 text-center sm:min-h-screen sm:pt-36">
        <div class="w-full max-w-4xl">
            @include('components.flash')
        </div>

        <div data-reveal class="inline-flex items-center gap-3 rounded-full border border-red-300 bg-white/40 px-5 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-red-700 backdrop-blur-lg shadow-md">
            <span class="h-2 w-2 rounded-full bg-red-500 animate-pulse"></span>
            {{ __('home.hero.eyebrow') }}
        </div>

        <h1 data-reveal data-delay="120ms" class="mx-auto mt-8 max-w-5xl font-display text-5xl leading-[0.96] text-slate-900 sm:text-6xl lg:text-7xl">
            {{ __('home.hero.title') }}
        </h1>

        <p data-reveal data-delay="200ms" class="mx-auto mt-6 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
            {{ __('home.hero.description') }}
        </p>

        <div data-reveal data-delay="280ms" class="mt-10 flex w-full max-w-md flex-col items-center justify-center gap-4 sm:max-w-none sm:flex-row">
            <a href="{{ route('voyages.index') }}" class="inline-flex w-full min-w-[180px] items-center justify-center rounded-full bg-red-700 px-7 py-3.5 text-sm font-semibold text-white shadow-xl shadow-blue-400/40 transition duration-300 hover:-translate-y-1 hover:bg-red-800 sm:w-auto">
                {{ __('nav.book_now') }}
            </a>
            <a href="#featured-trips" class="inline-flex w-full min-w-[180px] items-center justify-center rounded-full border border-slate-300 bg-white/60 px-7 py-3.5 text-sm font-semibold text-slate-700 backdrop-blur-md shadow-lg shadow-slate-200/30 transition duration-300 hover:-translate-y-1 hover:bg-white/80 sm:w-auto">
                {{ __('home.hero.secondary_cta') }}
            </a>
        </div>

        <div data-reveal data-delay="340ms" class="mt-8 flex flex-wrap items-center justify-center gap-3">
            @foreach($heroBadges as $badge)
                <span class="rounded-full border border-red-200 bg-red-50/40 px-4 py-2 text-sm text-red-700 backdrop-blur-lg shadow-sm">
                    {{ $badge }}
                </span>
            @endforeach
        </div>

        <div class="mt-14 grid w-full max-w-6xl gap-6 lg:grid-cols-[1.1fr_0.9fr]">
            <div data-reveal="left" data-delay="420ms" class="bg-white/60 border border-white rounded-[2rem] p-6 text-left shadow-2xl shadow-blue-200/40 backdrop-blur-xl sm:p-7">
                <div class="flex items-center justify-between gap-4 border-b border-slate-100 pb-5">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">{{ __('home.hero.plan_title') }}</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-900">{{ __('home.hero.plan_route') }}</h2>
                    </div>
                    <span class="rounded-full border border-neutral-100 bg-neutral-50 px-4 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-neutral-600">
                        {{ __('home.hero.plan_status') }}
                    </span>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-[1.5rem] border border-slate-100 bg-slate-50/70 p-4 shadow-inner">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-400">{{ __('home.hero.detail_departure') }}</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $featuredPlan['time'] ?? '07:15' }}</p>
                    </div>
                    <div class="rounded-[1.5rem] border border-slate-100 bg-slate-50/70 p-4 shadow-inner">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-400">{{ __('home.hero.detail_duration') }}</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $featuredPlan['duration'] ?? '4h 20m' }}</p>
                    </div>
                    <div class="rounded-[1.5rem] border border-slate-100 bg-slate-50/70 p-4 shadow-inner">
                        <p class="text-xs uppercase tracking-[0.24em] text-slate-400">{{ __('home.hero.detail_price') }}</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-900">{{ number_format((float) ($featuredPlan['price'] ?? 190), 0) }} MAD</p>
                    </div>
                </div>
            </div>

            <div data-reveal="right" data-delay="500ms" class="bg-white/60 border border-white rounded-[2rem] p-4 text-left shadow-2xl shadow-blue-200/40 backdrop-blur-xl">
                <div class="overflow-hidden rounded-[1.6rem]">
                    <img
                        src="{{ asset('images/voyages.jpg') }}"
                        alt="{{ __('home.hero.visual_alt') }}"
                        class="h-64 w-full object-cover transition duration-700 hover:scale-105"
                        loading="eager"
                    >
                </div>

                <div class="mt-5 flex items-end justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">{{ __('home.hero.visual_title') }}</p>
                        <p class="mt-2 max-w-xs text-sm leading-7 text-slate-600">{{ __('home.hero.visual_copy') }}</p>
                    </div>
                    <div class="rounded-[1.3rem] border border-red-200 bg-red-50/40 px-4 py-3 text-right shadow-sm backdrop-blur-md">
                        <p class="text-xs uppercase tracking-[0.2em] text-red-400">{{ __('home.hero.visual_tag') }}</p>
                        <p class="mt-2 text-lg font-semibold text-red-700">{{ __('home.hero.visual_value') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="relative z-10 -mt-10 pb-8 bg-stone-100/30">
    <div class="section-shell">
        <div class="grid gap-5 rounded-[2.5rem] bg-white p-6 shadow-2xl shadow-slate-200/50 border border-slate-100 sm:grid-cols-2 lg:grid-cols-4 lg:p-8">
            @foreach($journeyStats as $stat)
                <div data-reveal="scale" class="rounded-[1.5rem] border border-slate-100 bg-slate-50/70 p-5 transition-all duration-300 hover:bg-white hover:shadow-lg hover:border-red-100">
                    <p class="text-3xl font-semibold text-slate-950">{{ $stat['value'] }}</p>
                    <p class="mt-2 text-sm leading-6 text-slate-500">{{ __($stat['label_key']) }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="featured-trips" class="section-shell scroll-mt-32 py-24 bg-white">
    <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div data-reveal>
            <p class="text-xs font-semibold uppercase tracking-[0.32em] text-red-500">{{ __('home.featured.eyebrow') }}</p>
            <h2 class="mt-4 max-w-2xl font-display text-4xl text-slate-950 sm:text-5xl">{{ __('home.featured.title') }}</h2>
        </div>
        <p data-reveal data-delay="120ms" class="max-w-xl text-sm leading-7 text-slate-500 sm:text-base">
            {{ __('home.featured.copy') }}
        </p>
    </div>

    <div class="mt-10 grid gap-6 lg:grid-cols-2 xl:grid-cols-4">
        @foreach($featuredTrips as $voyage)
            @include('components.voyage-card', ['voyage' => $voyage])
        @endforeach
    </div>
</section>

<section class="bg-slate-50 py-24">
    <div class="section-shell grid gap-12 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
        <div>
            <p data-reveal class="text-xs font-semibold uppercase tracking-[0.32em] text-red-500">{{ __('home.experience.eyebrow') }}</p>
            <h2 data-reveal data-delay="120ms" class="mt-4 max-w-xl font-display text-4xl text-slate-950 sm:text-5xl">{{ __('home.experience.title') }}</h2>
            <p data-reveal data-delay="200ms" class="mt-5 max-w-xl text-sm leading-7 text-slate-500 sm:text-base">
                {{ __('home.experience.copy') }}
            </p>

            <div class="mt-8 space-y-4">
                @foreach($experienceCards as $index => $card)
                    @php($iconName = $experienceNames[$index])
                    <div data-reveal data-delay="{{ 260 + ($index * 90) }}ms" class="bg-white border border-slate-100 rounded-[1.75rem] p-5 shadow-lg shadow-slate-100/50 transition-all duration-300 hover:shadow-xl hover:border-red-100">
                        <div class="flex items-start gap-4">
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-600 text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $experienceIcons[$iconName] }}" />
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-950">{{ __($card['title_key']) }}</h3>
                                <p class="mt-2 text-sm leading-7 text-slate-500">{{ __($card['copy_key']) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div data-reveal="right" class="grid gap-4 sm:grid-cols-2">
            <div class="overflow-hidden rounded-[2rem] sm:col-span-2">
                <img src="{{ asset('images/team-fatima.png') }}" alt="{{ __('home.gallery.modern_bus_alt') }}" class="h-72 w-full object-cover" loading="lazy" decoding="async">
            </div>
            <div class="overflow-hidden rounded-[2rem]">
                <img src="{{ asset('images/im3.png') }}" alt="{{ __('home.gallery.city_bus_alt') }}" class="h-56 w-full object-cover" loading="lazy" decoding="async">
            </div>
            <div class="bg-white border border-slate-100 rounded-[2rem] p-6 shadow-lg shadow-slate-100/50">
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-red-500">{{ __('home.gallery.card_eyebrow') }}</p>
                <h3 class="mt-3 text-2xl font-semibold text-slate-900">{{ __('home.gallery.card_title') }}</h3>
                <p class="mt-4 text-sm leading-7 text-slate-500">{{ __('home.gallery.card_copy') }}</p>
            </div>
        </div>
    </div>
</section>

<section class="section-shell py-24">
    <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div data-reveal>
            <p class="text-xs font-semibold uppercase tracking-[0.32em] text-red-500">{{ __('home.destinations.eyebrow') }}</p>
            <h2 class="mt-4 max-w-2xl font-display text-4xl text-slate-950 sm:text-5xl">{{ __('home.destinations.title') }}</h2>
        </div>
        <p data-reveal data-delay="120ms" class="max-w-xl text-sm leading-7 text-slate-500 sm:text-base">
            {{ __('home.destinations.copy') }}
        </p>
    </div>

    <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        @foreach($destinations as $index => $destination)
            <a
                href="{{ route('voyages.index', ['ville_arrivee' => $destination['name']]) }}"
                data-reveal="scale"
                data-delay="{{ 180 + ($index * 90) }}ms"
                class="group relative overflow-hidden rounded-[2rem]"
            >
                <img src="{{ asset($destination['image']) }}" alt="{{ $destination['name'] }}" class="h-96 w-full object-cover transition-all duration-700 group-hover:scale-105 group-hover:brightness-110" loading="lazy" decoding="async">
                <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(15,23,42,0.08),rgba(15,23,42,0.72))]"></div>
                <div class="absolute inset-x-0 bottom-0 p-6 text-white">
                    <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/60">{{ __('home.destinations.label') }}</p>
                    <h3 class="mt-3 text-2xl font-semibold">{{ $destination['name'] }}</h3>
                    <p class="mt-3 text-sm leading-7 text-white/75">{{ __($destination['copy_key']) }}</p>
                </div>
            </a>
        @endforeach
    </div>
</section>

<section class="bg-slate-900 py-24 text-white">
    <div class="section-shell grid gap-12 lg:grid-cols-[0.95fr_1.05fr]">
        <div>
            <p data-reveal class="text-xs font-semibold uppercase tracking-[0.32em] text-red-400">{{ __('home.steps.eyebrow') }}</p>
            <h2 data-reveal data-delay="120ms" class="mt-4 max-w-xl font-display text-4xl sm:text-5xl">{{ __('home.steps.title') }}</h2>
            <p data-reveal data-delay="200ms" class="mt-5 max-w-xl text-sm leading-7 text-slate-300 sm:text-base">
                {{ __('home.steps.copy') }}
            </p>

            <div class="mt-10 space-y-4">
                @foreach($journeySteps as $step)
                    <div data-reveal="left" class="rounded-[1.75rem] border border-white/10 bg-white/[0.03] p-5 backdrop-blur-xl shadow-lg shadow-blue-950/20 transition-all duration-300 hover:bg-white/[0.06] hover:border-red-700/30">
                        <div class="flex items-start gap-4">
                            <span class="text-sm font-semibold tracking-[0.32em] text-white/40">{{ $step['index'] }}</span>
                            <div>
                                <h3 class="text-lg font-semibold text-white">{{ __($step['title_key']) }}</h3>
                                <p class="mt-2 text-sm leading-7 text-slate-400">{{ __($step['copy_key']) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <p data-reveal class="text-xs font-semibold uppercase tracking-[0.32em] text-red-400">{{ __('home.testimonials.eyebrow') }}</p>
            <div class="mt-6 space-y-5">
                @foreach($testimonials as $index => $testimonial)
                    <article data-reveal="right" data-delay="{{ 120 + ($index * 90) }}ms" class="rounded-[1.75rem] border border-white/10 bg-white/[0.03] p-6 backdrop-blur-xl shadow-lg shadow-blue-950/20 transition-all duration-300 hover:bg-white/[0.06] hover:border-red-700/30">
                        <div class="flex text-red-400">
                            @for($star = 0; $star < 5; $star++)
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                        <p class="mt-5 text-base leading-8 text-white/[0.78]">{{ __($testimonial['quote_key']) }}</p>
                        <div class="mt-6 border-t border-white/10 pt-4">
                            <p class="font-semibold text-white">{{ $testimonial['author'] }}</p>
                            <p class="mt-1 text-sm text-white/[0.45]">{{ __($testimonial['role_key']) }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="section-shell py-16 sm:py-20">
    <div data-reveal class="relative overflow-hidden rounded-[2.5rem] bg-white p-8 shadow-2xl shadow-blue-300/40 sm:p-12">
        <div class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} hidden w-2/5 lg:block">
            <img src="{{ asset('images/voyages.jpg') }}" alt="{{ __('home.final_cta.image_alt') }}" class="h-full w-full object-cover" loading="lazy" decoding="async">
            <div class="absolute inset-0 bg-gradient-to-r from-white via-white/80 to-white/10 {{ app()->getLocale() === 'ar' ? 'scale-x-[-1]' : '' }}"></div>
        </div>

        <div class="relative max-w-2xl">
            <p class="text-xs font-semibold uppercase tracking-[0.32em] text-red-500">{{ __('home.final_cta.eyebrow') }}</p>
            <h2 class="mt-4 font-display text-4xl text-slate-950 sm:text-5xl">{{ __('home.final_cta.title') }}</h2>
            <p class="mt-5 text-sm leading-7 text-slate-600 sm:text-base">{{ __('home.final_cta.copy') }}</p>

            <div class="mt-8 flex max-w-md flex-col gap-4 sm:max-w-none sm:flex-row">
                <a href="{{ route('voyages.index') }}" class="inline-flex w-full items-center justify-center rounded-full bg-slate-950 px-7 py-3.5 text-sm font-semibold text-white transition duration-300 hover:-translate-y-0.5 hover:bg-black sm:w-auto">
                    {{ __('nav.book_now') }}
                </a>
                <a href="{{ route('contact') }}" class="inline-flex w-full items-center justify-center rounded-full border border-slate-300 px-7 py-3.5 text-sm font-semibold text-slate-900 transition duration-300 hover:-translate-y-0.5 hover:bg-slate-100 sm:w-auto">
                    {{ __('home.final_cta.secondary') }}
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
