<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'horseRide - Book Your Trip')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white text-gray-900 font-sans antialiased">
        @include('components.header')

        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-12 mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <!-- Company Info -->
                    <div>
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                                <span class="text-blue-900 font-bold text-lg">🐴</span>
                            </div>
                            <span class="ml-2 font-bold text-lg">horseRide</span>
                        </div>
                        <p class="text-blue-100 text-sm">Your trusted travel companion</p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="font-semibold mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-sm text-blue-100">
                            <li><a href="#" class="hover:text-white transition">Home</a></li>
                            <li><a href="#" class="hover:text-white transition">Voyages</a></li>
                            <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div>
                        <h4 class="font-semibold mb-4">Support</h4>
                        <ul class="space-y-2 text-sm text-blue-100">
                            <li><a href="#" class="hover:text-white transition">Contact</a></li>
                            <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                            <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                        </ul>
                    </div>

                    <!-- Legal -->
                    <div>
                        <h4 class="font-semibold mb-4">Legal</h4>
                        <ul class="space-y-2 text-sm text-blue-100">
                            <li><a href="#" class="hover:text-white transition">Privacy</a></li>
                            <li><a href="#" class="hover:text-white transition">Terms</a></li>
                            <li><a href="#" class="hover:text-white transition">Cookies</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-blue-400 pt-8 text-center text-blue-100 text-sm">
                    <p>&copy; 2026 horseRide. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
