<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Product') }}
            </h2>
        </div>
    </x-slot>

    <!-- Product Editing Form -->
    <section class="bg-gray-100 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <form id="productForm" action="{{ route('admin.product.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Add method spoofing for PUT request -->

                    <!-- Product Name Input -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold">Product Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter product name" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Description Input -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-semibold">Description</label>
                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter product description" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price Input -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-semibold">Price</label>
                        <input type="number" step="0.01" id="price" name="price"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter product price" value="{{ old('price', $product->price) }}" required>
                        @error('price')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pack Size Input -->
                    <div class="mb-4">
                        <label for="pack_size" class="block text-gray-700 font-semibold">Pack Size</label>
                        <input type="text" id="pack_size" name="pack_size"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter pack size (e.g., 100ml, 2 x 100ml)"
                            value="{{ old('pack_size', $product->pack_size) }}" required>
                        @error('pack_size')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alpine.js & Tailwind CSS Searchable Multiselect -->
                    <div x-data="dropdown()" class="mb-4 relative">
                        <label for="category" class="block text-gray-700 font-semibold">Categories</label>

                        <!-- Dropdown button -->
                        <div @click="toggle"
                            class="border-gray-300 border rounded-md shadow-sm cursor-pointer p-2 w-full">
                            <template x-if="selectedCategories.length > 0">
                                <div class="flex flex-wrap">
                                    <template x-for="(category, index) in selectedCategories" :key="index">
                                        <span
                                            class="bg-green-100 text-green-800 rounded-full px-2 py-1 text-sm mr-2 mb-2">
                                            <span x-text="category.name"></span>
                                            <button @click="removeCategory(index)" class="ml-1 text-red-500">x</button>
                                        </span>
                                    </template>
                                </div>
                            </template>
                            <template x-if="selectedCategories.length === 0">
                                <span class="text-gray-400">Select categories</span>
                            </template>
                        </div>

                        <!-- Dropdown list -->
                        <div x-show="open" @click.away="close"
                            class="absolute z-10 w-full mt-2 bg-white border border-gray-300 rounded-md shadow-lg">
                            <!-- Search input -->
                            <div class="p-2">
                                <input type="text" x-model="searchQuery"
                                    class="block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Search categories...">
                            </div>
                            <div class="max-h-48 overflow-y-auto">
                                <template x-for="category in filteredCategories" :key="category.id">
                                    <div class="flex items-center p-2 hover:bg-gray-100 cursor-pointer">
                                        <input type="checkbox" :id="'category-' + category.id" :value="category.id"
                                            x-model="selected"
                                            @click="toggleCategory(category); $event.stopPropagation()" class="mr-2">
                                        <label :for="'category-' + category.id" x-text="category.name"
                                            class="cursor-pointer"></label>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Hidden input to hold selected category values -->
                        <input type="hidden" name="category[]"
                            :value="selectedCategories.map(category => category.id)">

                        @error('categories')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Image Input -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Product Image</label>
                        <div class="relative">
                            @if ($product->image_url)
                                <img src="{{ asset($product->image_url) }}" alt="Product Image"
                                    class="w-full h-48 object-cover rounded-md mb-2">
                            @else
                                <div class="w-full h-48 bg-gray-200 rounded-md mb-2 flex items-center justify-center">
                                    <span class="text-gray-400">No Image Available</span>
                                </div>
                            @endif

                            <input type="file" id="image" name="image" accept="image/*" class="hidden"
                                onchange="updateImagePreview(event)">

                            <!-- Image Icon -->
                            <button type="button"
                                class="absolute bottom-2 right-2 bg-white border border-gray-300 rounded-full p-2 hover:bg-gray-100 transition"
                                onclick="document.getElementById('image').click();">
                                <i class="fa-regular fa-image text-gray-700 text-xl"></i>
                            </button>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button id="submitBtn" type="submit"
                            class="bg-[#63C186] text-white px-4 py-2 rounded-md hover:bg-green-600 transition flex items-center justify-center">
                            <span id="submitText">Update Product</span>
                            <svg id="spinner" class="hidden animate-spin h-5 w-5 ml-2 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.961 7.961 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function dropdown() {
            return {
                open: false,
                searchQuery: '',
                categories: @json($categories) || [],
                selectedCategories: @json($product->categories) || [], // Pre-fill selected categories
                selected: [],

                toggle() {
                    this.open = !this.open;
                },

                close() {
                    this.open = false;
                },

                toggleCategory(category) {
                    if (!category || !category.id) return;
                    const index = this.selectedCategories.findIndex(item => item.id === category.id);
                    if (index === -1) {
                        this.selectedCategories.push(category);
                    } else {
                        this.selectedCategories.splice(index, 1);
                    }
                },

                removeCategory(index) {
                    this.selectedCategories.splice(index, 1);
                    this.selected = this.selectedCategories.map(category => category.id);
                },

                get filteredCategories() {
                    if (!this.categories || this.searchQuery === '') {
                        return this.categories || [];
                    }
                    return this.categories.filter(category =>
                        category.name.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                }
            }
        }
    </script>

    <script>
        document.getElementById('productForm').addEventListener('submit', function(event) {
            var submitBtn = document.getElementById('submitBtn');
            var submitText = document.getElementById('submitText');
            var spinner = document.getElementById('spinner');

            // Disable the submit button
            submitBtn.disabled = true;

            // Change the button text to show saving state and display the spinner
            submitText.textContent = 'Updating...';
            spinner.classList.remove('hidden'); // Show spinner
        });
    </script>

    <style>
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>

    <script>
        function updateImagePreview(event) {
            const input = event.target;
            const img = document.createElement('img');
            img.src = URL.createObjectURL(input.files[0]);
            img.className = 'w-full h-full object-cover rounded-md mb-2';

            // Replace existing image with the new one
            const existingImage = document.querySelector('.relative img');
            if (existingImage) {
                existingImage.src = img.src;
            } else {
                const previewDiv = document.querySelector('.relative');
                previewDiv.prepend(img);
            }
        }
    </script>
</x-app-layout>
