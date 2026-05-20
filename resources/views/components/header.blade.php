@php

    $navLinks = [
        ['label' => __('nav.home'), 'route' => route('home'), 'active' => request()->routeIs('home')],
        ['label' => __('nav.voyages'), 'route' => route('voyages.index'), 'active' => request()->routeIs('voyages.*')],
        ['label' => __('nav.touristique'), 'route' => route('touristique'), 'active' => request()->routeIs('touristique')],
        ['label' => __('nav.about'), 'route' => route('qui-nous-sommes'), 'active' => request()->routeIs('qui-nous-sommes')],
        ['label' => __('nav.inspiration'), 'route' => route('gare-inspiration'), 'active' => request()->routeIs('gare-inspiration')],
        ['label' => __('nav.contact'), 'route' => route('contact'), 'active' => request()->routeIs('contact')],
    ];

    $locales = [
        ['code' => 'fr', 'short' => 'FR', 'flag' => '🇫🇷', 'label' => __('language.french')],
        ['code' => 'ar', 'short' => 'AR', 'flag' => '🇲🇦', 'label' => __('language.arabic')],
        ['code' => 'en', 'short' => 'EN', 'flag' => '🇬🇧', 'label' => __('language.english')],
    ];

    $accountUrl = auth()->check()
        ? (auth()->user()?->is_admin
            ? route('admin.dashboard')
            : (\Illuminate\Support\Facades\Route::has('profile.edit') ? route('profile.edit') : route('voyages.index')))
        : route('login');
    $accountLabel = auth()->check()
        ? (auth()->user()?->is_admin ? __('nav.dashboard') : __('nav.account'))
        : __('auth.login');
@endphp

<header
    x-data="siteHeader({
        isHome: @js(request()->routeIs('home')),
        currentLocale: @js(app()->getLocale()),
        locales: @js($locales),
        switchUrlTemplate: @js(url('/lang/__LOCALE__'))
    })"
    class="fixed inset-x-0 top-0 z-50"
