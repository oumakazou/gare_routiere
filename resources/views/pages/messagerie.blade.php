@extends('layouts.app')

@section('title', 'Messagerie - horseRide')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-cyan-50">

    <!-- HERO -->
    <div class="relative h-[500px] flex items-center justify-center overflow-hidden text-white">

        <!-- IMAGE -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/im1.png') }}"
                 class="w-full h-full object-cover">

            <!-- overlay خفيف باش النص يبان -->
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <!-- CONTENT -->
        <div class="relative z-10 text-center max-w-4xl px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Messagerie
            </h1>
            <p class="text-lg md:text-2xl text-white/80">
                Contactez-nous facilement pour toutes vos questions
            </p>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <div class="grid lg:grid-cols-2 gap-12">

            <!-- FORM -->
            <div class="bg-white rounded-2xl shadow-xl p-8">

                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    Envoyez-nous un message
                </h2>

                <form class="space-y-5">

                    @csrf

                    <input type="text" placeholder="Nom complet"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">

                    <input type="email" placeholder="Email"
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">

                    <select class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none">
                        <option>Choisissez un sujet</option>
                        <option>Réservation</option>
                        <option>Support</option>
                        <option>Autre</option>
                    </select>

                    <textarea rows="6" placeholder="Votre message..."
                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-cyan-500 outline-none"></textarea>

                    <button type="submit"
                        class="w-full bg-cyan-600 text-white py-3 rounded-lg font-semibold hover:bg-cyan-700 transition">
                        Envoyer
                    </button>

                </form>
            </div>

            <!-- INFO -->
            <div class="space-y-6">

                <h2 class="text-2xl font-bold text-gray-900">
                    Informations de contact
                </h2>

                <!-- EMAIL -->
                <div class="flex items-center space-x-4 bg-white p-5 rounded-xl shadow">
                    <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center">
                        ✉️
                    </div>
                    <div>
                        <h3 class="font-semibold">Email</h3>
                        <a href="mailto:sdlgareroutieretaza@gmail.com"
                           class="text-cyan-600 hover:underline">
                            sdlgareroutieretaza@gmail.com
                        </a>
                        <p class="text-sm text-gray-500">Réponse sous 24h</p>
                    </div>
                </div>

                <!-- PHONE -->
                <div class="flex items-center space-x-4 bg-white p-5 rounded-xl shadow">
                    <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center">
                        📞
                    </div>
                    <div>
                        <h3 class="font-semibold">Téléphone</h3>
                        <p class="text-gray-600">+212 535212867</p>
                        <p class="text-sm text-gray-500">Disponible support</p>
                    </div>
                </div>

                <!-- ADDRESS -->
                <div class="flex items-center space-x-4 bg-white p-5 rounded-xl shadow">
                    <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center">
                        📍
                    </div>
                    <div>
                        <h3 class="font-semibold">Adresse</h3>
                        <p class="text-gray-600">Taza, Maroc</p>
                        <p class="text-sm text-gray-500">Gare Routière Centrale</p>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection