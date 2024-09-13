<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LifeLine | Pharmaceuticals') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/jquery-3.7.1.min.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Top Bar -->
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-600 hover:text-gray-900">Facebook</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Twitter</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">LinkedIn</a>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-600 hover:text-gray-900">Login</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Register</a>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <!-- Logo and Company Name -->
                <div class="flex items-center space-x-2">
                    <img src="path/to/logo.png" alt="LifeLine Logo" class="h-10">
                    <span class="text-xl font-bold text-gray-800">LifeLine Pharmaceuticals</span>
                </div>
                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-6">
                    <a href="#" class="text-gray-600 hover:text-gray-900">Products</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Services</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">About</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Contact Us</a>
                </div>
                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="menu-btn" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden">
            <div class="px-4 py-2">
                <a href="#" class="block text-gray-600 hover:text-gray-900">Products</a>
                <a href="#" class="block text-gray-600 hover:text-gray-900">Services</a>
                <a href="#" class="block text-gray-600 hover:text-gray-900">About</a>
                <a href="#" class="block text-gray-600 hover:text-gray-900">Contact Us</a>
            </div>
        </div>
    </nav>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>