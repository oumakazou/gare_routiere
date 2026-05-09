<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Gare Routière - Book Your Trip')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white text-gray-900 font-sans antialiased">
        @include('components.header')

        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-slate-950 text-slate-200 py-16 mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-4 mb-12">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-cyan-500 text-white text-xl">🚌</div>
                            <div>
                                <p class="text-2xl font-bold text-white">Gare Routière</p>
                                <p class="text-sm text-slate-400">Transport innovant au Maroc</p>
                            </div>
                        </div>
                        <p class="text-sm text-slate-400">Voyages fiables, sécurité renforcée et un service fait pour les voyageurs modernes.</p>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400 mb-4">Liens utiles</h4>
                        <ul class="space-y-3 text-sm text-slate-300">
                            <li><a href="{{ route('home') }}" class="hover:text-white transition">Accueil</a></li>
                            <li><a href="{{ route('voyages.index') }}" class="hover:text-white transition">Voyages</a></li>
                            <li><a href="{{ route('home') }}#services" class="hover:text-white transition">Services</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400 mb-4">Support</h4>
                        <ul class="space-y-3 text-sm text-slate-300">
                            <li><a href="{{ route('contact') }}" class="hover:text-white transition">Contact</a></li>
                            <li><a href="{{ route('messagerie') }}" class="hover:text-white transition">FAQ</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-white transition">Conditions</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400 mb-4">Contact</h4>
                        <p class="text-sm text-slate-300">Taza, Maroc</p>
                        <p class="mt-2 text-sm text-slate-300">Gare Routiere@Taza.ma</p>
                        <p class="mt-2 text-sm text-slate-300">+212 600 000 000</p>
                        <div class="mt-5 flex items-center gap-3">
<a href="https://www.facebook.com/gare.routiere.taza" target="_blank"
           class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-800 hover:bg-blue-600 transition">
            <span class="text-white font-bold">F</span>
        </a>
         <a href="https://www.instagram.com/gare.routiere.taza" target="_blank"
           class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-800 hover:bg-pink-500 transition">
            <span class="text-white font-bold">I</span>
        </a>
 <a href="https://twitter.com/gare.routiere.taza" target="_blank"
           class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-800 hover:bg-sky-500 transition">
            <span class="text-white font-bold">T</span>
        </a>

                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-800 pt-8 text-center text-slate-500 text-sm">
                    <p>&copy; 2026 Gare Routière. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
