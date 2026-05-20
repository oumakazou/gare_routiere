<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gare Routiere')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('voyages.index') }}" class="text-xl font-bold text-red-700">Gare Routiere</a>
            <a href="{{ route('admin.dashboard') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                Admin
            </a>
        </div>
    </header>

    <main>
        @if(session('success'))
            <div class="mx-auto mt-6 max-w-7xl rounded-xl border border-neutral-200 bg-neutral-50 px-4 py-3 text-neutral-700 sm:px-6 lg:px-8">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mx-auto mt-6 max-w-7xl rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 sm:px-6 lg:px-8">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
