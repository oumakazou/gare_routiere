<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Gare Routiere')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="flex min-h-screen">
        <aside class="w-64 border-r border-slate-200 bg-white p-5">
            <h1 class="text-lg font-bold text-blue-700">Admin Panel</h1>
            <nav class="mt-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-100">Dashboard</a>
                <a href="{{ route('admin.voyages.index') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-100">Voyages</a>
                <a href="{{ route('admin.transport-companies.index') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-100">Sociétés</a>
                <a href="{{ route('admin.reservations.index') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-100">Reservations</a>
                <a href="{{ route('voyages.index') }}" class="block rounded-lg px-3 py-2 hover:bg-slate-100">Voir site public</a>
            </nav>
        </aside>

        <main class="flex-1 p-6 lg:p-8">
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
