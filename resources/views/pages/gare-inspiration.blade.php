@extends('layouts.app')

@section('title', 'Gare & Inspiration - horseRide')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-cyan-50">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-cyan-600 text-white">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Gare & Inspiration
                </h1>
                <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                    Découvrez notre gare moderne et laissez-vous inspirer par vos voyages
                </p>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Gare Features -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Gare Moderne</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Une infrastructure de pointe pour votre confort et sécurité.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🚌</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Bus Modernes</h3>
                    <p class="text-gray-600">Flotte récente avec climatisation et WiFi</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🛡️</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Sécurité</h3>
                    <p class="text-gray-600">Contrôles et surveillance 24/7</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">☕</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Confort</h3>
                    <p class="text-gray-600">Salons d'attente et restauration</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">📱</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Digital</h3>
                    <p class="text-gray-600">Réservation en ligne et paiement mobile</p>
                </div>
            </div>
        </div>

        <!-- Inspiration Section -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Laissez-vous Inspirer</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Des idées de voyages pour découvrir le Maroc sous tous ses angles.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Inspiration Cards -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 relative overflow-hidden">
                        <img src="{{ asset('images/plage.png') }}"
                             alt="Plage"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Côtes Atlantiques</h3>
                        <p class="text-gray-600 mb-4">Plages sauvages et villes côtières animées.</p>
                        <a href="{{ route('touristique') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                            En savoir plus →
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 relative overflow-hidden">
                        <img src="{{ asset('images/montagne.png') }}"
                             alt="Montagnes"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Montagnes</h3>
                        <p class="text-gray-600 mb-4">Atlas et Rif : nature préservée et villages traditionnels.</p>
                        <a href="{{ route('touristique') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                            En savoir plus →
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 relative overflow-hidden">
                        <img src="{{ asset('images/desert.png') }}"
                             alt="Désert"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Désert</h3>
                        <p class="text-gray-600 mb-4">Sahara : dunes infinies et nuits étoilées.</p>
                        <a href="{{ route('touristique') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                            En savoir plus →
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 relative overflow-hidden">
                        <img src="{{ asset('images/patrimoine.png') }}"
                             alt="Patrimoine"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Patrimoine</h3>
                        <p class="text-gray-600 mb-4">Médinas, kasbahs et sites historiques.</p>
                        <a href="{{ route('touristique') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                            En savoir plus →
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 relative overflow-hidden">
                        <img src="{{ asset('images/nature.png') }}"
                             alt="Nature"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Nature</h3>
                        <p class="text-gray-600 mb-4">Parcs nationaux et biodiversité exceptionnelle.</p>
                        <a href="{{ route('touristique') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                            En savoir plus →
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 relative overflow-hidden">
                        <img src="{{ asset('images/culture.png') }}"
                             alt="Culture"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Culture</h3>
                        <p class="text-gray-600 mb-4">Festivals, musique et traditions vivantes.</p>
                        <a href="{{ route('touristique') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                            En savoir plus →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center bg-gradient-to-r from-blue-600 to-cyan-600 rounded-3xl p-12 text-white">
            <h3 class="text-3xl font-bold mb-4">Prêt à explorer ?</h3>
            <p class="text-xl mb-8 text-blue-100">
                Réservez votre prochain voyage et créez vos propres souvenirs !
            </p>
            <a href="{{ route('voyages.index') }}" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-blue-50 transition">
                Réserver maintenant →
            </a>
        </div>
    </div>
</div>
@endsection
