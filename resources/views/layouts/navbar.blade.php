<nav class="bg-white shadow" x-data="{ cartOpen: false }">
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
                <!-- Show User Icon on mobile devices if not logged in -->
                @guest
                    <a href="{{ route('login') }}" class="md:hidden lg:hidden text-gray-600 hover:text-gray-900">
                        <i class="fa-regular fa-user"></i>
                    </a>
                @endguest

                <!-- Authenticated Links: Show the user icon and Dropdown Menu on mobile devices if logged in -->
                @auth
                    <div class="relative md:hidden lg:hidden">
                        <button id="mobile-user-menu-button"
                            class="flex items-center space-x-2 text-gray-600 hover:text-gray-900">
                            <i class="fa-regular fa-user"></i> <!-- User Icon for mobile -->
                            <i class="fa-solid fa-caret-down"></i>
                        </button>

                        <!-- Dropdown Menu for Mobile -->
                        <div id="mobile-user-menu"
                            class="absolute right-0 mt-2 w-48 py-1 bg-white border border-gray-200 rounded-md shadow-lg hidden">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100"
                                    onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                        class="hidden md:flex lg:flex text-gray-600 hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}"
                        class="hidden md:flex lg:flex text-gray-600 hover:text-gray-900">Register</a>
                @endguest

                <!-- Authenticated Links: Show the user's email and Dropdown Menu if logged in -->
                @auth
                    <div class="relative hidden md:flex lg:flex">
                        <button id="desktop-user-menu-button"
                            class="flex items-center space-x-2 text-gray-600 hover:text-gray-900">
                            <span class="hidden md:inline">{{ Auth::user()->email }}</span>
                            <i class="fa-solid fa-caret-down"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="desktop-user-menu"
                            class="absolute right-0 mt-2 w-48 py-1 bg-white border border-gray-200 rounded-md shadow-lg hidden">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100"
                                    onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                            </form>
                        </div>
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

                <!-- Cart Icon with Toggle -->
                <button id="cartButton" class="relative text-gray-600 hover:text-gray-900">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <!-- Badge -->
                    @if ($cartItemCount > 0)
                        <span id="cartBadge"
                            class="absolute top-[-10px] right-[-10px] inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                            {{ $cartItemCount }}
                        </span>
                    @endif
                </button>

                <!-- Cart Window Component -->
                <div id="cartPopup"
                    class="fixed top-0 right-0 mt-16 w-80 bg-white border border-gray-200 rounded-md shadow-lg hidden z-50">
                    <div class="p-4">
                        @if ($cartItemCount === 0 || $cartId === 0 || $createdAt === null)
                            <p class="text-sm text-gray-500">Your cart is empty.</p>
                        @else
                            <h3 class="text-lg font-semibold">Cart Items</h3>
                            @foreach ($cartItems as $item)
                                <div class="flex items-center justify-between my-2 p-2 border-b border-gray-200">
                                    <img src="{{ asset($item->product->image_url) }}" alt="{{ $item->product->name }}"
                                        class="w-12 h-12 object-cover rounded">
                                    <div class="flex-1 ml-2">
                                        <div class="text-sm font-semibold">{{ $item->product->name }}</div>
                                        <div class="text-sm text-gray-500">
                                            R{{ number_format($item->product->price, 2) }}</div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button class="text-gray-600 hover:text-gray-900"
                                            onclick="decrementItem({{ $item->id }})">
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                        <span>{{ $item->quantity }}</span>
                                        <button class="text-gray-600 hover:text-gray-900"
                                            onclick="incrementItem({{ $item->id }})">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                            <div class="mt-4 font-semibold">
                                Total: R{{ number_format($total, 2) }}
                            </div>
                            <!-- Place Order Button -->
                            <div class="mt-4">
                                <a href="{{ route('checkout') }}"
                                    class="inline-block w-full text-center text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg">
                                    Place Order
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <script>
                    function incrementItem(itemId) {
                        // Logic to increment item quantity
                        console.log('Increment item:', itemId);
                    }

                    function decrementItem(itemId) {
                        // Logic to decrement item quantity
                        console.log('Decrement item:', itemId);
                    }
                </script>

            </div>
        </div>
        <div class="flex justify-between items-center">
            <!-- Logo and Company Name -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <!-- Logo -->
                <img src="{{ asset('/img/logo/Logo.png') }}" alt="LifeLine Logo" class="h-10">
                <!-- Company Name -->
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
                    class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('product.index') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">Products</a>
                <a href="{{ route('service') }}"
                    class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('service') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">Services</a>
                <a href="{{ route('about') }}"
                    class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('about') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">About</a>
                <a href="{{ route('contact') }}"
                    class="text-gray-600 hover:text-gray-900 {{ request()->routeIs('contact') ? 'underline decoration-2 underline-offset-4 decoration-green-500' : '' }}">Contact
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartButton = document.getElementById('cartButton');
        const cartPopup = document.getElementById('cartPopup');

        // Toggle the visibility of the cart popup
        cartButton.addEventListener('click', function() {
            if (cartPopup.classList.contains('hidden')) {
                cartPopup.classList.remove('hidden');
            } else {
                cartPopup.classList.add('hidden');
            }
        });

        // Close the cart popup if clicked outside of it
        document.addEventListener('click', function(event) {
            if (!cartButton.contains(event.target) && !cartPopup.contains(event.target)) {
                cartPopup.classList.add('hidden');
            }
        });
    });
</script>
