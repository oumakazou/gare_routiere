@extends('layouts.app')

@section('title', 'Paiement réussi - horseRide')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 flex items-center justify-center py-12">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Success Icon -->
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8">
            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>

        <!-- Success Message -->
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Paiement réussi !</h1>
        <p class="text-lg text-gray-600 mb-8">
            Votre réservation a été confirmée avec succès.
        </p>

        <!-- Reservation Details -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Détails de la réservation</h2>

            <div class="space-y-3 text-left">
                <div class="flex justify-between">
                    <span class="text-gray-600">Numéro de réservation:</span>
                    <span class="font-semibold">#{{ auth()->user()->reservations()->latest()->first()->id ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Statut:</span>
                    <span class="font-semibold text-green-600">Confirmée</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Paiement:</span>
                    <span class="font-semibold text-green-600">Effectué</span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="space-y-4">
            <a href="{{ route('reservations.index') }}" class="block w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                Voir mes réservations
            </a>

            <a href="{{ route('voyages.index') }}" class="block w-full bg-white text-blue-600 border border-blue-600 py-3 px-6 rounded-lg font-semibold hover:bg-blue-50 transition duration-200">
                Réserver un autre voyage
            </a>
        </div>

        <!-- Additional Info -->
        <div class="mt-8 text-sm text-gray-500">
            <p>Un email de confirmation vous a été envoyé.</p>
            <p>Pour toute question, contactez notre support.</p>
        </div>
    </div>
</div>
@endsection