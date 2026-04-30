@extends('layouts.app')

@section('title', 'Admin Dashboard - Gare Routière')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <h1 class="text-3xl font-bold text-slate-900">Admin Dashboard</h1>
        <p class="mt-1 text-slate-600">Bienvenue dans le panneau d'administration</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Villes Card -->
        <div class="rounded-3xl bg-gradient-to-br from-blue-50 to-blue-100 p-6 shadow-sm border border-blue-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-600 font-semibold">Villes</p>
                    <p class="mt-2 text-4xl font-bold text-blue-900">{{ $villes }}</p>
                </div>
                <svg class="h-12 w-12 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
            </div>
            <a href="{{ route('admin.villes.index') }}" class="mt-4 inline-flex text-blue-600 font-semibold hover:text-blue-700">Gérer →</a>
        </div>

        <!-- Societes Card -->
        <div class="rounded-3xl bg-gradient-to-br from-purple-50 to-purple-100 p-6 shadow-sm border border-purple-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-purple-600 font-semibold">Sociétés</p>
                    <p class="mt-2 text-4xl font-bold text-purple-900">{{ \App\Models\Societe::count() }}</p>
                </div>
                <svg class="h-12 w-12 text-purple-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                </svg>
            </div>
            <a href="{{ route('admin.societes.index') }}" class="mt-4 inline-flex text-purple-600 font-semibold hover:text-purple-700">Gérer →</a>
        </div>

        <!-- Autocars Card -->
        <div class="rounded-3xl bg-gradient-to-br from-green-50 to-green-100 p-6 shadow-sm border border-green-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-600 font-semibold">Autocars</p>
                    <p class="mt-2 text-4xl font-bold text-green-900">{{ $autocars }}</p>
                </div>
                <svg class="h-12 w-12 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                </svg>
            </div>
            <a href="{{ route('admin.autocars.index') }}" class="mt-4 inline-flex text-green-600 font-semibold hover:text-green-700">Gérer →</a>
        </div>

        <!-- Voyages Card -->
        <div class="rounded-3xl bg-gradient-to-br from-orange-50 to-orange-100 p-6 shadow-sm border border-orange-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-orange-600 font-semibold">Voyages</p>
                    <p class="mt-2 text-4xl font-bold text-orange-900">{{ $voyages }}</p>
                </div>
                <svg class="h-12 w-12 text-orange-300" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                </svg>
            </div>
            <a href="{{ route('admin.type-voyages.index') }}" class="mt-4 inline-flex text-orange-600 font-semibold hover:text-orange-700">Gérer →</a>
        </div>

        <!-- Reservations Card -->
        <div class="rounded-3xl bg-gradient-to-br from-pink-50 to-pink-100 p-6 shadow-sm border border-pink-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-pink-600 font-semibold">Réservations</p>
                    <p class="mt-2 text-4xl font-bold text-pink-900">{{ $reservations }}</p>
                </div>
                <svg class="h-12 w-12 text-pink-300" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 9V7a1 1 0 011-1h8a1 1 0 011 1v2M5 9a2 2 0 002 2h6a2 2 0 002-2m-6 4h6a2 2 0 012 2v1a1 1 0 01-1 1H6a1 1 0 01-1-1v-1a2 2 0 012-2z" />
                </svg>
            </div>
            <a href="{{ route('admin.reservations.index') }}" class="mt-4 inline-flex text-pink-600 font-semibold hover:text-pink-700">Voir →</a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
        <h2 class="text-xl font-bold text-slate-900 mb-4">Actions rapides</h2>
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('admin.villes.create') }}" class="rounded-2xl bg-blue-600 px-4 py-3 text-white font-medium hover:bg-blue-700 transition text-center">+ Ajouter une ville</a>
            <a href="{{ route('admin.societes.create') }}" class="rounded-2xl bg-purple-600 px-4 py-3 text-white font-medium hover:bg-purple-700 transition text-center">+ Ajouter une société</a>
            <a href="{{ route('admin.autocars.create') }}" class="rounded-2xl bg-green-600 px-4 py-3 text-white font-medium hover:bg-green-700 transition text-center">+ Ajouter un autocar</a>
            <a href="{{ route('admin.type-voyages.create') }}" class="rounded-2xl bg-orange-600 px-4 py-3 text-white font-medium hover:bg-orange-700 transition text-center">+ Ajouter un type de voyage</a>
            <a href="{{ route('admin.voyages.create') }}" class="rounded-2xl bg-indigo-600 px-4 py-3 text-white font-medium hover:bg-indigo-700 transition text-center">+ Créer un voyage</a>
            <a href="{{ route('admin.reservations.index') }}" class="rounded-2xl bg-pink-600 px-4 py-3 text-white font-medium hover:bg-pink-700 transition text-center">📋 Voir les réservations</a>
        </div>
    </div>
</div>
@endsection
