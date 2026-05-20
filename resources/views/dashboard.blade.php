@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-black text-gray-900">Bienvenue, {{ explode(' ', auth()->user()->name)[0] }} 👋</h1>
    <p class="text-gray-500">Voici ce qui se passe sur horseRide aujourd'hui.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
        <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
        </div>
        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Voyages</p>
        <p class="text-3xl font-black text-gray-900">{{ $stats['total_voyages'] }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
        <div class="w-12 h-12 bg-neutral-50 text-neutral-600 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Réservations</p>
        <p class="text-3xl font-black text-gray-900">{{ $stats['total_reservations'] }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
        <div class="w-12 h-12 bg-slate-50 text-slate-600 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 15.292m-3.354-15.292a4 4 0 100 15.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Utilisateurs</p>
        <p class="text-3xl font-black text-gray-900">{{ $stats['total_users'] }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
        <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">En Attente</p>
        <p class="text-3xl font-black text-gray-900">{{ $stats['pending_reservations'] }}</p>
    </div>
</div>

<!-- Recent Reservations Table -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-900">Réservations récentes</h2>
        <a href="{{ route('admin.reservations.index') }}" class="text-sm font-bold text-red-600 hover:underline">Voir tout &rarr;</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-widest font-black">
                <tr>
                    <th class="px-6 py-4">Client</th>
                    <th class="px-6 py-4">Trajet</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Statut</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($recent_reservations as $reservation)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4">
                        <p class="font-bold text-gray-800">{{ $reservation->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $reservation->user->email }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">
                        {{ $reservation->voyage->villeDepart->nom }} &rarr; {{ $reservation->voyage->villeArrivee->nom }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $reservation->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider 
                            {{ $reservation->status === 'confirmed' ? 'bg-neutral-100 text-neutral-700' : 
                               ($reservation->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-red-100 text-red-700') }}">
                            {{ $reservation->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
