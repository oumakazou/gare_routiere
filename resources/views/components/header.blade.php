<!-- Header / Navigation -->
<header class="sticky top-0 z-50 bg-white shadow-md border-b border-gray-100">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                    <span class="text-white font-bold text-lg">🚌</span>
                </div>
                <span class="font-bold text-xl bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">Gare Routière</span>
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Accueil</a>
                <a href="{{ route('voyages.index') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Voyages</a>
                @auth
                    <a href="{{ route('reservations.index') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Mes réservations</a>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">🔧 Admin</a>
                    @endif
                @endauth
            </div>

            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-700 font-medium hover:text-blue-600 transition">Déconnexion</button>
                    </form>
                @else
                    @if(Route::has('login'))
                        <a href="{{ route('login') }}" class="text-gray-700 font-medium hover:text-blue-600 transition">Connexion</a>
                    @endif

                    @if(Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg hover:shadow-lg hover:from-blue-700 hover:to-blue-800 transition">Inscription</a>
                    @endif
                @endauth
            </div>

            <button class="md:hidden p-2 text-gray-700 hover:bg-gray-100 rounded-lg transition" type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-100 pt-4 space-y-2">
            <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition">Accueil</a>
            <a href="{{ route('voyages.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition">Voyages</a>
            @auth
                <a href="{{ route('reservations.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition">Mes réservations</a>
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 bg-blue-600 text-white rounded-lg transition">🔧 Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="px-4 py-2">
                    @csrf
                    <button type="submit" class="w-full text-left text-gray-700 hover:bg-blue-50 rounded-lg">Déconnexion</button>
                </form>
            @else
                @if(Route::has('login'))
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition">Connexion</a>
                @endif
                @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="block px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg transition">Inscription</a>
                @endif
            @endauth
        </div>
    </nav>
</header>
