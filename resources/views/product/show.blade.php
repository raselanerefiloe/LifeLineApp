<x-guest-layout>
    

        <!-- Back Button -->
        <div class="ml-8">
            <a href="{{ route('product.index') }}" class="text-green-600 hover:underline">
                &larr; Back to Products
            </a>
        </div>
    <div class="container mx-auto py-12 px-6 lg:px-8">
        <!-- Product Details Section -->
        <div class="flex flex-col lg:flex-row">
            <!-- Product Image -->
            <div class="lg:w-1/2 mb-6 lg:mb-0">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                    class="w-full h-48 object-cover md:h-64 lg:h-56 xl:h-64 max-w-xs md:max-w-sm lg:max-w-md xl:max-w-lg">
            </div>
            <!-- Product Info -->
            <div class="lg:w-1/2 lg:pl-8">
                <h1 class="text-3xl font-bold text-green-600 mb-4">{{ $product->name }}</h1>
                <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                <p class="text-xl font-semibold text-green-600 mb-4">
                    R{{ number_format($product->price, 2) }}
                </p>

                <!-- Input for pack size -->
                <input type="text" id="pack_size_{{ $product->id }}" value="{{ $product->pack_size }}"
                    class="text-black p-2 lg:p-3 rounded-md mb-2 w-full" />

                <!-- Add to Cart Icon -->
                <button
                    onclick="addToCart({{ $product->id }}, document.getElementById('pack_size_{{ $product->id }}').value)"
                    class="text-white text-2xl sm:text-3xl mb-4 mt-2 mr-4 add-to-cart-btn relative">
                    <span class="cart-icon text-white text-sm lg:text-[20px] bg-green-300 p-2.5 rounded-sm"><i
                            class="fas fa-cart-plus mr-2"></i>Add to cart</span>
                    <span
                        class="loading-spinner hidden absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2"><i
                            class="fas fa-spinner fa-spin"></i></span>
                </button>
            </div>
        </div>

        <!-- Additional Product Information -->
        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-green-600 mb-4">Product Details</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">Pack Size:</h3>
                <p class="text-gray-600 mb-4">{{ $product->pack_size }}</p>

                <h3 class="text-lg font-semibold text-gray-700">Availability:</h3>
                <p class="text-gray-600">{{ $product->isInStock() ? 'In Stock' : 'Out of Stock' }}</p>
            </div>
        </div>
    </div>

    <!-- Include JavaScript -->
    @vite(['resources/js/cart.js'])
</x-guest-layout>
