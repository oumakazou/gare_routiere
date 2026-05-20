@extends('layouts.app')

@section('title', 'Contact - horseRide')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-red-50 to-cyan-50">
    <div class="relative overflow-hidden bg-gradient-to-r from-red-600 to-cyan-600 text-white">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="mb-6 text-4xl font-bold md:text-6xl">Contactez-nous</h1>
                <p class="mx-auto max-w-3xl text-xl text-red-100 md:text-2xl">
                    Notre equipe vous accompagne pour vos reservations, vos demandes d'information et votre support.
                </p>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        @include('components.flash')

        <div class="grid gap-12 lg:grid-cols-2">
            <div class="rounded-2xl bg-white p-8 shadow-lg">
                <h2 class="mb-6 text-2xl font-bold text-gray-900">Formulaire de contact</h2>

                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        Veuillez corriger les champs en erreur puis reessayer.
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="first_name" class="mb-2 block text-sm font-medium text-gray-700">Prenom</label>
                            <input
                                type="text"
                                id="first_name"
                                name="first_name"
                                value="{{ old('first_name') }}"
                                required
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-red-500"
                            >
                            @error('first_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="last_name" class="mb-2 block text-sm font-medium text-gray-700">Nom</label>
                            <input
                                type="text"
                                id="last_name"
                                name="last_name"
                                value="{{ old('last_name') }}"
                                required
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-red-500"
                            >
                            @error('last_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-700">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-red-500"
                        >
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-gray-700">Telephone</label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-red-500"
                        >
                        @error('phone')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject" class="mb-2 block text-sm font-medium text-gray-700">Sujet</label>
                        <select
                            id="subject"
                            name="subject"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-red-500"
                        >
                            <option value="">Choisissez un sujet</option>
                            <option value="reservation" @selected(old('subject') === 'reservation')>Reservation / Modification</option>
                            <option value="refund" @selected(old('subject') === 'refund')>Remboursement</option>
                            <option value="complaint" @selected(old('subject') === 'complaint')>Reclamation</option>
                            <option value="information" @selected(old('subject') === 'information')>Demande d'information</option>
                            <option value="partnership" @selected(old('subject') === 'partnership')>Partenariat</option>
                            <option value="other" @selected(old('subject') === 'other')>Autre</option>
                        </select>
                        @error('subject')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="mb-2 block text-sm font-medium text-gray-700">Message</label>
                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            required
                            placeholder="Decrivez votre demande en detail..."
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-red-500"
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="newsletter"
                            name="newsletter"
                            value="1"
                            @checked(old('newsletter'))
                            class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500"
                        >
                        <label for="newsletter" class="ml-2 block text-sm text-gray-700">
                            J'accepte de recevoir la newsletter de horseRide
                        </label>
                    </div>
                    @error('newsletter')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="w-full rounded-lg bg-red-600 px-6 py-3 font-semibold text-white transition duration-200 hover:bg-red-700">
                        Envoyer ma demande
                    </button>
                </form>
            </div>

            <div class="space-y-8">
                <div class="rounded-2xl bg-white p-8 shadow-lg">
                    <h2 class="mb-6 text-2xl font-bold text-gray-900">Nos coordonnees</h2>

                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-red-100">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Adresse</h3>
                                <p class="text-gray-600">Gare Routiere Centrale<br>Taza, Maroc</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-red-100">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Email</h3>
                                <a href="mailto:sdlgareroutieretaza@gmail.com" class="text-gray-600 hover:text-red-600">sdlgareroutieretaza@gmail.com</a>
                                <p class="text-gray-600">support commercial et demandes clients</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-red-100">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Telephone</h3>
                                <a href="tel:+212535212867" class="text-gray-600 hover:text-red-600">+212 535212867</a>
                                <p class="text-sm text-gray-500">Support client 24/7</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-lg bg-red-100">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Horaires</h3>
                                <p class="text-gray-600">Lundi - Vendredi: 8h - 20h</p>
                                <p class="text-gray-600">Samedi: 9h - 18h</p>
                                <p class="text-gray-600">Dimanche: 10h - 16h</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-lg">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Actions rapides</h3>
                    <p class="mb-6 text-gray-600">Accedez rapidement a nos canaux les plus utiles.</p>

                    <div class="flex space-x-4">
                        <a href="mailto:sdlgareroutieretaza@gmail.com" class="flex h-12 w-12 items-center justify-center rounded-lg bg-red-600 text-white transition hover:bg-red-700" aria-label="Envoyer un email">
                            <span class="text-lg font-bold">@</span>
                        </a>
                        <a href="tel:+212535212867" class="flex h-12 w-12 items-center justify-center rounded-lg bg-neutral-600 text-white transition hover:bg-neutral-700" aria-label="Appeler le support">
                            <span class="text-lg font-bold">P</span>
                        </a>
                        <a href="{{ route('messagerie') }}" class="flex h-12 w-12 items-center justify-center rounded-lg bg-slate-900 text-white transition hover:bg-black" aria-label="Ouvrir la messagerie">
                            <span class="text-lg font-bold">M</span>
                        </a>
                        <a href="https://www.google.com/maps/search/?api=1&query=Gare+Routiere+Centrale+Taza+Maroc" target="_blank" rel="noreferrer" class="flex h-12 w-12 items-center justify-center rounded-lg bg-red-500 text-white transition hover:bg-red-600" aria-label="Ouvrir Google Maps">
                            <span class="text-lg font-bold">G</span>
                        </a>
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-8 shadow-lg">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900">Nous trouver</h3>
                    <a href="https://www.google.com/maps/search/?api=1&query=Gare+Routiere+Centrale+Taza+Maroc" target="_blank" rel="noreferrer" class="flex aspect-video items-center justify-center rounded-lg bg-gray-200 transition hover:bg-gray-300">
                        <div class="text-center">
                            <svg class="mx-auto mb-4 h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-gray-500">Ouvrir la carte</p>
                            <p class="text-sm text-gray-400">Gare Routiere Centrale, Taza</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
