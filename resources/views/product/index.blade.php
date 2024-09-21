<x-guest-layout>
    <div class="container mx-auto py-12 px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="relative bg-green-600 text-white text-center py-16 md:py-24 overflow-hidden rounded-lg">
            <!-- Large Screen Hero Image -->
            <div class="absolute hidden md:flex lg:flex inset-0 z-0">
                <img src="{{ asset('img/hero/lg_product.jpg') }}" alt="Background" class="w-full h-full opacity-90" />
            </div>
            <!-- Small Screen Hero Image -->
            <div class="absolute md:hidden lg:hidden inset-0 z-0">
                <img src="{{ asset('img/hero/lg_product.jpg') }}" alt="Background"
                    class="w-full h-full object-cover opacity-100" />
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Filter Sidebar -->
            <aside class="bg-white p-6 rounded-lg shadow-md md:col-span-1">
                <form method="GET" action="{{ route('product.index') }}">
                    <!-- Category Filter -->
                    <div class="mb-4">
                        <label for="category" class="block text-gray-600">Category</label>
                        <select id="category" name="category"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->name }}"
                                    {{ request('category') == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Availability Filter -->
                    <div class="mb-4">
                        <label for="availability" class="block text-gray-600">Availability</label>
                        <select id="availability" name="availability"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">All Availability</option>
                            <option value="in-stock" {{ request('availability') == 'in-stock' ? 'selected' : '' }}>In
                                Stock</option>
                            <option value="out-of-stock"
                                {{ request('availability') == 'out-of-stock' ? 'selected' : '' }}>Out of Stock</option>
                            <option value="pre-order" {{ request('availability') == 'pre-order' ? 'selected' : '' }}>
                                Pre-order</option>
                        </select>
                    </div>

                    <!-- Apply Filters Button -->
                    <div class="mb-4">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-700">Apply
                            Filters</button>
                    </div>
                </form>
            </aside>

            <!-- Dynamic Products Grid -->
            <div class="md:col-span-3">
                <!-- Search Bar -->
                <div class="mb-6">
                    <form class="relative" method="GET" action="{{ route('product.index') }}">
                        <input type="text" placeholder="Search products..." name="search"
                            class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-green-500"
                            value="{{ request('search') }}">
                        <button type="submit"
                            class="absolute inset-y-0 right-0 px-4 py-2 bg-green-600 text-white rounded-r-lg hover:bg-green-700">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 4a7 7 0 00-7 7 7 7 0 0014 0 7 7 0 00-7-7zm0 14a9 9 0 01-9-9 9 9 0 1118 0 9 9 0 01-9 9z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($products as $product)
                        <div class="relative bg-white rounded-lg shadow-md overflow-hidden group">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                class="w-full h-48 object-cover">
                            <div
                                class="absolute inset-0 flex flex-col items-end justify-start opacity-0 group-hover:opacity-100 bg-gray-800 bg-opacity-50 transition-opacity duration-300">
                                <!-- Add to Cart Icon -->
                                <button onclick="addToCart({{ $product->id }}, '{{ $product->pack_size }}')"
                                    class="text-white text-3xl mb-4 mt-2 mr-4 add-to-cart-btn">
                                    <span class="cart-icon"><i class="fas fa-cart-plus"></i></span>
                                    <span class="loading-spinner hidden"><i class="fas fa-spinner fa-spin"></i></span>
                                </button>
                                <a href="#" class="text-white text-3xl mb-4 mr-4">
                                    <i class="fas fa-heart"></i>
                                </a>
                                <a href="#" class="text-white text-3xl mr-4">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-green-600">{{ $product->name }}</h3>
                                <p class="mt-2 text-gray-600">{{ $product->description }}</p>
                                <p class="mt-4 text-green-600 font-semibold">R{{ number_format($product->price, 2) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
<!-- Include JavaScript -->
@vite(['resources/js/cart.js'])

</x-guest-layout>
