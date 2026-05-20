@php
    $cities = [
        'Casablanca' => 180, 'Rabat' => 150, 'Fès' => 45, 'Marrakech' => 250,
        'Tanger' => 170, 'Agadir' => 300, 'Oujda' => 65, 'Meknès' => 50,
        'Nador' => 120, 'Tétouan' => 160, 'Al Hoceima' => 140, 'Kenitra' => 130,
        'El Jadida' => 200, 'Safi' => 240, 'Errachidia' => 180, 'Dakhla' => 650,
        'Laayoune' => 500, 'Béni Mellal' => 160, 'Khouribga' => 140, 'Settat' => 190
    ];
    ksort($cities);
@endphp

<section class="w-full max-w-6xl mx-auto p-4 md:p-8" 
         x-data="{ 
            destination: '', 
            date: '', 
            isLoading: false, 
            prices: {{ json_encode($cities) }},
            get currentPrice() { return this.prices[this.destination] || 0 }
         }">
    
    <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-8 shadow-2xl border border-slate-100 relative overflow-hidden transition-all duration-500 hover:shadow-blue-500/5">
        <!-- Decorative background element -->
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-red-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        
        <div class="relative z-10">
            <div class="mb-8" data-aos="fade-down">
                <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Réserver votre trajet</h2>
                <p class="text-slate-500 mt-2 font-medium">Départs quotidiens depuis la gare de Taza</p>
            </div>

            <form @submit.prevent="isLoading = true; setTimeout(() => { isLoading = false; $el.submit(); }, 1500)" 
                  action="#" method="GET" 
                  class="grid gap-6 lg:grid-cols-4 items-end">
                
                <!-- Departure - Fixed -->
                <div class="space-y-2 group">
                    <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 ml-1 transition-colors group-focus-within:text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Départ
                    </label>
                    <div class="relative">
                        <input type="text" value="Taza" readonly 
                               class="w-full bg-slate-50 border-2 border-slate-100 text-slate-500 rounded-2xl px-5 py-4 cursor-not-allowed font-semibold transition-all duration-300">
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold uppercase tracking-wider text-red-600 bg-red-50 px-2 py-1 rounded-md">
                            Fixe
                        </div>
                    </div>
                </div>

                <!-- Destination - Dynamic Select -->
                <div class="space-y-2 group">
                    <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 ml-1 transition-colors group-focus-within:text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                        Destination
                    </label>
                    <div class="relative">
                        <select x-model="destination" name="destination" required
                                class="w-full bg-white border-2 border-slate-200 text-slate-900 rounded-2xl px-5 py-4 focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none transition-all duration-300 hover:border-slate-300 appearance-none cursor-pointer font-medium">
                            <option value="" disabled selected>Vers quelle ville ?</option>
                            @foreach($cities as $city => $price)
                                <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 group-hover:text-red-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Date Picker -->
                <div class="space-y-2 group">
                    <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 ml-1 transition-colors group-focus-within:text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Date de voyage
                    </label>
                    <input type="date" x-model="date" name="date" required
                           class="w-full bg-white border-2 border-slate-200 text-slate-900 rounded-2xl px-5 py-4 focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none transition-all duration-300 hover:border-slate-300 font-medium">
                </div>

                <!-- Actions -->
                <div class="flex gap-3">
                    <button type="submit" 
                            :disabled="isLoading || !destination || !date"
                            class="flex-1 bg-slate-900 hover:bg-black text-white font-bold py-4 rounded-2xl shadow-xl shadow-slate-200 transition-all duration-300 flex items-center justify-center gap-3 group disabled:opacity-70 disabled:cursor-not-allowed transform hover:scale-[1.02] active:scale-[0.98]">
                        <template x-if="isLoading">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </template>
                        <template x-if="!isLoading">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span>Rechercher</span>
                            </div>
                        </template>
                    </button>
                    
                    <button type="button" @click="destination = ''; date = ''"
                            class="p-4 bg-slate-100 text-slate-600 rounded-2xl hover:bg-slate-200 transition-all duration-300 hover:rotate-[-10deg] active:scale-90"
                            title="Réinitialiser">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Price Indicator Area -->
            <div x-show="destination" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="flex flex-wrap items-center justify-between border-t border-slate-100 pt-6 mt-6">
                
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-neutral-50 rounded-xl flex items-center justify-center animate-pulse">
                        <span class="text-neutral-600 text-xl font-bold">DH</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Tarif fixe assuré</p>
                        <p class="text-slate-900 font-semibold flex items-center gap-2">
                            Taza 
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                            <span x-text="destination" class="text-red-600"></span>
                        </p>
                    </div>
                </div>
                <div class="text-right">
                    <span x-text="currentPrice" class="text-3xl font-black text-slate-900"></span>
                    <span class="text-slate-500 font-bold ml-1">MAD</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        @foreach([
            ['label' => 'Trajets directs', 'val' => '100%', 'icon' => '🚀'],
            ['label' => 'Villes couvertes', 'val' => count($cities), 'icon' => '📍'],
            ['label' => 'Prix stables', 'val' => 'Garanti', 'icon' => '🛡️']
        ] as $stat)
            <div class="bg-white p-5 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <span class="text-2xl">{{ $stat['icon'] }}</span>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">{{ $stat['label'] }}</p>
                    <p class="text-lg font-bold text-slate-900">{{ $stat['val'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

<style>
    /* Hada l-CSS bach nkhaliw l-date picker yban modern */
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(30%) sepia(100%) saturate(2000%) hue-rotate(200deg) brightness(90%) contrast(90%);
        cursor: pointer;
    }
    select {
        background-image: none !important;
    }
</style>
