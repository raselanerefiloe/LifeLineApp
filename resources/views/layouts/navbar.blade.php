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
                <a href="{{ route('login')}}" class="md:hidden lg:hidden text-gray-600 hover:text-gray-900">
                    <i class="fa-regular fa-user"></i> <!-- User Icon -->
                </a>

                @guest
                <a href="{{ route('login')}}" class="hidden md:flex lg:flex text-gray-600 hover:text-gray-900">Login</a>
                <a href="{{ route('register')}}" class="hidden md:flex lg:flex text-gray-600 hover:text-gray-900">Register</a>
                @endguest

                <!-- Authenticated Links: Show the user's email and Logout link if logged in -->
                @auth
                    <div class="hidden md:flex lg:flex items-center space-x-4">
                        <span class="text-gray-600">{{ Auth::user()->email }}</span> <!-- Display User Email -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" 
                               class="text-gray-600 hover:text-gray-900"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </a>
                        </form>
                    </div>
                @endauth

                <!-- Wishlist Icon with Badge -->
                <a href="#" class="relative text-gray-600 hover:text-gray-900">
                    <i class="fa-regular fa-heart"></i>
                    <!-- Badge -->
                    <span
                        class="absolute top-[-10px] right-[-10px] inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                        5
                    </span>
                </a>

                <!-- Cart Icon with Badge -->
                <a href="#" class="relative text-gray-600 hover:text-gray-900">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <!-- Badge -->
                    <span
                        class="absolute top-[-10px] right-[-10px] inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                        3
                    </span>
                </a>

            </div>
        </div>
        <div class="flex justify-between items-center">
            <!-- Logo and Company Name -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <!-- Logo -->
                <img src="{{ asset('/img/logo/Logo.png') }}" alt="LifeLine Logo" class="h-10">
                <!-- Company Name in Column Layout -->
                <div class="hidden md:flex lg:flex flex-col">
                    <span class="text-lg md:text-3xl lg:text-3xl font-bold text-gray-800">LifeLine</span>
                    <span class="text-[3px] md:text-lg lg:text-lg font-semibold text-gray-600">Pharmaceuticals</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}"
                    class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('home') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">Home</a>
                <a href="{{ route('product.index') }}"
                    class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('product.index')
                        ? 'underline
                                                            decoration-2 underline-offset-4 decoration-green-500'
                        : '' }}">Products</a>
                <a href="{{ route('service') }}"
                    class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('service')
                        ? 'underline
                                                            decoration-2 underline-offset-4 decoration-green-500'
                        : '' }}">Services</a>
                <a href="{{ route('about') }}"
                    class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('about')
                        ? 'underline
                                                            decoration-2 underline-offset-4 decoration-green-500'
                        : '' }}">About</a>
                <a href="{{ route('contact') }}"
                    class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('contact')
                        ? 'underline
                                                            decoration-2 underline-offset-4 decoration-green-500'
                        : '' }}">Contact
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
        <div class="px-4 py-2 flex flex-col gap-3">
            <a href="{{ route('home') }}"
                class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('home') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">Home</a>
            <a href="{{ route('product.index') }}"
                class="block text-gray-600 hover:text-gray-900 {{ request()->routeIs('product.index') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">Products</a>
            <a href="{{ route('service') }}"
                class="block text-gray-600 hover:text-gray-900 {{ request()->routeIs('service') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">Services</a>
            <a href="{{ route('about') }}"
                class="block text-gray-600 hover:text-gray-900 {{ request()->routeIs('about') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">About</a>
            <a href="{{ route('contact') }}"
                class="block text-gray-600 hover:text-gray-900 {{ request()->routeIs('contact') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">Contact
                Us</a>
        </div>
    </div>
</nav>