>
    <div
        class="border-b border-white/10 bg-dark shadow-[0_20px_60px_-34px_rgba(15,23,42,0.45)] backdrop-blur-xl text-white transition duration-500"
    >
        <nav class="section-shell flex h-20 items-center justify-between gap-6 lg:h-24">
            <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-4">
                <span
                    class="flex h-12 w-12 items-center justify-center rounded-2xl border border-white/20 bg-white/10 text-white transition duration-500"
                    aria-hidden="true"
                >
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 14h16v3a1 1 0 01-1 1h-1.5M4 14l1.5-6A2 2 0 016.4 7h11.2a2 2 0 011.9 1.4L20 14M6 18h.01M18 18h.01M8 6V5a1 1 0 011-1h6a1 1 0 011 1v1" />
                    </svg>
                </span>

                <span class="flex min-w-0 flex-col">
                    <span
                        class="truncate text-sm font-semibold uppercase tracking-[0.28em] transition duration-500 sm:text-base text-white"
                    >
                        {{ __('app.name') }}
                    </span>
                    <span
                        class="truncate text-[0.68rem] uppercase tracking-[0.32em] transition duration-500 text-white/70"
                    >
                        {{ __('app.tagline') }}
                    </span>
                </span>
            </a>

            <div class="hidden lg:flex lg:flex-1 lg:justify-center">
                <div
                    class="flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-2 transition duration-500"
                >
                    @foreach($navLinks as $link)
                        <a
                            href="{{ $link['route'] }}"
                            class="group relative rounded-full px-4 py-2 text-sm font-semibold tracking-[0.08em] transition duration-300 {{ $link['active'] ? 'text-primary' : 'text-white/80 hover:text-primary' }}"
                        >
                            <span>{{ $link['label'] }}</span>
                            <span class="absolute inset-x-4 bottom-1 h-px origin-left bg-current transition-transform duration-300 {{ $link['active'] ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-3 sm:gap-4">
                <a
                    href="{{ $accountUrl }}"
                    class="hidden rounded-full px-4 py-2 text-sm font-semibold transition duration-300 md:inline-flex text-white/80 hover:text-primary"
                >
                    {{ $accountLabel }}
                </a>

                <div class="relative">
                    <button
                        type="button"
                        @click="languageOpen = ! languageOpen"
                        class="inline-flex min-w-[5.5rem] items-center justify-center gap-2 rounded-full border border-white/[0.15] bg-white/10 text-white hover:bg-white/[0.15] text-sm font-semibold tabular-nums transition duration-300"
                        :aria-expanded="languageOpen"
                        aria-haspopup="true"
                        aria-label="{{ __('language.label') }}"
                    >
                        <span class="text-base leading-none" x-text="localeFlag()"></span>
                        <span x-text="localeLabel()"></span>
                        <svg class="h-3.5 w-3.5 shrink-0 opacity-70 transition-transform duration-300" :class="languageOpen ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.51a.75.75 0 01-1.08 0l-4.25-4.51a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div
                        x-cloak
                        x-show="languageOpen"
                        @click.outside="languageOpen = false"
                        x-transition.origin.top.right
                        class="absolute {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} mt-3 w-56 overflow-hidden rounded-[1.5rem] border border-white/10 bg-dark p-2 shadow-[0_28px_70px_-40px_rgba(15,23,42,0.5)]"
                    >
                        @foreach($locales as $locale)
                            <a
                                href="{{ route('lang.switch', $locale['code']) }}"
                                @click.prevent="languageOpen = false; switchLocale('{{ $locale['code'] }}')"
                                class="flex items-center justify-between rounded-[1rem] px-4 py-3 text-sm transition hover:bg-white/5"
                            >
                                <span class="flex items-center gap-3">
                                    <span class="text-base">{{ $locale['flag'] }}</span>
                                    <span class="font-medium text-white">{{ $locale['label'] }}</span>
                                </span>
                                <span class="text-xs font-semibold uppercase tracking-[0.18em] text-white/50">{{ $locale['short'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <a
                    href="{{ route('voyages.index') }}"
                    class="hidden rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white transition duration-300 hover:-translate-y-0.5 hover:bg-primary-hover sm:inline-flex"
                >
                    {{ __('nav.book_now') }}
                </a>

                <button
                    type="button"
                    @click="mobileMenuOpen = ! mobileMenuOpen"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/[0.15] bg-white/10 text-white transition duration-300 lg:hidden"
                    aria-label="{{ __('nav.menu') }}"
                >
                    <svg x-show="!mobileMenuOpen" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
                    </svg>
                    <svg x-cloak x-show="mobileMenuOpen" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18" />
                    </svg>
                </button>
            </div>
        </nav>

        <div x-cloak x-show="mobileMenuOpen" x-transition class="lg:hidden">
            <div class="section-shell pb-6">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-[0_28px_70px_-40px_rgba(15,23,42,0.35)]">
                    <div class="space-y-2">
                        @foreach($navLinks as $link)
                            <a
                                href="{{ $link['route'] }}"
                                class="flex items-center justify-between rounded-[1rem] px-4 py-3 text-sm font-semibold transition {{ $link['active'] ? 'bg-slate-950 text-white' : 'text-slate-800 hover:bg-slate-100' }}"
                            >
                                <span>{{ $link['label'] }}</span>
                                <span class="text-xs uppercase tracking-[0.18em] {{ $link['active'] ? 'text-white/60' : 'text-slate-400' }}">0{{ $loop->iteration }}</span>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-5 border-t border-slate-200 pt-5">
                        <p class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-400">{{ __('language.label') }}</p>
                        <div class="mt-4 grid grid-cols-3 gap-3">
                            @foreach($locales as $locale)
                                <button
                                    type="button"
                                    @click="mobileMenuOpen = false; switchLocale('{{ $locale['code'] }}')"
                                    class="rounded-[1rem] border px-3 py-3 text-center text-sm font-semibold transition hover:border-slate-300 hover:bg-slate-100"
                                    :class="currentLocale === '{{ $locale['code'] }}' ? 'border-slate-950 bg-slate-950 text-white' : 'border-slate-200 bg-white text-slate-900'"
                                >
                                    <span class="block text-base">{{ $locale['flag'] }}</span>
                                    <span class="mt-1 block">{{ $locale['short'] }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-5 grid gap-3 sm:grid-cols-2">
                        <a href="{{ $accountUrl }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-100">
                            {{ $accountLabel }}
                        </a>
                        <a href="{{ route('voyages.index') }}" class="inline-flex items-center justify-center rounded-full bg-slate-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-black">
                            {{ __('nav.book_now') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
