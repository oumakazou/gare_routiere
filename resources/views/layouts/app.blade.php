<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" data-locale="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', __('app.name') . ' | ' . __('app.tagline'))</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800|playfair-display:600,700,800|tajawal:400,500,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    @php($isHome = request()->routeIs('home'))
    <body class="{{ app()->getLocale() === 'ar' ? 'font-arabic' : 'font-sans' }}">
        @include('components.header')

        <main class="{{ $isHome ? '' : 'pt-24 lg:pt-28' }}">
            @isset($header)
                <section class="section-shell pt-8 sm:pt-10">
                    <div class="rounded-[2rem] border border-slate-200 bg-white px-6 py-5 shadow-sm">
                        {{ $header }}
                    </div>
                </section>
            @endisset

            @hasSection('content')
                @yield('content')
            @else
                {{ $slot ?? '' }}
            @endif
        </main>

        <footer class="relative overflow-hidden bg-slate-950 text-slate-200">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.08),rgba(15,23,42,0)_42%)]"></div>

            <div class="section-shell relative py-16 sm:py-20">
                <div class="grid gap-10 lg:grid-cols-[1.2fr_0.85fr_0.85fr_1fr]">
                    <div class="max-w-md space-y-5">
                        <div class="flex items-center gap-4">
                        <span class="flex h-14 w-14 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-white" aria-hidden="true">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 14h16v3a1 1 0 01-1 1h-1.5M4 14l1.5-6A2 2 0 016.4 7h11.2a2 2 0 011.9 1.4L20 14M6 18h.01M18 18h.01M8 6V5a1 1 0 011-1h6a1 1 0 011 1v1" />
                            </svg>
                        </span>
                            <div>
                                <p class="text-lg font-semibold uppercase tracking-[0.28em] text-white">{{ __('app.name') }}</p>
                                <p class="text-xs uppercase tracking-[0.32em] text-slate-400">{{ __('footer.brand_caption') }}</p>
                            </div>
                        </div>

                        <p class="text-sm leading-7 text-slate-400">{{ __('footer.description') }}</p>
                    </div>

                    <div>
                        <h2 class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-500">{{ __('footer.explore') }}</h2>
                        <ul class="mt-5 space-y-3 text-sm text-slate-300">
                            <li><a href="{{ route('home') }}" class="transition hover:text-white">{{ __('nav.home') }}</a></li>
                            <li><a href="{{ route('voyages.index') }}" class="transition hover:text-white">{{ __('nav.voyages') }}</a></li>
                            <li><a href="{{ route('touristique') }}" class="transition hover:text-white">{{ __('nav.touristique') }}</a></li>
                            <li><a href="{{ route('gare-inspiration') }}" class="transition hover:text-white">{{ __('nav.inspiration') }}</a></li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-500">{{ __('footer.company') }}</h2>
                        <ul class="mt-5 space-y-3 text-sm text-slate-300">
                            <li><a href="{{ route('qui-nous-sommes') }}" class="transition hover:text-white">{{ __('nav.about') }}</a></li>
                            <li><a href="{{ route('contact') }}" class="transition hover:text-white">{{ __('nav.contact') }}</a></li>
                            <li><a href="{{ route('messagerie') }}" class="transition hover:text-white">{{ __('footer.support_link') }}</a></li>
                            <li><a href="{{ route('voyages.index') }}" class="transition hover:text-white">{{ __('nav.book_now') }}</a></li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-500">{{ __('footer.contact_title') }}</h2>

                        <div class="mt-5 rounded-[1.75rem] border border-white/10 bg-white/5 p-6">
                            <div class="space-y-4 text-sm text-slate-300">
                                <p>{{ __('footer.location') }}</p>
                                <p>{{ __('footer.email') }}</p>
                                <p>{{ __('footer.phone') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 flex flex-col gap-3 border-t border-white/10 pt-6 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                    <p>&copy; {{ date('Y') }} {{ __('app.name') }}. {{ __('footer.rights') }}</p>
                    <p>{{ __('footer.bottom_note') }}</p>
                </div>
            </div>
        </footer>
    </body>
</html>
