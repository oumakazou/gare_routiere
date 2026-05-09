@extends('layouts.app')

@section('title', 'Paiement - horseRide')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-cyan-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Paiement sécurisé</h1>
            <p class="text-gray-600">Finalisez votre réservation en toute sécurité</p>
        </div>

        <!-- Reservation Summary -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Détails de la réservation</h2>

            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Voyage:</span>
                    <span class="font-semibold">{{ $reservation->voyage->villeDepart->nom }} → {{ $reservation->voyage->villeArrivee->nom }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Date:</span>
                    <span class="font-semibold">{{ $reservation->voyage->date_depart->format('d/m/Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Heure:</span>
                    <span class="font-semibold">{{ $reservation->voyage->heure_depart }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Places:</span>
                    <span class="font-semibold">{{ $reservation->nombre_places }}</span>
                </div>
                <div class="border-t pt-3">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total:</span>
                        <span class="text-blue-600">{{ number_format($reservation->total_price, 2) }} MAD</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Form -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Informations de paiement</h2>

            <form action="{{ route('payments.store', $reservation) }}" method="POST" class="space-y-6">
                @csrf

                <!-- Payment Method -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Mode de paiement</label>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input type="radio" id="card" name="payment_method" value="card" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" checked>
                            <label for="card" class="ml-3 block text-sm font-medium text-gray-700">
                                <div class="flex items-center">
                                    <span>Carte bancaire</span>
                                    <div class="ml-2 flex space-x-1">
                                        <span class="text-blue-600">💳</span>
                                        <span class="text-red-500">💳</span>
                                        <span class="text-blue-500">💳</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                            <label for="bank_transfer" class="ml-3 block text-sm font-medium text-gray-700">
                                Virement bancaire
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Card Payment Fields -->
                <div id="card-fields" class="space-y-4">
                    <div>
                        <label for="card_number" class="block text-sm font-medium text-gray-700 mb-2">Numéro de carte</label>
                        <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               maxlength="19">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-2">Date d'expiration</label>
                            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   maxlength="5">
                        </div>
                        <div>
                            <label for="cvv" class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="123"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   maxlength="4">
                        </div>
                    </div>
                </div>

                <!-- Bank Transfer Info -->
                <div id="bank-transfer-info" class="hidden bg-blue-50 rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-blue-900 mb-2">Informations de virement</h3>
                    <div class="text-sm text-blue-800 space-y-1">
                        <p><strong>Banque:</strong> Banque Populaire</p>
                        <p><strong>RIB:</strong> 123 456 789 012 345 678 901 234</p>
                        <p><strong>Bénéficiaire:</strong> horseRide SARL</p>
                        <p><strong>Référence:</strong> RES-{{ $reservation->id }}</p>
                    </div>
                    <p class="text-xs text-blue-700 mt-2">
                        Votre réservation sera confirmée après réception du paiement (24-48h).
                    </p>
                </div>

                <!-- Terms -->
                <div class="flex items-start">
                    <input type="checkbox" id="terms" name="terms" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1" required>
                    <label for="terms" class="ml-3 block text-sm text-gray-700">
                        J'accepte les <a href="#" class="text-blue-600 hover:text-blue-700">conditions générales</a>
                        et la <a href="#" class="text-blue-600 hover:text-blue-700">politique de confidentialité</a>
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                    Payer {{ number_format($reservation->total_price, 2) }} MAD
                </button>
            </form>
        </div>

        <!-- Security Notice -->
        <div class="mt-8 text-center">
            <div class="inline-flex items-center text-sm text-gray-500">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Paiement 100% sécurisé - SSL chiffré
            </div>
        </div>
    </div>
</div>

<script>
    // Payment method toggle
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const cardFields = document.getElementById('card-fields');
            const bankInfo = document.getElementById('bank-transfer-info');

            if (this.value === 'card') {
                cardFields.classList.remove('hidden');
                bankInfo.classList.add('hidden');
                document.getElementById('card_number').required = true;
                document.getElementById('expiry_date').required = true;
                document.getElementById('cvv').required = true;
            } else {
                cardFields.classList.add('hidden');
                bankInfo.classList.remove('hidden');
                document.getElementById('card_number').required = false;
                document.getElementById('expiry_date').required = false;
                document.getElementById('cvv').required = false;
            }
        });
    });

    // Card number formatting
    document.getElementById('card_number').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
        let formatted = value.match(/.{1,4}/g)?.join(' ') || '';
        e.target.value = formatted;
    });

    // Expiry date formatting
    document.getElementById('expiry_date').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        e.target.value = value;
    });
</script>
@endsection