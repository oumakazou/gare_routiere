@extends('layouts.app')

@section('title', 'Tourisme - horseRide')

@section('content')
<div class="min-h-screen bg-gray-50">

    <div class="relative h-[500px] flex items-center justify-center bg-red-900 text-white overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/im1.png') }}" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-red-900/60 to-gray-50"></div>
        </div>

        <div class="relative z-10 text-center px-4">
            <h1 class="text-4xl md:text-6xl font-black uppercase tracking-wider mb-4">
                Voyages Touristiques
            </h1>
            <p class="text-xl md:text-2xl font-light max-w-2xl mx-auto">
                Découvrez le Maroc avec le confort et la sécurité que vous méritez.
            </p>
        </div>
    </div>

        
        
        

        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 uppercase">Nos Circuits Populaires</h2>
            <div class="w-24 h-1 bg-red-600 mx-auto mt-4"></div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            
            <div class="group bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('images/marakech.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute top-4 right-4 bg-red-600 text-white px-4 py-1 rounded-full font-bold">
                        Dès 500 DH
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Marrakech</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Explorez la place Jemaa el-Fna et les jardins Majorelle avec nos navettes quotidiennes.
                    </p>
                    <a href="{{ route('voyages.index', ['ville_arrivee' => 'Marrakech']) }}" 
                       class="block text-center bg-gray-900 text-white py-3 rounded-xl font-bold hover:bg-red-600 transition shadow-lg">
                        Réserver ma place
                    </a>
                </div>
            </div>

            <div class="group bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('images/fes.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute top-4 right-4 bg-red-600 text-white px-4 py-1 rounded-full font-bold">
                        Dès 400 DH
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Fès</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Plongez dans l'histoire de la plus ancienne médina du monde avec un confort total.
                    </p>
                    <a href="{{ route('voyages.index', ['ville_arrivee' => 'Fes']) }}" 
                       class="block text-center bg-gray-900 text-white py-3 rounded-xl font-bold hover:bg-red-600 transition shadow-lg">
                        Réserver ma place
                    </a>
                </div>
            </div>

            <div class="group bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('images/plage.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute top-4 right-4 bg-red-600 text-white px-4 py-1 rounded-full font-bold">
                        Dès 600 DH
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Tanger</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Le point de rencontre entre l'Afrique et l'Europe vous attend.
                    </p>
                    <a href="{{ route('voyages.index', ['ville_arrivee' => 'Tanger']) }}" 
                       class="block text-center bg-gray-900 text-white py-3 rounded-xl font-bold hover:bg-red-600 transition shadow-lg">
                        Réserver ma place
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-red-600 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Besoin d'un transport privé ?</h2>
            <p class="text-lg opacity-90 mb-8">Nous proposons des services de location de bus pour les groupes et entreprises.</p>
            <a href="{{ route('contact') }}" class="bg-white text-red-600 px-10 py-3 rounded-full font-black uppercase hover:bg-gray-100 transition">
                Demander un devis
            </a>
        </div>
    </div>

</div>
@endsection
