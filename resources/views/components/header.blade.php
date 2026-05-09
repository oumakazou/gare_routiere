<!-- Header / Navigation -->
<header class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-200">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <!-- Left: Logo + Brand -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 flex-shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Gare Routière" class="h-12 w-auto object-contain" />
                <span class="font-bold text-xl text-gray-900">Gare Routière</span>
            </a>

            <!-- Center: Navigation Links (Desktop) -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 font-medium hover:text-blue-600 transition duration-200">Accueil</a>
                <a href="{{ route('voyages.index') }}" class="text-gray-700 font-medium hover:text-blue-600 transition duration-200">Voyages</a>
                <a href="{{ route('touristique') }}" class="text-gray-700 font-medium hover:text-blue-600 transition duration-200">Touristique</a>
                <a href="{{ route('messagerie') }}" class="text-gray-700 font-medium hover:text-blue-600 transition duration-200">Messagerie</a>
                <a href="{{ route('gare-inspiration') }}" class="text-gray-700 font-medium hover:text-blue-600 transition duration-200">Gare & Inspiration</a>
                <a href="{{ route('qui-nous-sommes') }}" class="text-gray-700 font-medium hover:text-blue-600 transition duration-200">Qui sommes-nous</a>
                <a href="{{ route('contact') }}" class="text-gray-700 font-medium hover:text-blue-600 transition duration-200">Contact</a>
            </div>

            <!-- Right: Auth Links + Mobile Menu Button -->
            <div class="flex items-center space-x-4">
                <!-- Desktop Auth Links -->
                <div class="hidden lg:flex items-center space-x-4">
                    @auth
                        <span class="text-gray-700 text-sm">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 font-medium hover:text-blue-600 transition duration-200 text-sm">Déconnexion</button>
                        </form>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">Admin</a>
                        @endif
                    @else
                        @if(Route::has('login'))
                            <a href="{{ route('login') }}" class="text-gray-700 font-medium hover:text-blue-600 transition duration-200 text-sm">Connexion</a>
                        @endif
                        @if(Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition duration-200 text-sm">Inscription</a>
                        @endif
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden p-2 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-200 py-4 space-y-4">
            <!-- Mobile Navigation Links -->
            <div class="space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-200">Accueil</a>
                <a href="{{ route('voyages.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-200">Voyages</a>
                <a href="{{ route('touristique') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-200">Touristique</a>
                <a href="{{ route('messagerie') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-200">Messagerie</a>
                <a href="{{ route('gare-inspiration') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-200">Gare & Inspiration</a>
                <a href="{{ route('qui-nous-sommes') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-200">Qui sommes-nous</a>
                <a href="{{ route('contact') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-200">Contact</a>
            </div>

            <!-- Mobile Auth Links -->
            <div class="border-t border-gray-200 pt-4 space-y-2">
                @auth
                    <p class="px-4 py-2 text-sm text-gray-700">{{ auth()->user()->name }}</p>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-200">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-200">Déconnexion</button>
                    </form>
                @else
                    @if(Route::has('login'))
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition duration-200">Connexion</a>
                    @endif
                    @if(Route::has('register'))
                        <a href="{{ route('register') }}" class="block px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition duration-200 text-center">Inscription</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>
</header>

<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
