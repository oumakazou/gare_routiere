@extends('layouts.app')

@section('title', 'Demander un Voyage - Gare Routière')

@section('content')
@include('components.flash')

<section class="space-y-6">
    <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200 max-w-2xl mx-auto">
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-slate-900">Demander un Voyage</h1>
            <p class="mt-2 text-slate-600">Soumettez votre demande de voyage et nous vous contacterons.</p>
        </div>

        <form action="{{ route('voyage-requests.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Departure City (Fixed) -->
            <label class="block">
                <span class="text-sm font-medium text-slate-700">Ville de départ</span>
                <input type="text" value="Taza" class="mt-1 w-full rounded-2xl border border-slate-300 bg-slate-100 px-4 py-3 cursor-not-allowed" disabled />
                <input type="hidden" name="departure" value="Taza"> {{-- Hidden input to send 'Taza' --}}
            </label>

            <!-- Arrival City -->
            <label class="block">
                <span class="text-sm font-medium text-slate-700">Ville d'arrivée <span class="text-red-500">*</span></span>
                <select name="arrival_ville_id" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 @error('arrival_ville_id') border-red-500 @enderror" required>
                    <option value="">Sélectionnez une ville</option>
                    @foreach($villes as $ville)
                        <option value="{{ $ville->id }}" {{ old('arrival_ville_id') == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                    @endforeach
                </select>
                @error('arrival_ville_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </label>

            <!-- Number of Seats -->
            <label class="block">
                <span class="text-sm font-medium text-slate-700">Nombre de sièges <span class="text-red-500">*</span></span>
                <input type="number" name="seats" id="seats" value="{{ old('seats', 1) }}" min="1" max="10" class="mt-1 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 @error('seats') border-red-500 @enderror" required />
                @error('seats')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </label>

            <!-- Total Price (Automatic Calculation) -->
            <div class="block">
                <span class="text-sm font-medium text-slate-700">Prix total estimé</span>
                <p class="mt-1 text-2xl font-bold text-red-700">
                    <span id="total-price">50.00</span> MAD
                </p>
                <p class="mt-1 text-xs text-slate-500">Prix fixe par siège : 50 MAD</p>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" class="w-full rounded-2xl bg-red-700 px-6 py-3 text-white font-semibold shadow-lg shadow-blue-200/50 hover:bg-red-800 transition-all duration-300 transform hover:-translate-y-1">
                    Rechercher / Réserver
                </button>
            </div>
        </form>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const seatsInput = document.getElementById('seats');
        const totalPriceSpan = document.getElementById('total-price');
        const pricePerSeat = 50;

        function calculateTotalPrice() {
            const seats = parseInt(seatsInput.value, 10);
            if (!isNaN(seats) && seats >= 1) {
                totalPriceSpan.textContent = (seats * pricePerSeat).toFixed(2);
            } else {
                totalPriceSpan.textContent = '0.00';
            }
        }

        // Initial calculation
        calculateTotalPrice();

        // Recalculate on input change
        seatsInput.addEventListener('input', calculateTotalPrice);
    });
</script>
@endpush
@endsection