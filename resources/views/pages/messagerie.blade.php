@extends('layouts.app')

@section('title', 'Messagerie - horseRide')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-cyan-50">
    <div class="relative flex h-[500px] items-center justify-center overflow-hidden text-white">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/im1.png') }}" class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <div class="relative z-10 max-w-4xl px-4 text-center">
            <h1 class="mb-6 text-4xl font-bold md:text-6xl">Messagerie</h1>
            <p class="text-lg text-white/80 md:text-2xl">
                Contactez-nous facilement pour toutes vos questions.
            </p>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        @include('components.flash')

        <div class="grid gap-12 lg:grid-cols-2">
            <div class="rounded-2xl bg-white p-8 shadow-xl">
                <h2 class="mb-6 text-2xl font-bold text-gray-900">Envoyez-nous un message</h2>

                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        Merci de corriger les champs en erreur puis de renvoyer votre message.
                    </div>
                @endif

                <form method="POST" action="{{ route('messagerie.submit') }}" class="space-y-5">
                    @csrf

                    <div>
                        <input
                            type="text"
                            name="full_name"
                            value="{{ old('full_name') }}"
                            placeholder="Nom complet"
                            required
                            class="w-full rounded-lg border px-4 py-3 outline-none focus:ring-2 focus:ring-cyan-500"
                        >
                        @error('full_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Email"
                            required
                            class="w-full rounded-lg border px-4 py-3 outline-none focus:ring-2 focus:ring-cyan-500"
                        >
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <select
                            name="subject"
                            required
                            class="w-full rounded-lg border px-4 py-3 outline-none focus:ring-2 focus:ring-cyan-500"
                        >
                            <option value="">Choisissez un sujet</option>
                            <option value="Reservation" @selected(old('subject') === 'Reservation')>Reservation</option>
                            <option value="Support" @selected(old('subject') === 'Support')>Support</option>
                            <option value="Partenariat" @selected(old('subject') === 'Partenariat')>Partenariat</option>
                            <option value="Autre" @selected(old('subject') === 'Autre')>Autre</option>
                        </select>
                        @error('subject')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <textarea
                            rows="6"
                            name="message"
                            placeholder="Votre message..."
                            required
                            class="w-full rounded-lg border px-4 py-3 outline-none focus:ring-2 focus:ring-cyan-500"
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full rounded-lg bg-cyan-600 py-3 font-semibold text-white transition hover:bg-cyan-700">
                        Envoyer
                    </button>
                </form>
            </div>

            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-gray-900">Informations de contact</h2>

                <div class="flex items-center space-x-4 rounded-xl bg-white p-5 shadow">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-cyan-100 text-sm font-semibold text-cyan-700">
                        Email
                    </div>
                    <div>
                        <h3 class="font-semibold">Email</h3>
                        <a href="mailto:sdlgareroutieretaza@gmail.com" class="text-cyan-600 hover:underline">
                            sdlgareroutieretaza@gmail.com
                        </a>
                        <p class="text-sm text-gray-500">Reponse sous 24h</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 rounded-xl bg-white p-5 shadow">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-cyan-100 text-sm font-semibold text-cyan-700">
                        Tel
                    </div>
                    <div>
                        <h3 class="font-semibold">Telephone</h3>
                        <a href="tel:+212535212867" class="text-cyan-600 hover:underline">+212 535212867</a>
                        <p class="text-sm text-gray-500">Disponible pour le support</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 rounded-xl bg-white p-5 shadow">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-cyan-100 text-sm font-semibold text-cyan-700">
                        Map
                    </div>
                    <div>
                        <h3 class="font-semibold">Adresse</h3>
                        <p class="text-gray-600">Taza, Maroc</p>
                        <p class="text-sm text-gray-500">Gare Routiere Centrale</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
