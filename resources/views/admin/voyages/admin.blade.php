<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0">
            <div class="p-6">
                <span class="text-2xl font-bold tracking-wider text-red-400">GARE ADMIN</span>
            </div>
            <nav class="mt-6 space-y-1 px-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg hover:bg-slate-800 transition">
                    Dashboard
                </a>
                <a href="{{ route('admin.voyages.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg hover:bg-slate-800 transition">
                    Gestion Voyages
                </a>
                <a href="{{ route('admin.reservations.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg hover:bg-slate-800 transition">
                    Réservations
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg hover:bg-slate-800 transition">
                    Utilisateurs
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Header -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-end px-8">
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">{{ Auth::user()->name }} (Admin)</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 font-semibold">Déconnexion</button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-neutral-100 border-l-4 border-neutral-500 text-neutral-700">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>