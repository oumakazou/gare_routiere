<!-- Voyage Card Component -->
<div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 cursor-pointer group">
    <!-- Image Container -->
    <div class="relative h-48 md:h-56 overflow-hidden bg-gradient-to-br from-gray-200 to-gray-300">
        <img 
            src="{{ $voyage['image'] }}" 
            alt="{{ $voyage['from'] }} to {{ $voyage['to'] }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
        >
        <!-- Discount Badge -->
        @isset($voyage['discount'])
            <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                -{{ $voyage['discount'] }}%
            </div>
        @endisset
    </div>

    <!-- Content -->
    <div class="p-5 md:p-6">
        <!-- Route -->
        <div class="flex items-center justify-between mb-3">
            <div>
                <h3 class="text-gray-900 font-semibold text-lg">{{ $voyage['from'] }}</h3>
                <p class="text-gray-500 text-sm">Departure</p>
            </div>
            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 10l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <div class="text-right">
                <h3 class="text-gray-900 font-semibold text-lg">{{ $voyage['to'] }}</h3>
                <p class="text-gray-500 text-sm">Destination</p>
            </div>
        </div>

        <!-- Date and Time -->
        <div class="flex items-center text-gray-600 text-sm mb-4 pb-4 border-b border-gray-200">
            <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h12a1 1 0 100-2H6z" clip-rule="evenodd"></path>
            </svg>
            <span>{{ $voyage['date'] }} at {{ $voyage['time'] }}</span>
        </div>

        <!-- Duration and Seats -->
        <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v3.5a1 1 0 00.293.707l2.5 2.5a1 1 0 101.414-1.414L11 9.086V6z" clip-rule="evenodd"></path>
                </svg>
                {{ $voyage['duration'] }}
            </div>
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v2h8v-2zM2 15a4 4 0 008 0v2H2v-2z"></path>
                </svg>
                {{ $voyage['seats'] }} seats
            </div>
        </div>

        <!-- Price and Button -->
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs">Price per person</p>
                <p class="text-2xl md:text-3xl font-bold text-blue-600">{{ $voyage['price'] }} <span class="text-sm text-gray-600">MAD</span></p>
            </div>
            <button class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:shadow-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 flex-shrink-0">
                Réserver
            </button>
        </div>
    </div>
</div>
