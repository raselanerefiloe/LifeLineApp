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
            <aside class="bg-white p-6 rounded-lg shadow-md md:col-span-1 h-64">
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
                        <div class="flex items-center border border-gray-300 rounded-full overflow-hidden max-w-md w-full m-auto lg:ml-14 transition duration-300 focus-within:border-green-500">
                            <input type="text" placeholder="Search..." class="flex-grow py-2 px-4 text-base border-none outline-none focus:ring-0" />
                            <button class="bg-green-500 hover:bg-green-600 text-white rounded-full p-2 transition duration-300">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>                        
                    </form>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($products as $product)
                        <div class="relative bg-white rounded-lg shadow-md overflow-hidden group">
                            <!-- Product Image -->
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            
                            <!-- Hover Overlay with Icons -->
                            <div class="absolute inset-0 flex flex-col items-end justify-start opacity-0 group-hover:opacity-100 bg-gray-800 bg-opacity-50 transition-opacity duration-300">
                                <!-- Add to Cart Icon -->
                                <button onclick="addToCart({{ $product->id }}, '{{ $product->pack_size }}')" class="text-white text-2xl sm:text-3xl mb-4 mt-2 mr-4 add-to-cart-btn">
                                    <span class="cart-icon"><i class="fas fa-cart-plus"></i></span>
                                    <span class="loading-spinner hidden"><i class="fas fa-spinner fa-spin"></i></span>
                                </button>
                                <a href="#" class="hidden text-white text-2xl sm:text-3xl mb-4 mr-4">
                                    <i class="fas fa-heart"></i>
                                </a>
                                <a href="#" class="text-white text-2xl sm:text-3xl mr-4">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                            
                            <!-- Product Details -->
                            <div class="p-6">
                                <h3 class="text-lg sm:text-md lg:text-xl font-semibold text-green-600 line-clamp-1">{{ $product->name }}</h3>
                                <!-- Truncated Description -->
                                <p class="mt-2 text-sm sm:text-base lg:text-md text-gray-600 line-clamp-2 min-h-[48px]">
                                    {{ $product->description }}
                                </p>
                                <p class="mt-4 text-base sm:text-sm lg:text-xl text-green-600 font-semibold">
                                    R{{ number_format($product->price, 2) }}
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
