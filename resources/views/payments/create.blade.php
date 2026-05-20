@extends('layouts.app')

@section('title', 'Paiement - horseRide')

@section('content')
@php
    $destination = $reservation->voyage->destination ?? $reservation->voyage->ville_arrivee ?? 'Destination';
    $travelDate = $reservation->voyage->travel_date?->format('d/m/Y') ?? '-';
    $amount = (float) ($reservation->voyage->total_ttc ?? 0);
@endphp

<div class="min-h-screen bg-gradient-to-br from-red-50 to-cyan-50 py-12">
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
        @include('components.flash')

        <div class="mb-8 text-center">
            <h1 class="mb-2 text-3xl font-bold text-gray-900">Paiement securise</h1>
            <p class="text-gray-600">Finalisez votre reservation en toute securite.</p>
        </div>

        <div class="mb-8 rounded-2xl bg-white p-6 shadow-lg">
            <h2 class="mb-4 text-xl font-semibold text-gray-900">Details de la reservation</h2>

            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Reservation</span>
                    <span class="font-semibold">#{{ $reservation->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Trajet</span>
                    <span class="font-semibold">Taza - {{ $destination }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Date</span>
                    <span class="font-semibold">{{ $travelDate }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Client</span>
                    <span class="font-semibold">{{ $reservation->client_name }}</span>
                </div>
                <div class="border-t pt-3">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span class="text-red-600">{{ number_format($amount, 2, ',', ' ') }} MAD</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-lg">
            <h2 class="mb-6 text-xl font-semibold text-gray-900">Informations de paiement</h2>

            <form action="{{ route('payments.store', $reservation) }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="mb-3 block text-sm font-medium text-gray-700">Mode de paiement</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" id="card" name="payment_method" value="card" class="h-4 w-4 border-gray-300 text-red-600 focus:ring-red-500" @checked(old('payment_method', 'card') === 'card')>
                            <span class="ml-3 text-sm font-medium text-gray-700">Carte bancaire</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer" class="h-4 w-4 border-gray-300 text-red-600 focus:ring-red-500" @checked(old('payment_method') === 'bank_transfer')>
                            <span class="ml-3 text-sm font-medium text-gray-700">Virement bancaire</span>
                        </label>
                    </div>
                    @error('payment_method')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div id="card-fields" class="space-y-4">
                    <div>
                        <label for="card_number" class="mb-2 block text-sm font-medium text-gray-700">Numero de carte</label>
                        <input type="text" id="card_number" name="card_number" value="{{ old('card_number') }}" placeholder="1234 5678 9012 3456" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-red-500" maxlength="19">
                        @error('card_number')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="expiry_date" class="mb-2 block text-sm font-medium text-gray-700">Date d expiration</label>
                            <input type="text" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}" placeholder="MM/YY" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-red-500" maxlength="5">
                            @error('expiry_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="cvv" class="mb-2 block text-sm font-medium text-gray-700">CVV</label>
                            <input type="text" id="cvv" name="cvv" value="{{ old('cvv') }}" placeholder="123" class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-red-500" maxlength="4">
                            @error('cvv')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div id="bank-transfer-info" class="hidden rounded-lg bg-red-50 p-4">
                    <h3 class="mb-2 text-sm font-semibold text-red-900">Informations de virement</h3>
                    <div class="space-y-1 text-sm text-red-800">
                        <p><strong>Banque:</strong> Banque Populaire</p>
                        <p><strong>Reference:</strong> RES-{{ $reservation->id }}</p>
                        <p><strong>Beneficiaire:</strong> horseRide SARL</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <input type="checkbox" id="terms" name="terms" value="1" class="mt-1 h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500" @checked(old('terms'))>
                    <label for="terms" class="ml-3 block text-sm text-gray-700">
                        J'accepte les <a href="{{ route('qui-nous-sommes') }}" class="text-red-600 hover:text-red-700">conditions generales</a>
                        et je peux contacter le support depuis la page <a href="{{ route('contact') }}" class="text-red-600 hover:text-red-700">contact</a>.
                    </label>
                </div>
                @error('terms')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror

                <button type="submit" class="w-full rounded-lg bg-red-600 px-6 py-3 font-semibold text-white transition duration-200 hover:bg-red-700">
                    Payer {{ number_format($amount, 2, ',', ' ') }} MAD
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const radios = document.querySelectorAll('input[name="payment_method"]');
        const cardFields = document.getElementById('card-fields');
        const bankInfo = document.getElementById('bank-transfer-info');
        const cardNumber = document.getElementById('card_number');
        const expiryDate = document.getElementById('expiry_date');
        const cvv = document.getElementById('cvv');

        function syncPaymentMethod() {
            const selected = document.querySelector('input[name="payment_method"]:checked')?.value;
            const usingCard = selected !== 'bank_transfer';

            cardFields.classList.toggle('hidden', ! usingCard);
            bankInfo.classList.toggle('hidden', usingCard);

            cardNumber.required = usingCard;
            expiryDate.required = usingCard;
            cvv.required = usingCard;
        }

        radios.forEach((radio) => {
            radio.addEventListener('change', syncPaymentMethod);
        });

        cardNumber.addEventListener('input', function (event) {
            const value = event.target.value.replace(/\s+/g, '').replace(/[^0-9]/g, '');
            event.target.value = value.match(/.{1,4}/g)?.join(' ') || '';
        });

        expiryDate.addEventListener('input', function (event) {
            const value = event.target.value.replace(/\D/g, '');
            event.target.value = value.length > 2
                ? value.substring(0, 2) + '/' + value.substring(2, 4)
                : value;
        });

        syncPaymentMethod();
    });
</script>
@endsection
