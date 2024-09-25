<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <!-- Back Button -->
    <div class="ml-20">
        <a href="{{ route('admin.product.index') }}" class="text-green-600 hover:underline">
            &larr; Back to Products
        </a>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Product Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Product Image -->
                        <div>
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                class="object-cover rounded-md w-full h-80">
                        </div>

                        <!-- Product Information -->
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Product Information</h3>

                            <!-- Name -->
                            <div class="mb-4">
                                <h4 class="font-bold text-gray-700">Name:</h4>
                                <p class="text-gray-600">{{ $product->name }}</p>
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <h4 class="font-bold text-gray-700">Description:</h4>
                                <p class="text-gray-600">{{ $product->description }}</p>
                            </div>

                            <!-- Price (Optional, adjust based on your schema) -->
                            <div class="mb-4">
                                <h4 class="font-bold text-gray-700">Price:</h4>
                                <p class="text-gray-600">${{ number_format($product->price, 2) }}</p>
                            </div>

                            <!-- Stock Quantity (Optional) -->
                            <div class="mb-4">
                                <h4 class="font-bold text-gray-700">Stock Quantity:</h4>
                                <p class="text-gray-600">{{ $stockQuantity }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions: Edit, Delete -->
                    <div class="mt-6 flex">
                        <a href="{{ route('admin.product.edit', $product->id) }}"
                            class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition">Edit Product</a>

                        <x-confirm-delete :title="'Delete Product'"
                                          :message="'Are you sure you want to delete this product?'"
                                          :action="route('admin.product.destroy', $product->id)"
                                          :triggerText="'Delete Product'"
                                          class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition ml-4" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
