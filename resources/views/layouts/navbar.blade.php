<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <!-- Top Bar -->
            <div class="flex space-x-4">
                <a href="#">
                    <i class="fa-brands fa-facebook" style="color: #3581FD;"></i>
                </a>
                <a href="#">
                    <i class="fa-brands fa-twitter" style="color: #1DA1F2;"></i>
                </a>
                <a href="#">
                    <i class="fa-brands fa-linkedin" style="color: #0073B2;"></i>
                </a>
                <a href="#">
                    <i class="fa-brands fa-youtube" style="color: #FF0000;"></i>
                </a>
            </div>
            <div class="flex space-x-4">
                <a href="#" class="text-gray-600 hover:text-gray-900">Login</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Register</a>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <!-- Logo and Company Name -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <!-- Logo -->
                <img src="{{ asset('img/logo/Logo.png') }}" alt="LifeLine Logo" class="h-10">
                <!-- Company Name in Column Layout -->
                <div class="flex flex-col">
                    <span class="text-xxl font-bold text-gray-800">LifeLine</span>
                    <span class="text-md font-semibold text-gray-800">Pharmaceuticals</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}"
                    class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('home') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">Home</a>
                <a href="{{ route('product.index') }}" class="text-gray-600 hover:text-gray-900" {{ request()->routeIs('product') ? 'underline
                    decoration-2 underline-offset-4 decoration-green-500' : '' }}>Products</a>
                <a href="{{ route('service') }}" class="text-gray-600 hover:text-gray-900" {{ request()->routeIs('service') ? 'underline
                    decoration-2 underline-offset-4 decoration-green-500' : '' }}>Services</a>
                <a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-900" {{ request()->routeIs('about') ? 'underline
                    decoration-2 underline-offset-4 decoration-green-500' : '' }}>About</a>
                <a href="{{ route('contact') }}" class="text-gray-600 hover:text-gray-900" {{ request()->routeIs('contact') ? 'underline
                    decoration-2 underline-offset-4 decoration-green-500' : '' }}>Contact
                    Us</a>
            </div>
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="menu-btn" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden">
        <div class="px-4 py-2">
            <a href="#"
                class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('home') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">Home</a>
            <a href="#"
                class="block text-gray-600 hover:text-gray-900 {{ request()->routeIs('product') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">Products</a>
            <a href="#"
                class="block text-gray-600 hover:text-gray-900 {{ request()->routeIs('service') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">Services</a>
            <a href="{{ route('about') }}"
                class="block text-gray-600 hover:text-gray-900 {{ request()->routeIs('about') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">About</a>
            <a href="#"
                class="block text-gray-600 hover:text-gray-900 {{ request()->routeIs('contact') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">Contact
                Us</a>
        </div>
    </div>
</nav>