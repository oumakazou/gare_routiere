<script setup>
import { ref, watch } from 'vue';
import axios from 'axios'; // Assuming axios is available for AJAX requests

const selectedDestination = ref('');
const tripPrice = ref(null);
const errorMessage = ref('');

const destinations = [
    'FES', 'MEKNES', 'KHEMISSET', 'TIFELT', 'SALE', 'RABAT', 'CASA BLANCA',
    'EL JADIDA', 'SAFI', 'BNI MELLAL', 'CHICHAOUA', 'ESSAOUIRA', 'SETTAT',
    'MARRAKECH', 'AGADIR', 'INZGAN', 'SIDI KASEM', 'SIDI SELIMANE', 'SIDI YAHYA',
    'KENITRA', 'SOUK EL ARBAA', 'KASAR LAKBIR', 'LARACHE', 'TANGER', 'TETOUAN',
    'ASSILAH', 'JORF EL MALHA', 'OUAZZANE', 'CHEFCHAOUEN', 'AZROU', 'IFRANE',
    'MIDELT', 'KHNIFRA', 'KASBAT TADLA', 'EL KALAA SRAGHNA', 'AKNOUL',
    'TIZI OUASLI', 'MIDAR', 'SELOUANE', 'ZAIO', 'BERKANE', 'NADOR', 'GUERCIF',
    'MISSOUR', 'OUTAT EL HAJ', 'TANDIT', 'LAAYOUNE EST', 'TAOURIRT', 'SAKA',
    'OUJDA', 'TAHLA', 'RIBAT EL KHIR', 'SEFROU'
];

watch(selectedDestination, async (newDestination) => {
    tripPrice.value = null;
    errorMessage.value = '';

    if (newDestination) {
        try {
            const response = await axios.post('/get-trip-price', {
                destination: newDestination
            });
            tripPrice.value = response.data.price;
        } catch (error) {
            console.error('Error fetching price:', error);
            errorMessage.value = error.response?.data?.message || 'Could not fetch price.';
        }
    }
});
</script>

<template>
    <div class="p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Book Your Trip from Taza</h2>

        <div class="mb-4">
            <label for="destination" class="block text-gray-700 text-sm font-bold mb-2">
                Select Destination:
            </label>
            <select
                id="destination"
                v-model="selectedDestination"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
                <option value="" disabled>-- Please select a destination --</option>
                <option v-for="dest in destinations" :key="dest" :value="dest">
                    {{ dest }}
                </option>
            </select>
        </div>

        <div v-if="tripPrice !== null" class="mb-4 text-lg font-medium text-green-700">
            Price: {{ tripPrice }} DH
        </div>
        <div v-if="errorMessage" class="mb-4 text-lg font-medium text-red-600">
            {{ errorMessage }}
        </div>

        <button
            :disabled="!selectedDestination"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline disabled:opacity-50"
        >
            Proceed to Booking
        </button>
    </div>
</template>
