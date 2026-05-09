@extends('layouts.app')

@section('title', 'Qui sommes-nous - horseRide')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-cyan-50">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-cyan-600 text-white">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Qui sommes-nous
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                    L'histoire de horseRide, votre partenaire de voyage au Maroc
                </p>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Our Story -->
        <div class="mb-16">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Notre Histoire</h2>
                    <div class="space-y-4 text-gray-600">
                        <p>
Située à :contentReference[oaicite:0]{index=0}, la nouvelle gare routière est un projet moderne visant à améliorer le transport et faciliter les déplacements des voyageurs.
</p>

<p>
Elle a été conçue pour organiser le trafic des autocars et offrir des services pratiques comme des guichets, des espaces d’attente et un niveau de sécurité optimal.
</p>

<p>
Aujourd’hui, elle relie Taza à plusieurs grandes villes comme :contentReference[oaicite:1]{index=1} et :contentReference[oaicite:2]{index=2}, tout en contribuant au développement économique et à la modernisation de la ville.
</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-8">
    <div class="text-center">
        <div class="w-full h-40 overflow-hidden flex items-center justify-center mx-auto mb-4">
            <img src="{{ asset('images/mahta.png') }}" alt="HorseRide" class="w-full h-full object-cover">
        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">gare de routiere</h3>
                        <p class="text-gray-600">Transport moderne, esprit traditionnel</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Values -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Valeurs</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Les principes qui guident chacune de nos actions.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full overflow-hidden flex items-center justify-center mx-auto mb-4">
                        <img src="{{ asset('images/security.png') }}" alt="Sécurité" class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Sécurité</h3>
                    <p class="text-gray-600">La sécurité de nos passagers est notre priorité absolue</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full overflow-hidden flex items-center justify-center mx-auto mb-4">
                        <img src="{{ asset('images/natur.png') }}" alt="Durabilité" class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Durabilité</h3>
                    <p class="text-gray-600">Engagement pour un transport respectueux de l'environnement</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full overflow-hidden flex items-center justify-center mx-auto mb-4">
                        <img src="{{ asset('images/servic.png') }}" alt="Travail d'équipe" class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Service</h3>
                    <p class="text-gray-600">Excellence du service client et satisfaction garantie</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full overflow-hidden flex items-center justify-center mx-auto mb-4">
                        <img src="{{ asset('images/innovatio.png') }}" alt="Innovation" class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Innovation</h3>
                    <p class="text-gray-600">Technologie de pointe pour une expérience moderne</p>
                </div>
            </div>
        </div>

        <!-- Our Team -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Équipe</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Des professionnels passionnés qui font de horseRide une référence.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-24 h-24 bg-gradient-to-r from-blue-400 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-4"> <span class="text-3xl text-white">👨‍💼</span> </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Ahmed Bennani</h3>
                    <p class="text-blue-600 mb-2">Directeur Général</p>
                    <p class="text-gray-600 text-sm">25 ans d'expérience dans le transport</p>
                </div>

                <div class="text-center">
                    <div class="w-24 h-24 bg-gradient-to-r from-green-400 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-4"> <span class="text-3xl text-white">👩‍💻</span> </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Fatima Alaoui</h3>
                    <p class="text-blue-600 mb-2">Directrice Technique</p>
                    <p class="text-gray-600 text-sm">Experte en solutions digitales</p>
                </div>

                <div class="text-center">
                    <div class="w-24 h-24 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-4"> <span class="text-3xl text-white">👨‍💼</span> </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Youssef Tazi</h3>
                    <p class="text-blue-600 mb-2">Responsable Commercial</p>
                    <p class="text-gray-600 text-sm">Spécialiste du service client</p>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-16">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">horseRide en chiffres</h2>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">500K+</div>
                    <p class="text-gray-600">Passagers transportés</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-green-600 mb-2">50+</div>
                    <p class="text-gray-600">Destinations</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-purple-600 mb-2">200+</div>
                    <p class="text-gray-600">Bus modernes</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-orange-600 mb-2">98%</div>
                    <p class="text-gray-600">Satisfaction client</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center bg-gradient-to-r from-blue-600 to-cyan-600 rounded-3xl p-12 text-white">
            <h3 class="text-3xl font-bold mb-4">Rejoignez l'aventure horseRide</h3>
            <p class="text-xl mb-8 text-blue-100">
                Découvrez pourquoi des millions choisissent horseRide pour leurs voyages.
            </p>
            <a href="{{ route('voyages.index') }}" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-blue-50 transition">
                Réserver votre voyage →
            </a>
        </div>
    </div>
</div>
@endsection
