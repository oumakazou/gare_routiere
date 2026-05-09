@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Destinations Touristiques</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @php
            $destinations = [
                ['title' => 'Chefchaouen', 'desc' => 'La perle bleue du Rif.', 'img' => 'https://images.unsplash.com/photo-1548013146-72479768bbaa'],
                ['title' => 'Marrakech', 'desc' => 'L\'effervescence de la place Jemaa el-Fna.', 'img' => 'https://images.unsplash.com/photo-1597212618440-806262de4f6b'],
                ['title' => 'Merzouga', 'desc' => 'Une nuit magique sous les étoiles du Sahara.', 'img' => 'https://images.unsplash.com/photo-1505051508008-923feaf90180']
            ];
        @endphp
        @foreach($destinations as $dest)
        <div class="group overflow-hidden rounded-2xl shadow-lg bg-white transition-transform duration-300 hover:-translate-y-2">
            <img src="{{ $dest['img'] }}" class="w-full h-64 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $dest['title'] }}</h3>
                <p class="text-gray-600">{{ $dest['desc'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection