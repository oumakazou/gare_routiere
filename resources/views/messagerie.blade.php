@extends('layouts.app')

@section('title', 'Messagerie & Logistique - horseRide')

@section('content')
<div class="bg-slate-50 min-h-screen font-sans">
    <!-- Hero Section: Logistics Theme -->
    <section class="relative h-[450px] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&q=80&w=2000" 
                 class="w-full h-full object-cover" alt="Logistics Background">
            <div class="absolute inset-0 bg-gradient-to-r from-red-950 via-red-900/80 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <span class="inline-block px-4 py-1.5 mb-6 rounded-full bg-cyan-500/20 border border-cyan-400/30 text-cyan-300 text-xs font-bold uppercase tracking-widest animate-fade-in">
                    Solutions de Transport Express
                </span>
                <h1 class="text-4xl md:text-6xl font-black text-white leading-tight mb-6">
                    Votre Partenaire <span class="text-cyan-400">Logistique</span> Partout au Maroc
                </h1>
                <p class="text-lg text-slate-300 mb-8 leading-relaxed">
                    Expédiez, suivez et recevez vos colis en toute sécurité. Un réseau national performant au service de votre messagerie.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#tracking" class="px-8 py-4 bg-cyan-500 hover:bg-cyan-400 text-red-950 font-bold rounded-xl transition shadow-lg shadow-cyan-500/20">
                        Suivre un colis
                    </a>
                    <a href="#services" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-bold rounded-xl border border-white/20 backdrop-blur-md transition">
                        Nos Services
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Tracking Area: Glassmorphism Card -->
    <div id="tracking" class="max-w-5xl mx-auto px-4 -mt-16 relative z-20">
        <div class="bg-white/80 backdrop-blur-2xl p-8 rounded-[2.5rem] shadow-2xl border border-white/50">
            <div class="flex flex-col md:flex-row items-end gap-6">
                <div class="flex-1 w-full text-left">
                    <label class="block text-xs font-black text-red-900 uppercase tracking-widest mb-3 ml-2">Numéro de suivi (Tracking)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" placeholder="Ex: HR-5590-XXXX" 
                               class="w-full pl-12 pr-4 py-4 bg-white border-2 border-slate-100 rounded-2xl focus:border-cyan-500 focus:ring-0 transition text-slate-700 font-bold">
                    </div>
                </div>
                <button class="w-full md:w-auto px-10 py-4.5 bg-red-900 hover:bg-red-800 text-white font-black rounded-2xl transition-all hover:scale-[1.02] active:scale-95 shadow-xl shadow-blue-900/20 uppercase tracking-wider">
                    Rechercher
                </button>
            </div>
            <div class="mt-4 flex items-center gap-4 px-2">
                <span class="flex h-2 w-2 rounded-full bg-neutral-500"></span>
                <p class="text-xs text-slate-500 font-medium">Suivi en temps réel disponible 24h/7j</p>
            </div>
        </div>
    </div>

    <!-- Services Grid -->
    <section id="services" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-red-900 text-3xl md:text-4xl font-black mb-4 uppercase">Nos Services Messagerie</h2>
            <div class="h-1.5 w-24 bg-cyan-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $services = [
                    ['title' => 'Expédition Express', 'desc' => 'Envoi immédiat de vos colis avec une priorité maximale sur tout le réseau.', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                    ['title' => 'Livraison à Domicile', 'desc' => 'Nous livrons vos marchandises directement à la porte de vos clients ou partenaires.', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['title' => 'Tracking Avancé', 'desc' => 'Suivez chaque étape du trajet de votre colis grâce à notre interface intelligente.', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    ['title' => 'Paiement à la Livraison', 'desc' => 'Service de collecte de fonds sécurisé pour vos ventes en ligne.', 'icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'],
                    ['title' => 'Suivi des Colis', 'desc' => 'Historique complet et notifications par SMS lors de la livraison effective.', 'icon' => 'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z'],
                    ['title' => 'Support Logistique', 'desc' => 'Une équipe dédiée pour répondre à vos besoins complexes de transport.', 'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z']
                ];
            @endphp

            @foreach($services as $service)
            <div class="group bg-white p-10 rounded-3xl border border-slate-100 hover:border-cyan-200 shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="w-16 h-16 bg-red-50 text-red-900 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-cyan-500 group-hover:text-white transition-colors duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $service['icon'] }}"/></svg>
                </div>
                <h3 class="text-xl font-black text-red-900 mb-4">{{ $service['title'] }}</h3>
                <p class="text-slate-500 leading-relaxed">{{ $service['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Company Presentation: Logistics Quality -->
    <section class="py-20 bg-red-900 text-white overflow-hidden relative">
        <div class="absolute right-0 top-0 w-1/2 h-full bg-white/5 skew-x-12 translate-x-24"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-black mb-8 leading-tight">Pourquoi choisir notre service <span class="text-cyan-400">Messagerie</span> ?</h2>
                    <p class="text-red-100 text-lg mb-10 leading-relaxed">
                        Fort de notre expérience dans le transport de voyageurs, horseRide Messagerie applique les mêmes standards de rigueur et de ponctualité pour vos colis.
                    </p>
                    <div class="space-y-6">
                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 bg-cyan-500/20 rounded-xl flex items-center justify-center shrink-0 border border-cyan-500/30">
                                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-1">Sécurité Garantie</h4>
                                <p class="text-red-200">Emballage et manutention soignés pour chaque type de marchandise.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 bg-cyan-500/20 rounded-xl flex items-center justify-center shrink-0 border border-cyan-500/30">
                                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-1">Rapidité Exceptionnelle</h4>
                                <p class="text-red-200">Délais de livraison optimisés grâce à notre flotte de bus quotidienne.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="rounded-3xl overflow-hidden shadow-2xl rotate-2 hover:rotate-0 transition duration-500">
                        <img src="https://images.unsplash.com/photo-1519003722824-194d4455a60c?auto=format&fit=crop&q=80&w=1000" alt="Trucking">
                    </div>
                    <div class="absolute -bottom-10 -left-10 bg-cyan-500 p-8 rounded-3xl shadow-xl hidden lg:block">
                        <p class="text-red-950 font-black text-4xl leading-none">24H</p>
                        <p class="text-red-950 font-bold text-sm uppercase tracking-tighter">Délai Maximum</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Agencies Section: Inspired by Ghazala Grid -->
    <section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div class="text-left">
                <h2 class="text-red-900 text-4xl font-black uppercase">Nos Agences Messagerie</h2>
                <p class="text-slate-500 mt-2">Trouvez le point de dépôt ou de retrait le plus proche de vous.</p>
            </div>
            <div class="flex bg-white p-1.5 rounded-2xl border border-slate-200 shadow-sm">
                <button class="px-6 py-2.5 bg-red-900 text-white font-bold rounded-xl text-sm">Toutes les villes</button>
                <button class="px-6 py-2.5 text-slate-500 font-bold hover:bg-slate-50 rounded-xl text-sm transition">Par région</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @php
                $agencies = [
                    ['city' => 'Casablanca', 'address' => 'Gare Routière Ouled Ziane, Bureau 45', 'phone' => '05 22 12 34 56'],
                    ['city' => 'Marrakech', 'address' => 'Gare Routière Bab Doukkala', 'phone' => '05 24 12 34 56'],
                    ['city' => 'Tanger', 'address' => 'Gare Routière Tanger, Bureau 12', 'phone' => '05 39 12 34 56'],
                    ['city' => 'Fès', 'address' => 'Gare Routière Fès, Place de la Gare', 'phone' => '05 35 12 34 56'],
                    ['city' => 'Agadir', 'address' => 'Gare Routière Inezgane, Bureau 8', 'phone' => '05 28 12 34 56'],
                    ['city' => 'Rabat', 'address' => 'Gare Routière Al Qamra, Bureau 22', 'phone' => '05 37 12 34 56'],
                    ['city' => 'Oujda', 'address' => 'Gare Routière Oujda, Boulevard Hassan II', 'phone' => '05 36 12 34 56'],
                    ['city' => 'Taza', 'address' => 'Gare Routière Taza, Avenue Mohamed V', 'phone' => '05 35 67 12 34'],
                ];
            @endphp

            @foreach($agencies as $agency)
            <div class="bg-white p-6 rounded-3xl border border-slate-100 hover:border-cyan-200 hover:shadow-lg transition-all group">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center text-red-900 group-hover:bg-red-900 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h4 class="text-xl font-black text-red-900">{{ $agency['city'] }}</h4>
                </div>
                <p class="text-sm text-slate-500 mb-4 h-10 line-clamp-2">{{ $agency['address'] }}</p>
                <div class="flex items-center gap-3 py-3 border-t border-slate-50">
                    <svg class="w-4 h-4 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span class="text-sm font-bold text-red-900">{{ $agency['phone'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- CTA Contact -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <div class="bg-gradient-to-br from-red-900 to-red-950 p-12 rounded-[3rem] shadow-2xl relative overflow-hidden">
                <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl"></div>
                <h2 class="text-3xl font-black text-white mb-6">Un besoin spécifique ?</h2>
                <p class="text-red-100 mb-8 text-lg">Nos conseillers logistiques sont à votre écoute pour des solutions sur-mesure.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="tel:0801000000" class="px-10 py-4 bg-white text-red-900 font-black rounded-2xl hover:bg-cyan-500 hover:text-white transition uppercase tracking-wider text-sm">
                        Appeler le 0801 000 000
                    </a>
                    <a href="{{ route('contact') }}" class="px-10 py-4 border-2 border-white/20 text-white font-black rounded-2xl hover:bg-white/10 transition uppercase tracking-wider text-sm">
                        Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.8s ease-out forwards;
    }
    html {
        scroll-behavior: smooth;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
